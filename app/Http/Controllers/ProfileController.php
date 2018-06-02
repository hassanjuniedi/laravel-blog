<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Session;
use Spatie\Permission\Models\Role;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user.profile')->with('user', Auth::user());
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
        //
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
        $user = User::findOrFail($id);
        return view('admin.user.profile',[
            'user'=> $user,
            'roles' => Role::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'avatar' => 'nullable|image',
            'facebook' => 'url',
            'twitter' => 'url',
            'about' => 'required'
        ]);

        $user = Auth::user();

        if ($request->hasFile('avatar')) {
            /** @var UploadedFile $avatar */
            $avatar = $request->avatar;
            $newName = time().$avatar->getClientOriginalName();
            $avatar->move('uploads/avatars', $newName );
            $user->profile->avatar = 'uploads/avatars/'. $newName;
        }

        $user->name =  $request->name;
        $user->email = $request->email;
        $user->profile->facebook =  $request->facebook;
        $user->profile->twitter =  $request->twitter;
        $user->profile->about = $request->about;

        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->save();
        $user->profile->save();

        Session::flash('success', 'Profile updated successfully');

        return redirect()->back();



    }

    /**
     * @param Request $request
     * @param $id
     */
    public function updateRoles(Request $request, $id) {
        $this->validate($request, [
           'role' => 'required'
        ]);

        $user = User::findOrFail($id);
        $user->syncRoles($request->role);
        $user->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
