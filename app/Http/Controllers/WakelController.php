<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Wakel;
use App\Models\contoh;
use App\Models\Kelas;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;


class WakelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
            $data = wakel::with('guru', 'kelas')->paginate(5);
            return view('wakel',compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function tambahwakel()
    {
        $personguru = Guru::all();
        $personkelas = Kelas::all();
        return view('tambahwakel',compact('personguru', 'personkelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function insertwakel (Request $request){
        wakel::create($request->all());
        return redirect()->route('wakel')->with('success' ,'Data berhasil ditambahkan');
    }
    /**
     * Display the specified resource.
     */
    /**
     * Show the form for editing the specified resource.
     */
    public function tampilwakel($id)
    {
        $personguru = Guru::all();
        $personkelas = Kelas::all();
        $data = Wakel::find($id);
        return view('tampilwakel',compact('data', 'personguru', 'personkelas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function updatewakel(Request $request, $id)
    {
        $data = Wakel::find($id);
        $data->update($request->all());
        return redirect()->route('wakel')->with('success' ,'Data berhasil diupdate');
    }
    /**
     * Remove the specified resource from storage.
     */
    
    public function deletewakel($id)
    {
        $data = Wakel::find($id);
        $data->delete();
        return redirect()->route('wakel')->with('success' ,'Data berhasil dihapus');
    }
    public function wakelpdf()
    {
        $data = Wakel::with('guru', 'kelas')->get();
        view()->share('data', $data);
        $pdf = FacadePdf::loadView('wakelpdf');
        return $pdf->download('your_file.pdf');
    }
}
