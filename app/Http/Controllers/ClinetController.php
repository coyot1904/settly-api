<?php

namespace App\Http\Controllers;

use App\Models\Clinet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;


class ClinetController extends Controller
{
    function list()
    {
        $user = Auth::user();
        return Clinet::where('user_id' , $user->id)->orderBy('id' , 'desc')->paginate(2);
    }
    //---------------------
    function add(Request $request)
    {
        if($request->has('image')){
            $file= $request->file('image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/Image'), $filename);

            $user = Auth::user();

            Clinet::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'profile_picture' => $filename,
                'user_id' => $user->id
            ]);
            return response(['message' => 'true']);
        }
        else
        {
            return response(['error' => 'file name is required']);
        }
    }
    //---------------------
    function delete($id)
    {
        $user = Auth::user();
        $count = Clinet::where('id',$id)->where('user_id' , $user->id)->delete();
        if($count > 0 ){
            return response(['message' => 'true']);
        }
        else{
            return response(['error' => 'false']);
        }
    }
    //---------------------
    function edit(Request $request)
    {
        if($request->has('image')){
            $file= $request->file('image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/Image'), $filename);

            $user = Auth::user();

            Clinet::where('user_id',$user->id)->where('id' , $request->input('id'))->update([
                'name'=>$request->input('name'),
                'email'=>$request->input('email'),
                'profile_picture'=> $filename
            ]);


            return response(['message' => 'true']);
        }
        else
        {
            $user = Auth::user();

            Clinet::where('user_id',$user->id)->where('id' , $request->input('id'))->update([
                'name'=>$request->input('name'),
                'email'=>$request->input('email'),
            ]);
            return response(['message' => 'true']);
        }
    }
    //---------------------
    function single($id)
    {
        $user = Auth::user();
        return Clinet::where('user_id' , $user->id)->where('id' , $id)->get();
    }
    //---------------------
}
