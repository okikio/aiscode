<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Winner;
use Yajra\Datatables\Datatables;

class WinningController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
    */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->path = 'admin.winner';
        View()->share('path', $this->path);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Datatables $datatables)
    {
        $columns = [
            ['data' => 'DT_RowIndex', 'name' => 'id', 'title' => 'Sr.No', "orderable"=> false, "searchable"=> false],
            ['data' => 'rank', 'name' => 'rank', 'title' => 'Rank', "orderable"=> true, "searchable"=> true],
            ['data' => 'reward_name', 'name' => 'reward_name', 'title' => 'Winning Reward Name', "orderable"=> true, "searchable"=> true],
            ['data' => 'reward', 'name' => 'reward', 'title' => 'Winning Reward', "orderable"=> true, "searchable"=> true],
            ['data' => 'action', 'name' => 'Action', 'title' => 'Action', "orderable"=> false, "searchable"=> false]
        ];
        $winner = Winner::orderBy('rank', 'asc');
        if (request()->ajax()) {
            return $datatables->of($winner->get())
                ->addColumn('action', function (Winner $winner) {
                    $action = "";
                    $action.= '<a href="'.route($this->path.'.show', $winner->id).'"  data-toggle="tooltip" title="Show" data-id="'.$winner->id.'" class="btn btn-outline-primary mr-1 mb-1"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;';
                    $action.= '<a href="'.route($this->path.'.edit', $winner->id).'"  data-toggle="tooltip" title="Edit" data-id="'.$winner->id.'" class="btn btn-outline-success mr-1 mb-1"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;';
                    $action.= '<a onclick="deleteWinner('.$winner->id.')" data-toggle="tooltip" title="Delete" data-id="'.$winner->id.'" class="btn btn-outline-danger mr-1 mb-1"><i class="fa fa-trash"></i></a>&nbsp;&nbsp;';
                    
                    return $action;
                })
                ->rawColumns(['status','action','image'])
                ->addIndexColumn()
                ->make(true);
        }
        $html = $datatables->getHtmlBuilder()->columns($columns)
            ->parameters([
                'order' =>[],
                'paging'      => true,
                'info'        => true,
                'searchDelay' => 350,
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
        $this->validate($request, [
            'rank'          => 'required',
            'reward_name'   => 'required',
            'reward'        => 'required',
        ]);
        try {
            Winner::create([
                'rank'          => $request->get('rank'),
                'reward_name'   => $request->get('reward_name'),
                'reward'        => $request->get('reward'),
                'description'   => $request->get('description'),
                'reward_code'   => $request->get('reward_code'),
            ]);
            toastr('Winner added successfully','success');
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
        $winner = Winner::find($id);
        return view($this->path.'.show',compact('winner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $winner = Winner::find($id);
        return view($this->path.'.edit',compact('winner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'rank'          => 'required',
            'reward_name'   => 'required',
            'reward'        => 'required',
        ]);
        $winner = Winner::find($id);
        try {
            if($winner){
                Winner::where('id',$id)->update([
                    'rank'          => $request->get('rank'),
                    'reward_name'   => $request->get('reward_name'),
                    'reward'        => $request->get('reward'),
                    'description'   => $request->get('description'),
                    'reward_code'   => $request->get('reward_code'),
                ]);
                toastr('Winner updated successfully','success');
            }else{
                toastr('Winner not found','error');
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
        $winner = Winner::find($id);
        if ($winner) {
            $winner->delete();
            $msg = 'Winner deleted Successfully';
            return ["status"=>'success',"message"=>$msg];
        } else {
            $msg = 'Winner not found';
            return ["status"=>'error',"message"=>$msg];
        }
    }
}
