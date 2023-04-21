<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use DataTables;
use Auth;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '';
                            if(Auth::user()->role == 1){
                           $btn = '<a href="'.route('product.edit',$row->id).'" class="edit btn btn-primary btn-sm">Edit</a>';
                           $btn .= '<button  onclick="onBtSave('.$row->id.')"  class="delete btn btn-primary btn-sm" id="delete">Delete</button>';
    
                        }
                        return $btn;

                    })
                    ->editColumn('image',function($row){
                        $img = '<img src = "'.asset('ProductImage/'.$row->image).'" height="50px" width = "50px">';
                        return $img;
                    })
                    ->editColumn('categories_id',function($row){
                        $catnm = $row->GetCategorynm->category_name;
                        return $catnm;
                    })
                    ->rawColumns(['action','image'])
                    ->make(true);
        }
        
        return view('product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['category'] = Category::get();
        return view('product.create')->with($data);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        if($request->file('image')){
            $file= $request->file('image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('ProductImage'), $filename);
            $data = $filename;
            $product->image = $data;

        }
        $product->categories_id = $request->categories_id;
        $product->price = $request->price;
        $product->save();
        if($product){
            return response()->json(['status' => 'success']);

        }
        else{
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
        $data['category'] = Category::get();
        $data['data'] = Product::where('id',$id)->first();
        return view('product.edit')->with($data);
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
        $product =  Product::where('id',$id)->first();
        $product->name = $request->name;
        $product->description = $request->description;
        if($request->file('image')){
            $file= $request->file('image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('ProductImage'), $filename);
            $data = $filename;
            $product->image = $data;

        }
        $product->categories_id = $request->categories_id;
        $product->price = $request->price;
        $product->save();
        if($product){
            return response()->json(['status' => 'success']);

        }
        else{
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
        $product = Product::where('id',$request->id)->first();
        $product->delete();
        if($product){
            return response()->json(['status' => 'success']);
        }
    }
}
