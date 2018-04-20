<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;
use Validator;

class GroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::all();
        return response()->json($groups);
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
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            $response = array('response' => $validator->messages(), 'success' => false);
            return $response;
        } else {
            $group = new Group;
            $group->name = $request->input('name');
            $group->save();

            return response()->json($group);
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
        $group = Group::find($id);
        return response()->json($group);
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
            'name' => 'required',
        ]);

        if($validator->fails()){
            $response = array('response' => $validator->messages(), 'success'=> false);
            return $response;
        } else {
            $group=Group::find($id);
            $group->name= $request->input('name');


            $group -> save();
            return response()->json($group);

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
        $group=Group::find($id);
        if($group)
        {
            $group->delete();
            $response = array('response' => 'Group deleted', 'success'=> true);
        }
        else
        {
            $response= array('response' => "Group doesn't exist", 'success'=> false);
        }

        return $response;
    }
}
