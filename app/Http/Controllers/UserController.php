<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Daftar User';
        $data = User::all();

        return view('pages.user.index', ['title' => $title, 'data' => $data]);
    }

    public function resetPassword(User $user)
    {

        $user->password = bcrypt('password');
        $user->update();

        return back()->with('success', 'password user berhasil direset menjadi (password)');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Form Tambah User';

        return view('pages.user.tambah', ['title' => $title]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required',
            'no_hp' => 'required',
            'akses_user' => 'required',
            'password' => 'required'

        ]);

        try {
            $user = new User();

            $user->username = $request->username;
            $user->email = $request->email;
            $user->no_hp = $request->no_hp;
            $user->akses_user = $request->akses_user;
            $user->password = bcrypt($request->password);
            $user->save();

            return redirect('daftar-user')->with('success', 'User berhasil ditambahkan...!');
        } catch (\Exception $e) {
            return redirect('daftar-user')->with('failed', $e->getMessage());
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
    public function edit(User $user)
    {
        return view('pages.user.edit', ['title' => 'Form Edit User', 'user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required',
            'no_hp' => 'required',
            'akses_user' => 'required',


        ]);

        try {

            $user->username = $request->username;
            $user->email = $request->email;
            $user->no_hp = $request->no_hp;
            $user->akses_user = $request->akses_user;
            // $user->password = bcrypt($request->password);
            $user->update();

            return redirect('daftar-user')->with('success', 'User berhasil ditambahkan...!');
        } catch (\Exception $e) {
            return redirect('daftar-user')->with('failed', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

        try {
            $user->delete();

            return back()->with('success', 'User Berhasil dihapus..!');
        } catch (\Exception $e) {
            return back()->with('failed', $e->getMessage());
        }
    }
}
