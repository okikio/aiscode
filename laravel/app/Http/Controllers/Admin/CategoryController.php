<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Yajra\Datatables\Datatables;

class CategoryController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
    */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->path = 'admin.category';
        View()->share('path', $this->path);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Datatables $datatables){
        $columns = [
            ['data' => 'DT_RowIndex', 'name' => 'id', 'title' => 'Sr.No', "orderable"=> false, "searchable"=> false],
            ['data' => 'name', 'name' => 'name', 'title' => 'Name', "orderable"=> true, "searchable"=> true],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status', "orderable"=> false, "searchable"=> false],
            ['data' => 'action', 'name' => 'Action', 'title' => 'Action', "orderable"=> false, "searchable"=> false]
        ];
        $category = Category::orderBy('id', 'desc');
        if (request()->ajax()) {
            return $datatables->of($category->get())
                ->addColumn('status', function (Category $category) {
                    $s="";
                    if ($category->status == 'active') {
                        $s .= '<button type="button" class="btn btn-outline-success btn-block" onclick="changeStatus(1,'.$category->id.')">Active</button>';
                    } else {
                        $s .= '<button type="button" class="btn btn-outline-danger btn-block" onclick="changeStatus(0,'.$category->id.')">InActive</button>';
                    }
                    return $s;
                })
                ->addColumn('action', function (Category $category) {
                    $action = "";
                    // $action.= '<a href="'.route($this->path.'.show', $category->id).'"  data-toggle="tooltip" title="Show" data-id="'.$category->id.'" class="btn btn-outline-primary mr-1 mb-1"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;';
                    $action.= '<a href="'.route($this->path.'.edit', $category->id).'"  data-toggle="tooltip" title="Edit" data-id="'.$category->id.'" class="btn btn-outline-success mr-1 mb-1"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;';
                    $action.= '<a onclick="deleteCategory('.$category->id.')" data-toggle="tooltip" title="Delete" data-id="'.$category->id.'" class="btn btn-outline-danger mr-1 mb-1"><i class="fa fa-trash"></i></a>&nbsp;&nbsp;';
                    
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
            'name'  => 'required',
        ]);
        try {
            Category::create([
                'name' => $request->get('name'),
            ]);
            toastr('Category added successfully','success');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        return view($this->path.'.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name'  => 'required',
        ]);
        $category = Category::find($id);
        try {
            if($category){
                Category::where('id',$id)->update([
                    'name'  => $request->name
                ]);
                toastr('Category updated successfully','success');
            }else{
                toastr('Category not found','error');
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
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            $msg = 'Category deleted Successfully';
            return ["status"=>'success',"message"=>$msg];
        } else {
            $msg = 'Category not found';
            return ["status"=>'error',"message"=>$msg];
        }
    }

    public function changeStatus(Request $request)
    {
        $category = Category::find($request->id);
        if ($category) {
            $category->status = $request->status;
            $category->save();
            $msg = 'Status changed Successfully';
            return ["status"=>'success',"message"=>$msg];
        } else {
            $msg = 'Category not found';
            return ["status"=>'error',"message"=>$msg];
        }
    }
}
