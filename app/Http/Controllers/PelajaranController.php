<?php

namespace App\Http\Controllers;

use App\Models\Pelajaran;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PelajaranController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $data = Pelajaran::where('namapelajaran', 'LIKE', '%' .$request->search. '%')->paginate(5);
        } else {
            $data = Pelajaran::paginate(5);}
    
        return view('pelajaran',compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function tambahpelajaran()
    {
        return view('tambahpelajaran');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function insertpelajaran (Request $request){
        $validatedData = $request->validate([ 'kodepelajaran' => 'required|min:2|max:100', 'namapelajaran' => 'required|min:3|max:100', ]);
        Pelajaran::create($request->all());
        return redirect()->route('pelajaran')->with('success' ,'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function tampilpelajaran($id)

    {
        $data = Pelajaran::find($id);
        return view('tampilpelajaran',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function updatepelajaran(Request $request, $id)
    {
        $data = Pelajaran::find($id);
        $data->update($request->all());
        return redirect()->route('pelajaran')->with('success' ,'Data berhasil diupdate');
    }

    /**
     * Update the specified resource in storage.
     */
    public function pelajaranpdf()
    {
        $data = Pelajaran::all();
        view()->share('data', $data);
        $pdf = Pdf::loadView('pelajaranpdf');
        return $pdf->download('your_file.pdf');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deletepelajaran($id)
    {
        $data = Pelajaran::find($id);
        $data->delete();
        return redirect()->route('pelajaran')->with('success' ,'Data berhasil dihapus');
    }
}
