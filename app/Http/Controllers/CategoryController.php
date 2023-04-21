<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
        if ($request->ajax()) {
            $data = Category::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                           $btn = '<a href="'.route('category.edit',$row->id).'" class="edit btn btn-primary btn-sm">Edit</a>';
                           $btn .= '<button  onclick="onBtSave('.$row->id.')"  class="delete btn btn-primary btn-sm" id="delete">Delete</button>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'category_name' => 'required',
        ]);
        if($validate->fails()){
        return response()->json(['status' => 'validationfail']);
        }

        $category = new Category;
        $category->category_name = $request->category_name;
        $category->save();
        if($category){
            return response()->json(['status' => 'success']);
        }else{
            return response()->json(['status' => 'error']);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['data'] = Category::where('id',$id)->first();
        return view('category.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'category_name' => 'required',
        ]);
        if($validate->fails()){
        return response()->json(['status' => 'validationfail']);
        }

        $category =  Category::where('id',$id)->first();
        $category->category_name = $request->category_name;
        $category->save();
        if($category){
            return response()->json(['status' => 'success']);
        }else{
            return response()->json(['status' => 'error']);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $category = Category::where('id',$request->id)->first();
        $category->delete();
        if($category){
            return response()->json(['status' => 'success']);
        }
    }
}
