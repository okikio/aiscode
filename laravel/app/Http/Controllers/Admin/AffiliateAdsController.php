<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AffiliateAds;
use App\Models\AffiliateUser;
use Yajra\Datatables\Datatables;
use DB;
use Carbon\Carbon;

class AffiliateAdsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
    */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->path = 'admin.affiliate-ads';
        View()->share('path', $this->path);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Datatables $datatables){
        $columns = [
            ['data' => 'DT_RowIndex', 'name' => 'id', 'title' => 'Sr.No', "orderable"=> false, "searchable"=> false],
            ['data' => 'user_id', 'name' => 'user_id', 'title' => 'Username', "orderable"=> true, "searchable"=> true],
            ['data' => 'affiliate_code', 'name' => 'affiliate_code', 'title' => 'Affiliate Code', "orderable"=> true, "searchable"=> true],
            ['data' => 'total_revenue', 'name' => 'total_revenue', 'title' => 'Total Revenue', "orderable"=> true, "searchable"=> true],
            ['data' => 'current_month', 'name' => 'current_month', 'title' => 'Current Month', "orderable"=> true, "searchable"=> true],
            ['data' => 'action', 'name' => 'Action', 'title' => 'Action', "orderable"=> false, "searchable"=> false]
        ];
        $maxValue = AffiliateUser::max('amount');
        $affiliate_user = AffiliateUser::where('amount',$maxValue)->orderBy('id','desc')->limit(1);
        if (request()->ajax()) {
            return $datatables->of($affiliate_user->get())
                ->editColumn('user_id',function (AffiliateUser $affiliate_user){
                    return $affiliate_user->getUser->name;
                })
                ->addColumn('affiliate_code',function (AffiliateUser $affiliate_user){
                    return $affiliate_user->getUser->affiliate_code;
                })
                ->addColumn('total_revenue',function (AffiliateUser $affiliate_user){
                    $total_revenue = AffiliateUser::sum('amount');
                    return '$'.$total_revenue;
                })
                ->addColumn('current_month',function (AffiliateUser $affiliate_user){
                    $current_month = AffiliateUser::whereMonth('created_at', Carbon::now()->month)->sum('amount');
                    return '$'.$current_month;
                })
                ->addColumn('action', function (AffiliateUser $affiliate_user) {
                    $action = "";
                    $action.= '<a href="'.route($this->path.'.show', $affiliate_user->id).'"  data-toggle="tooltip" title="Show" data-id="'.$affiliate_user->id.'" class="btn btn-outline-primary mr-1 mb-1"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;';
                    return $action;
                })
                ->rawColumns(['action'])
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request,Datatables $datatables,string $id)
    {
        $columns = [
            ['data' => 'DT_RowIndex', 'name' => 'id', 'title' => 'Sr.No', "orderable"=> false, "searchable"=> false],
            ['data' => 'user_id', 'name' => 'user_id', 'title' => 'Username', "orderable"=> true, "searchable"=> true],
            ['data' => 'email', 'name' => 'email', 'title' => 'Email Address', "orderable"=> true, "searchable"=> true],
            ['data' => 'amount', 'name' => 'amount', 'title' => 'Amount', "orderable"=> true, "searchable"=> true],
        ];
        $highest_user = AffiliateUser::find($id);
        $total_revenue = AffiliateUser::sum('amount');
        $current_month = AffiliateUser::whereMonth('created_at', Carbon::now()->month)->sum('amount');
        $affiliate_user = AffiliateUser::orderBy('amount','desc');
        if(isset($request['enddate']) && !empty($request['enddate']) && isset($request['startdate']) && !empty($request['startdate'])){
            $start_date = $request['startdate'];
            $end_date = $request['enddate'];
            $affiliate_user->whereBetween(DB::raw('DATE(created_at)'),[$start_date,$end_date]);
        }
        if (request()->ajax()) {
            // return $datatables->of($affiliate_user->get()->unique('user_id'))
            return $datatables->of($affiliate_user->get())
                ->editColumn('user_id',function (AffiliateUser $affiliate_user){
                    return $affiliate_user->getUser->name;
                })
                ->editColumn('amount',function (AffiliateUser $affiliate_user){
                    return '$'.$affiliate_user->amount;
                })
                ->addColumn('email',function (AffiliateUser $affiliate_user){
                    return $affiliate_user->getUser->email;
                })
                ->rawColumns([])
                ->addIndexColumn()
                ->make(true);
        }
        $html = $datatables->getHtmlBuilder()->columns($columns)
            ->ajax([
                'data' => 'function(d) { 
                    d._token = "'.csrf_token().'";
                    d.startdate = $("#init_dt").val(); 
                    d.enddate = $("#final_dt").val();
                }',
            ])
            ->parameters([
                'order' =>[],
                'paging'      => true,
                'info'        => true,
                'searchDelay' => 350,
                'dom' => 'lBfrtip',
                'buttons' => [
                    [
                        'extend' => 'excelHtml5',
                        'text' => 'Export Affiliate User',
                        'title'=> 'Affiliate User Data',
                    ],
                ],
            ]);
            $start_date =  Carbon::now()->subDays(15)->format('Y-m-d');
            $end_date = Carbon::now()->format('Y-m-d');

        return view($this->path.'.show', compact('html','highest_user','total_revenue','current_month','start_date','end_date'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
