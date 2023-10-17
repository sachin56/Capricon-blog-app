<?php

namespace App\Http\Controllers;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\u_role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $roles= (new RoleController())->getroles();
        if ($roles->contains('role_id',1)){
            return view('admin.roles.role');
        }else{
            return view('includes.errors');
        }
    }
    /**
     * Show the datatable type data.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $result = u_role::all();

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

        ]);

        if($validator->fails()){
            return response()->json(['validation_error' => $validator->errors()->all()]);
        }else{
            try{
                DB::beginTransaction();

                $result = new u_role;
                $result->description = $request->description;

                $result->save();

                DB::commit();
                return response()->json(['db_success' => 'Added New Role']);

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
        $result = u_role::find($id);

        return response()->json($result);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){

        $validator = Validator::make($request->all(), [
            'description' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['validation_error' => $validator->errors()->all()]);
        }else{
            try{
                DB::beginTransaction();

                $type = u_role::find($request->id);
                $type->description = $request->description;

                $type->save();

                DB::commit();
                return response()->json(['db_success' => 'Role Updated']);

            }catch(\Throwable $th){
                DB::rollback();
                throw $th;
                return response()->json(['db_error' =>'Database Error'.$th]);
            }

        }

    }

    /**
     * Remove the specified resource from Database.
     *
     * @param  \App\Post  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){

        $result = u_role::destroy($id);

        return response()->json($result);

    }

    /**
     * show the specified resource from user role Database.
     *
     * @return \Illuminate\Http\Response
     */
    public static function getroles(){
        $user_role=DB::table('u_user_roles')
                    ->select('role_id')
                    ->where('user_id','=',Auth::user()->id)
                    ->get();

        return $user_role;
    }
}
