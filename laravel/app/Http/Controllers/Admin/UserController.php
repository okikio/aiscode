<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AffiliateAds;
use App\Models\AffiliateUser;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Mail;
use App\Mail\GeneratePasswordMail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Models\Leaderboards;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
    */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->path = 'admin.user';
        $this->affiliate = AffiliateAds::pluck('name','id');
        View()->share('path', $this->path);
        View()->share('affiliate', $this->affiliate);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Datatables $datatables){
        $columns = [
            ['data' => 'DT_RowIndex', 'name' => 'id', 'title' => 'Sr.No', "orderable"=> false, "searchable"=> false],
            ['data' => 'name', 'name' => 'name', 'title' => 'FullName', "orderable"=> true, "searchable"=> true],
            ['data' => 'email', 'name' => 'email', 'title' => 'Email', "orderable"=> true, "searchable"=> true],
            ['data' => 'birth_date', 'name' => 'birth_date', 'title' => 'Date of Birth', "orderable"=> true, "searchable"=> true],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status', "orderable"=> false, "searchable"=> false],
            ['data' => 'action', 'name' => 'Action', 'title' => 'Action', "orderable"=> false, "searchable"=> false]
        ];
        $user = User::orderBy('id', 'desc');
        if (request()->ajax()) {
            return $datatables->of($user->get())
                ->addColumn('status', function (User $user) {
                    $s="";
                    if ($user->status == 'active') {
                        $s .= '<button type="button" class="btn btn-outline-success btn-block" onclick="changeStatus(1,'.$user->id.')">Active</button>';
                    } else {
                        $s .= '<button type="button" class="btn btn-outline-danger btn-block" onclick="changeStatus(0,'.$user->id.')">InActive</button>';
                    }
                    return $s;
                })
                ->addColumn('action', function (User $user) {
                    $action = "";
                    $action.= '<a href="'.route($this->path.'.show', $user->id).'"  data-toggle="tooltip" title="Show" data-id="'.$user->id.'" class="btn btn-outline-primary mr-1 mb-1"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;';
                    $action.= '<a href="'.route($this->path.'.edit', $user->id).'"  data-toggle="tooltip" title="Edit" data-id="'.$user->id.'" class="btn btn-outline-success mr-1 mb-1"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;';
                    $action.= '<a onclick="deleteUser('.$user->id.')" data-toggle="tooltip" title="Delete" data-id="'.$user->id.'" class="btn btn-outline-danger mr-1 mb-1"><i class="fa fa-trash"></i></a>&nbsp;&nbsp;';
                    
                    return $action;
                })
                ->rawColumns(['status','action'])
                ->addIndexColumn()
                ->make(true);
        }
        $html = $datatables->getHtmlBuilder()->columns($columns)
            ->parameters([
                'order' =>[],
                'paging'      => true,
                'info'        => true,
                'searchDelay' => 350,
                'dom' => 'lBfrtip',
                'buttons' => [
                    [
                        'extend' => 'excelHtml5',
                        'text' => 'Export User Data',
                        'title'=> 'User Data',
                        'exportOptions'=> [
                            'columns'=> ['0','1','2','3','4'],
                        ],
                    ],
                ],
            ]);
        return view($this->path.'.index', compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view($this->path.'.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input,
            [
                'name'          => 'required',
                'email'         => 'required',
                'birth_date'    => 'required',
                'phone_number'  => 'required',
                // 'country'       => 'required',
                // 'state'         => 'required',
                // 'address'       => 'required',
                // 'zipcode'       => 'required',
                'nick_name'     => 'required',
                'last_name'     => 'required',
            ]   
        );

        $validator->after(function() use($request, $validator)  {
          if($request->get('email')){
            $checkUsernameExist = User::where(['email'=>$request->get('email')])->first();
            if(!empty($checkUsernameExist)){
              $validator->errors()->add('email', 'The email has already been taken.');  
            }
          }
          if($request->get('phone_number')){
            $checkUsernameExist = User::where(['phone_number'=>$request->get('phone_number')])->first();
            if(!empty($checkUsernameExist)){
              $validator->errors()->add('phone_number', 'The phone number has already been taken.');  
            }
          }
        });
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        try {
            $mailPassword = Str::random(6);
            $password =  Hash::make($mailPassword);
            $user = User::create([
                'name'          => $request->get('name'),
                'last_name'     => $request->get('last_name'),
                'email'         => $request->get('email'),
                'birth_date'    => $request->get('birth_date'),
                'phone_number'  => $request->get('phone_number'),
                'nick_name'     => $request->get('nick_name'),
                // 'country'       => $request->get('country'),
                // 'state'         => $request->get('state'),
                // 'address'       => $request->get('address'),
                // 'zipcode'       => $request->get('zipcode'),
                'password'      => $password,
                'affiliate_id'  =>  $request->affiliate_id,
                'isActive'      => '1'
            ]);
            $mailData = [
                'name' => $request->name.' '.$request->last_name,
                'email' => $request->email,
                'password' => $mailPassword,
            ];
            Mail::to($request->email)->send(new GeneratePasswordMail($mailData));

            if(!empty($request->affiliate_id)){
                $rand = rand(10,100);
                $amount = floor(($rand + 10)/10) * 10;
                AffiliateUser::create([
                    'affiliate_id'  =>  $request->affiliate_id,
                    'user_id'       =>  $user->id,
                    'amount'        =>  $amount 
                ]);
            }
            toastr('User added successfully','success');
            return redirect()->route($this->path.'.index');
        } catch (\Exception $e) {
            return back()->with([
            'alert-type' => 'danger',
            'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        return view($this->path.'.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        return view($this->path.'.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input = $request->all();
        $user = User::find($id);
        $validator = Validator::make($input,
            [
                'name'          => 'required',
                'email'         => 'required',
                'birth_date'    => 'required',
                'phone_number'  => 'required',
                // 'country'       => 'required',
                // 'state'         => 'required',
                // 'address'       => 'required',
                // 'zipcode'       => 'required',
                'nick_name'     => 'required'  
            ]
        );
        $validator->after(function() use($request, $validator,$user)  {
          if($request->get('email') != $user->email){
            $checkUsernameExist = User::where(['email'=>$request->get('email')])->first();  
            if(!empty($checkUsernameExist)){
              $validator->errors()->add('email', 'The email has already been taken.');  
            }
          }

          if($request->get('phone_number') != $user->phone_number){
            $checkUsernameExist = User::where(['phone_number'=>$request->get('phone_number')])->first();  
            if(!empty($checkUsernameExist)){
              $validator->errors()->add('phone_number', 'The phone number has already been taken.');  
            }
          }
        });
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        try {
            if($user){
                User::where('id',$id)->update([
                    'name'          => $request->name,
                    'email'         => $request->get('email'),
                    'birth_date'    => $request->get('birth_date'),
                    'phone_number'  => $request->get('phone_number'),
                    'nick_name'     => $request->get('nick_name'),
                    // 'country'       => $request->get('country'),
                    // 'state'         => $request->get('state'),
                    // 'address'       => $request->get('address'),
                    // 'zipcode'       => $request->get('zipcode'),
                    'affiliate_id'  => $request->affiliate_id,
                    'isActive'      => '1'
                ]);
                $affiliate_user = AffiliateUser::where('user_id',$id)->first();
                if(empty($affiliate_user)){
                    if(!empty($request->affiliate_id)){
                        $rand = rand(10,100);
                        $amount = floor(($rand + 10)/10) * 10;
                        AffiliateUser::create([
                            'affiliate_id'  =>  $request->affiliate_id,
                            'user_id'       =>  $id,
                            'amount'        =>  $amount 
                        ]);
                    }
                }
                toastr('User updated successfully','success');
            }else{
                toastr('User not found','error');
            }
            return redirect()->route($this->path.'.index');
        } catch (\Exception $e) {
            return back()->with([
            'alert-type' => 'danger',
            'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if ($user) {
            Leaderboards::where('user_id',$id)->delete();
            $user->delete();
            $msg = 'User deleted Successfully';
            return ["status"=>'success',"message"=>$msg];
        } else {
            $msg = 'User not found';
            return ["status"=>'error',"message"=>$msg];
        }
    }
    public function changeStatus(Request $request)
    {
        $user = User::find($request->id);
        if ($user) {
            $user->status = $request->status;
            $user->save();
            $msg = 'Status changed Successfully';
            return ["status"=>'success',"message"=>$msg];
        } else {
            $msg = 'User not found';
            return ["status"=>'error',"message"=>$msg];
        }
    }
}
