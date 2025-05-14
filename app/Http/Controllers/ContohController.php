<?php

namespace App\Http\Controllers;

use App\Exports\contohExport;
use App\Models\contoh;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Semester;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Composer\Semver\Semver;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ContohController extends Controller
{
// tampilan utama
    public function index(Request $request){

        //perulangan if dibawah digunakan untuk search
        if ($request->has('search')) {
            $data = contoh::where('nama', 'LIKE', '%' .$request->search. '%')->paginate(10);
        } else {
    //paginate digunakan untuk membatasi data yang ditampilkan sebanyak 2 
            $data = contoh::with('kelas','semester' )->paginate(10);
        }
        $person = contoh::count();
        $personcowok = contoh::where('jeniskelamin', 'cowok')->count();
        $personcewek = contoh::where('jeniskelamin', 'cewek')->count();
        return view('pegawai', compact('data','person', 'personcowok', 'personcewek'));
    }
//insert data
    public function tambahpegawai(){
        $kelas = Kelas::all();
        $semester = Semester::all();

        return view('tambahdata', compact('kelas', 'semester'));
    }

    public function insertdata (Request $request){
        $validatedData = $request->validate([ 'nama' => 'required|min:3|max:20', 'nissiswa' => 'required|min:3|max:9', ]);
        contoh::create($request->all());
        return redirect()->route('pegawai')->with('success' ,'Data berhasil ditambahkan');
    }

//update data

    public function tampildata($id){
        $kelas = Kelas::all();
        $semester = Semester::all();
        $data = contoh::find($id);
        return view('tampildata',compact('data', 'kelas', 'semester'));
    }

    public function updatedata (Request $request, $id){
        $data = contoh::find($id);
        $data->update($request->all());
        return redirect()->route('pegawai')->with('success' ,'Data berhasil diupdate');
    }

//delete

public function delete ($id){
    $data = contoh::find($id);
    $data->delete();
    return redirect()->route('pegawai')->with('success' ,'Data berhasil dihapus');
}
//dibawah untuk melakukan download pdf  , dengan menggnakan plugin Barryvdh facadepdf
public function exportpdf()
{
    $data = contoh::with('kelas', 'semester')->get();
    view()->share('data', $data);
    $pdf = FacadePdf::loadView('pegawai_pdf');
    return $pdf->download('your_file.pdf');
}


//dibawah adalah untuk melakukan download excel
public function exportexcel(){
    return Excel::download(new contohExport, 'datapegawai.xlsx');
}



}