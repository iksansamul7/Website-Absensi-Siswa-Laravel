<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = User::paginate(5);
        return view('user',compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function tambahuser()
    {
        return view('tambahuser');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function insertuser (Request $request){
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($request->password),
            'remember_token' => Str::random(60),

        ]);
        return redirect('/user')->with('success', 'User Added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function tampiluser($id)

    {
        $data = User::find($id);
        return view('tampiluser',compact('data'));
    }

    public function deleteuser($id)
    {
        $data = User::find($id);
        $data->delete();
        return redirect()->route('user')->with('success' ,'Data berhasil dihapus');
    }
}
