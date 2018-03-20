<?php

namespace App\Http\Controllers;
use App\Profile;
use Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(){
        return view('user.index')->with('users',User::all());
    }
    public function create(){

        return view('user.create');
    }
    public function store(Request $request){

        $this->validate($request,[

            'username'=>'required',
            'email'=>'required|email|unique:users'
            ]);
        $user=User::create([
            'name'=>$request->username,
            'email'=>$request->email,
            'password'=>bcrypt('password'),

        ]);
        Profile::create([

            'avatar'=> '1.png',
            'user_id'=>$user->id
        ]);

        Session::flash('message','User Successfully Created!');
        return redirect()->route('users');
    }

    public function destroy($id)
    {

        $users = User::find($id);
        $profile = Profile::find($id);
        if($users->count()>1 && !$users->admin){

                $users->profile->delete();
                $users->delete();
                Session::flash('message', 'User Successfully Deleted');
        }
        else{
            Session::flash('info', 'User Cannot be Deleted Becouse there is only one admin');
        }

                    return redirect()->route('users');


    }
    public function make_admin($id){

        $user=User::find($id);
        $user->admin=1;
        $user->save();
        Session::flash('message',$user->name.' Promoted as Admin Successfully!');
        return redirect()->route('users');
    }

    public function remove_admin($id){
        $user=User::find($id);
        $users=User::where('admin',1)->get();
        if($users->count()== 1) {
            Session::flash('info', 'Sorry unable Remove ' . $user->name . ' Becouse He is  the only Admin!');
            return redirect()->back();
        }



            $user->admin=0;
            $user->save();
            Session::flash('info',$user->name.' Dissmiss From AdminShip!');
            return redirect()->route('users');
           }

     public function edit(){

        return view('user.edit')->with('user',Auth::user());
     }
     public function update(Request $request, $id){


        $this->validate($request,[

            'username'=>'required',
            'email'=>'required|email',
            //'facebook'=>'url'

            ]);

         $user= User::find($id);
         if($request->hasFile('avatar')){

             $avatar_orignal= $request->avatar->getClientOriginalName();
             $avatar_new_name=time().$avatar_orignal;
             $request->avatar->move('uploads/avatar/',$avatar_new_name);
             $user->profile->avatar=$avatar_new_name;
             $user->profile->save();
         }

         $user->name = $request->username;
         $user->email = $request->email;
         $user->profile->facebook = $request->facebook;
         $user->profile->bio = $request->bio;
         $user->save();
         $user->profile->save();

         if($request->has('password')){
             $user->password = bcrypt($request->password);
             $user->save();

         }
         Session::flash('message','Profile successfully Updated');
         return redirect()->route('users');
     }
}
