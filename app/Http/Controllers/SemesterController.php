<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $data = Semester::where('semester', 'LIKE', '%' .$request->search. '%')->paginate(5);
        } else {
            $data = Semester::paginate(5);}
    
        return view('semester',compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function tambahsemester()
    {
        return view('tambahsemester');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function insertsemester (Request $request){
        $validatedData = $request->validate([ 'semester' => 'required|min:1|max:20']);
        Semester::create($request->all());
        return redirect()->route('semester')->with('success' ,'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function tampilsemester($id)

    {
        $data = Semester::find($id);
        return view('tampilsemester',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function updatesemester(Request $request, $id)
    {
        $data = Semester::find($id);
        $data->update($request->all());
        return redirect()->route('semester')->with('success' ,'Data berhasil diupdate');
    }


    public function deletesemester($id)
    {
        $data = Semester::find($id);
        $data->delete();
        return redirect()->route('semester')->with('success' ,'Data berhasil dihapus');
    }
}
