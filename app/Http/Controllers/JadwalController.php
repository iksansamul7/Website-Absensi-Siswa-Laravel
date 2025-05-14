<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Pelajaran;
use App\Models\Semester;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $data = Jadwal::where('namapelajaran', 'LIKE', '%' .$request->search. '%')->paginate(5);
        } else {
            $data = Jadwal::with('guru','kelas', 'pelajaran', 'semester')->paginate(5);
            return view('jadwal',compact('data'));}

    }

    /**
     * Show the form for creating a new resource.
     */
    public function tambahjadwal()
    {
        $personguru = Guru::all();
        $datakelas = Kelas::all();
        $semester = Semester::all();
        $datapelajaran = Pelajaran::all();
        return view('tambahjadwal',compact('personguru', 'datakelas','datapelajaran', 'semester'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function insertjadwal (Request $request){
        Jadwal::create($request->all());
        return redirect()->route('jadwal')->with('success' ,'Data berhasil ditambahkan');
    }
    /**
     * Display the specified resource.
     */
    /**
     * Show the form for editing the specified resource.
     */
    public function tampiljadwal($id)
    {
        $personguru = Guru::all();
        $datakelas = Kelas::all();
        $semester = Semester::all();
        $datapelajaran = Pelajaran::all();
        $data = Jadwal::find($id);
        return view('tampiljadwal',compact('data', 'personguru', 'datakelas','datapelajaran', 'semester'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function updatejadwal(Request $request, $id) 
    {
        $data = Jadwal::find($id);
        $data->update($request->all());
        return redirect()->route('jadwal')->with('success' ,'Data berhasil diupdate');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function deletejadwal($id)
    {
        $data = Jadwal::find($id);
        $data->delete();
        return redirect()->route('jadwal')->with('success' ,'Data berhasil dihapus');
    }
    public function jadwalpdf()
    {
        $data = Jadwal::with('guru','kelas', 'pelajaran', 'semester')->get();
        view()->share('data', $data);
        $pdf = Pdf::loadView('jadwalpdf');
        return $pdf->download('your_file.pdf');
    }
}
