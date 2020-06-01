<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::with('posts')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string|max:20|unique:users',
            'name' => 'required|string|max:30',
            'email' => 'required|string|unique:users',
            'role' => 'required',
            'password' => 'required|max:30',
        ]);

        $rawPass = $request['password'];
        $username = $request['username'];

        $pass = Hash::make($rawPass);

        if($request['image']){
            $imageName = substr(strtolower(str_replace(' ','', preg_replace('/[_\.]/', '', $username))), 0, 10);
            $imgExt = explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
            $image = $imageName.'.'.$imgExt;
            \Image::make($request->image)->resize(300,300)->save(public_path('images/users/').$image);
        }else{
            $image = '';
        }

        return User::create([
            'username' => $username,
            'name' => $request['name'],
            'email' => $request['email'],
            'role' => $request['role'],
            'devType' => $request['devType'],
            'facebook' => $request['facebook'],
            'whats_app' => $request['whats_app'],
            'skype' => $request['skype'],
            'instagram'=> $request['instagram'],
            'linkedin' => $request['linkedin'],
            'phone' => $request['phone'],
            'image' => $image,
            'password' => $pass,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($username)
    {
        return User::with('posts')->where('username', $username)->get();
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
        //
    }

    public function updatePersonalInfo(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|min:5|string',
        ]);

        $user->update([
            'name' => $request['name'],
            'facebook' => $request['facebook'],
            'whats_app' => $request['whats_app'],
            'skype' => $request['skype'],
            'instagram'=> $request['instagram'],
            'linkedin' => $request['linkedin'],
            'phone' => $request['phone']

        ]);
    }

    public function updateEmail(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $this->validate($request, [
            'email' => 'required|min:10|string|unique:users,email,'.$user->id,
            'password' => 'required|max:30'
        ]);

        if(Hash::check($request['password'], $user->password)) {

            $user->update([
                'email' => $request['email']
            ]);
        }
    }

    public function updateImage(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if($request['newImage']){
            $imageName = substr(strtolower(str_replace(' ','', preg_replace('/[_\.]/', '', $user->username))), 0, 10);
            $imgExt = explode('/', explode(':', substr($request['newImage'], 0, strpos($request['newImage'], ';')))[1])[1];
            $image = $imageName.'.'.$imgExt;
            \Image::make($request['newImage'])->resize(300,300)->save(public_path('images/users/').$image);
            $imagePath = '/images/users/'.$image;
        }else{
            $imagePath = '';
        }

        $user->update([
            'image' => $imagePath
        ]);

    }

    public function updatePassword(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $this->validate($request, [
            'previous' => 'required',
            'newPassword' => 'required|max:30'
        ]);

        if(Hash::check($request['previous'], $user->password)) {

            $newPassword = Hash::make($request['newPassword']);

            $user->update([
                'password' => $newPassword
            ]);
        }

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
