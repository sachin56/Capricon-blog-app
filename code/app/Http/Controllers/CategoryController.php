<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\category;
use Illuminate\Support\Str;
use DataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $result =Category::all();

        return DataTables($result)->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        if($validator->fails()){
            return response()->json(['validation_error' => $validator->errors()->all()]);
        }else{
            try{
                DB::beginTransaction();

                $result = new category();
                $result->category_name = $request->name;
                $result->slug = Str::slug($request->name, '-');
                $result->description = $request->description;

                $result->save();
                
                DB::commit();
                return response()->json(['db_success' =>'Category Added']);

            }catch(\Throwable $th){
                DB::rollback();
                throw $th;
                return response()->json(['db_error' =>'Database Error'.$th]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $result =  category::find($id);

        return response()->json($result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        if($validator->fails()){
            return response()->json(['validation_error' => $validator->errors()->all()]);
        }else{
            try{
                DB::beginTransaction();

                $result = category::find($request->id);
                $result->category_name = $request->name;
                $result->slug = Str::slug($request->name, '-');
                $result->description = $request->description;

                $result->save();
                
                DB::commit();
                return response()->json(['db_success' =>'Updatede Category']);

            }catch(\Throwable $th){
                DB::rollback();
                throw $th;
                return response()->json(['db_error' =>'Database Error'.$th]);
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        
        $result = category::destroy($id);

        return response()->json($result);
    }

}
