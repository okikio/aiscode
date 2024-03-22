<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Storage;
use App\Models\Category;
use App\Models\Game;
use Illuminate\Support\Str;
use Yajra\Datatables\Datatables;

class GameController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
    */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->path = 'admin.game';
        View()->share('path', $this->path);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Datatables $datatables)
    {
        $columns = [
            ['data' => 'DT_RowIndex', 'name' => 'id', 'title' => 'Sr.No', "orderable"=> false, "searchable"=> false],
            ['data' => 'image', 'name' => 'image', 'title' => 'Image', "orderable"=> true, "searchable"=> true],
            ['data' => 'category_id', 'name' => 'category_id', 'title' => 'Category Name', "orderable"=> true, "searchable"=> true],
            ['data' => 'name', 'name' => 'name', 'title' => 'Name', "orderable"=> true, "searchable"=> true],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status', "orderable"=> false, "searchable"=> false],
            ['data' => 'action', 'name' => 'Action', 'title' => 'Action', "orderable"=> false, "searchable"=> false]
        ];
        $game = Game::orderBy('id', 'desc');
        if (request()->ajax()) {
            return $datatables->of($game->get())
                ->editColumn('category_id',function (Game $game){
                    return $game->getCategory->name;
                })
                ->editColumn('image',function (Game $game){
                    return '<img class="img-thumbnail" src="'.$game->image.'" width="100px">';
                })
                ->addColumn('status', function (Game $game) {
                    $s="";
                    if ($game->status == 'active') {
                        $s .= '<button type="button" class="btn btn-outline-success btn-block" onclick="changeStatus(1,'.$game->id.')">Active</button>';
                    } else {
                        $s .= '<button type="button" class="btn btn-outline-danger btn-block" onclick="changeStatus(0,'.$game->id.')">InActive</button>';
                    }
                    return $s;
                })
                ->addColumn('action', function (Game $game) {
                    $action = "";
                    $action.= '<a href="'.route($this->path.'.show', $game->id).'"  data-toggle="tooltip" title="Show" data-id="'.$game->id.'" class="btn btn-outline-primary mr-1 mb-1"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;';
                    $action.= '<a href="'.route($this->path.'.edit', $game->id).'"  data-toggle="tooltip" title="Edit" data-id="'.$game->id.'" class="btn btn-outline-success mr-1 mb-1"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;';
                    $action.= '<a onclick="deleteGame('.$game->id.')" data-toggle="tooltip" title="Delete" data-id="'.$game->id.'" class="btn btn-outline-danger mr-1 mb-1"><i class="fa fa-trash"></i></a>&nbsp;&nbsp;';
                    
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
        $category = Category::where('status','active')->orderBy('name','asc')->pluck('name','id');
        return view($this->path.'.create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'          => 'required',
            'category_id'   => 'required',
            'url'           => 'required',
        ]);
        try {
            if($request->hasFile('image')){
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = Str::random(10).'.'.$extension;
                Storage::disk('public')->putFileAs('game', $file,$filename);
            }
            Game::create([
                'name'          => $request->get('name'),
                'category_id'   => $request->get('category_id'),
                'url'           => $request->get('url'),
                'image'         => $filename,
            ]);
            toastr('Game added successfully','success');
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
        $category = Category::where('status','active')->orderBy('name','asc')->pluck('name','id');
        $game = Game::find($id);
        return view($this->path.'.edit',compact('game','category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name'          => 'required',
            'category_id'   => 'required',
        ]);
        $game = Game::find($id);
        try {
            if($game){
                if($request->hasFile('image')){
                    $file = $request->file('image');
                    $extension = $file->getClientOriginalExtension();
                    $filename = Str::random(10).'.'.$extension;
                    Storage::disk('public')->putFileAs('game', $file,$filename);
                    $game->image = $filename;
                }
                $game->name = $request->name;
                $game->category_id = $request->category_id;
                $game->url = $request->url;
                $game->save();
                toastr('Game updated successfully','success');
            }else{
                toastr('Game not found','error');
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
        $game = Game::find($id);
        if ($game) {
            $game->delete();
            $msg = 'Game deleted Successfully';
            return ["status"=>'success',"message"=>$msg];
        } else {
            $msg = 'Game not found';
            return ["status"=>'error',"message"=>$msg];
        }
    }

    public function changeStatus(Request $request)
    {
        $game = Game::find($request->id);
        if ($game) {
            $game->status = $request->status;
            $game->save();
            $msg = 'Status changed Successfully';
            return ["status"=>'success',"message"=>$msg];
        } else {
            $msg = 'Game not found';
            return ["status"=>'error',"message"=>$msg];
        }
    }
}
