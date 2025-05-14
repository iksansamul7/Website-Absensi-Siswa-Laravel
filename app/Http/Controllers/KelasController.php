<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $data = Kelas::where('namakelas', 'LIKE', '%' .$request->search. '%')->paginate(5);
        } else {
            $data = kelas::paginate(5);}
    
        return view('kelas',compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function tambahkelas()
    {
        return view('tambahkelas');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function insertkelas (Request $request){
        $validatedData = $request->validate([ 'kodekelas' => 'required|min:1|max:20', 'namakelas' => 'required|min:1|max:12', ]);
        Kelas::create($request->all());
        return redirect()->route('kelas')->with('success' ,'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function tampilkelas($id)

    {
        $data = kelas::find($id);
        return view('tampilkelas',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function updatekelas(Request $request, $id)
    {
        $data = kelas::find($id);
        $data->update($request->all());
        return redirect()->route('kelas')->with('success' ,'Data berhasil diupdate');
    }

    /**
     * Update the specified resource in storage.
     */
    public function kelaspdf()
    {
        $data = kelas::all();
        view()->share('data', $data);
        $pdf = Pdf::loadView('kelaspdf');
        return $pdf->download('your_file.pdf');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deletekelas($id)
    {
        $data = Kelas::find($id);
        $data->delete();
        return redirect()->route('kelas')->with('success' ,'Data berhasil dihapus');
    }
}
