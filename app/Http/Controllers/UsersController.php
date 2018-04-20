<?php

namespace App\Http\Controllers;

use App\MyUser;
use Illuminate\Http\Request;
use Validator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = MyUser::all();
        return response()->json($users);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_name' => 'required',
            'password' => 'required',
            'name' => 'required',
            'surname' => 'required',
            'date_of_birth' => 'required'
        ]);

        if($validator->fails()){
            $response = array('response' => $validator->messages(), 'success'=> false);
            return $response;
        } else {
            $user=new MyUser;
            $user->user_name= $request->input('user_name');
            $user->password= $request->input('password');
            $user->name= $request->input('name');
            $user->surname= $request->input('surname');
            $user->date_of_birth= $request->input('date_of_birth');

            $user -> save();

            $user -> groups() -> sync($request->input('group_id'));
            return response()->json($user);

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
        $user = MyUser::find($id);
        $groups = $user->groups()->get();
       // return response()->json($user);
        return array('user' => $user, 'groups' => $groups);
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
        $validator = Validator::make($request->all(), [
            'user_name' => 'required',
            'password' => 'required',
            'name' => 'required',
            'surname' => 'required',
            'date_of_birth' => 'required'
        ]);

        if($validator->fails()){
            $response = array('response' => $validator->messages(), 'success'=> false);
            return $response;
        } else {
            $user=MyUser::find($id);
            $user->user_name= $request->input('user_name');
            $user->password= $request->input('password');
            $user->name= $request->input('name');
            $user->surname= $request->input('surname');
            $user->date_of_birth= $request->input('date_of_birth');

            $user -> save();
            $user -> groups() -> syn($request->input('group_id'));
            return response()->json($user);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return array
     */
    public function destroy($id)
    {
        $user=MyUser::find($id);
        if($user!=null)
        {

            $user->delete();
            $response = array('response' => 'User deleted', 'success'=> true);
        }
        else
        {
            $response= array('response' => "User doesn't exist", 'success'=> false);
        }

        return $response;
    }

    public function userGroups($id)
    {
        $user= MyUser::find($id);
        if($user)
        {
            return $user->groups()->get();
        }
        else
        {
            return array('response' => "User doesn't exist", 'success'=> false);
        }


    }
}
