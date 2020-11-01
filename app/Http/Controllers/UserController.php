<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'username'=>$request->username,
            'email'=>$request->email,
            'password'=>$request->password,
            'password_confirmation'=>$request->password_confirmation,
            'fullname'=>$request->fullname,
            'phone'=>$request->phone,
            'role'=>$request->role
        ];

        $a = Validator::make($data, [
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'fullname' => 'required|string|max:255',
            'phone' => 'required|string|max:10',
            'role' => 'required|string|max:10',
        ]);
        if($a->fails()){
            return view('add')->withErrors($a);
        }
        $data['password'] = Hash::make($request->password);
        User::create($data);
        return redirect('/members')->with('success-add-member',"successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, $id)
    {

        $user = User::find($id);
        return view('edit', compact('user'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // $request->validate([
        //     'email' => 'required|string|email|max:255',
        //     'password' => 'required|string|min:6|confirmed',
        //     'phone' => 'required|string|max:10',
        // ]);
        $user = User::find(Auth::user()->id);
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->save();
        return redirect()->route('change')->with('success',"User's Information changed successfully");
    }

    public function update2(Request $request, User $user, $id)
    {
        if($request->password!=''){
            $data = [
                'username'=>$request->username,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
                'fullname'=>$request->fullname,
                'phone'=>$request->phone,
                'role'=>$request->role
            ];
            User::where('id',$id)->update($data);

        }
        $data = [
            'username'=>$request->username,
            'email'=>$request->email,
            // 'password'=>$request->password,
            // 'password_confirmation'=>$request->password_confirmation,
            'fullname'=>$request->fullname,
            'phone'=>$request->phone,
            'role'=>$request->role
        ];
        User::where('id',$id)->update($data);
        return redirect()->route('members')->with('success-update',"User's Information changed successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id',$id)->delete();
        return redirect()->back()->with('success',"Deleted");
    }

    public function view($id){
        $user = User::find($id);
        return view('views', compact('user'));
    }

}
