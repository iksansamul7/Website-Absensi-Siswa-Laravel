<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */  
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $data = guru::where('namaguru', 'LIKE', '%' .$request->search. '%')->paginate(5);
        } else {
            $data = guru::paginate(5);}
    
        return view('guru',compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function tambahguru()
    {
        return view('tambahguru');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function insertguru (Request $request){
        $validatedData = $request->validate([ 'namaguru' => 'required|min:3|max:20', 'nip' => 'required|min:2|max:12', ]);
        guru::create($request->all());
        return redirect()->route('guru')->with('success' ,'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function tampilguru($id)

    {
        $data = guru::find($id);
        return view('tampilguru',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function updateguru(Request $request, $id)
    {
        $data = guru::find($id);
        $data->update($request->all());
        return redirect()->route('guru')->with('success' ,'Data berhasil diupdate');
    }

    /**
     * Update the specified resource in storage.
     */
    public function gurupdf()
    {
        $data = Guru::all();
        view()->share('data', $data);
        $pdf = FacadePdf::loadView('gurupdf');
        return $pdf->download('your_file.pdf');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteguru($id)
    {
        $data = guru::find($id);
        $data->delete();
        return redirect()->route('guru')->with('success' ,'Data berhasil dihapus');
    }
}
