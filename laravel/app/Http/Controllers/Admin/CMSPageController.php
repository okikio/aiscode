<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CmsPage;
use Yajra\Datatables\Datatables;

class CMSPageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
    */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->path = 'admin.cms-page';
        View()->share('path', $this->path);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Datatables $datatables){
        $columns = [
            ['data' => 'DT_RowIndex', 'name' => 'id', 'title' => 'Sr.No', "orderable"=> false, "searchable"=> false],
            ['data' => 'name', 'name' => 'name', 'title' => 'Name', "orderable"=> true, "searchable"=> true],
            ['data' => 'action', 'name' => 'Action', 'title' => 'Action', "orderable"=> false, "searchable"=> false]
        ];
        $cmspage = CmsPage::orderBy('id', 'desc');
        if (request()->ajax()) {
            return $datatables->of($cmspage->get())
                ->addColumn('action', function (CmsPage $cmspage) {
                    $action = "";
                    $action.= '<a href="'.route($this->path.'.edit', $cmspage->id).'"  data-toggle="tooltip" title="Edit" data-id="'.$cmspage->id.'" class="btn btn-outline-success mr-1 mb-1"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;';
                    
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cmspage = CmsPage::find($id);
        return view($this->path.'.edit',compact('cmspage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cmspage = CmsPage::find($id);
        try {
            if($cmspage){
                CmsPage::where('id',$id)->update([
                    'name'          => $request->name,
                    'email'         => $request->email,
                    'phone_number'  => $request->phone_number,
                    'description'   => $request->description
                ]);
                toastr('CmsPage updated successfully','success');
            }else{
                toastr('CmsPage not found','error');
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
        //
    }
}
