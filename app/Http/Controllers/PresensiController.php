<?php

namespace App\Http\Controllers;

use App\Exports\presensiExport;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\contoh;
use App\Models\Jadwal;
use App\Models\Presensi;
use App\Models\Semester;
use App\Models\Pelajaran;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class PresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    

    public function index(Request $request)
    {

        $wadah = collect(); 
        $student = collect();  
        $pertemuanke = 1;

        if ($request->has('search') && $request->input('search') != '') {     
            $wadah = Jadwal::where('id', $request->input('search'))->get();
            // Ambil kelas_id dari hasil pencarian Jadwal
            $kelas_id = $wadah->first()->kelas_id ?? null;
            $semester_id = $wadah->first()->semester_id ?? null;
            $kodepelajaran = $wadah->first()->pelajaran_id ?? null; // Default ke "2023/2024
            $tipekelas = $wadah->first()->tipekelas ?? null; 

            $lastMeeting = Presensi::where('semester_id', $semester_id)
                                    ->where('pelajaran_id', $kodepelajaran)
                                    ->max('pertemuan');
            $pertemuanke = $lastMeeting ? $lastMeeting + 1 : 1; 

            // Filter data dari tabel Students berdasarkan kelas_id dari Jadwal
            if ($kelas_id && $semester_id) {
                $student = Contoh::where('kelas_id', $kelas_id)
                                 ->where('semester_id', $semester_id); 
            
                if ($tipekelas === "aliyah") {
                    $student->where('tipekelas', $tipekelas); // Tambahkan filter tanpa membuat query baru
                }
            
                $student = $student->get(); // Jalankan query setelah semua kondisi ditambahkan
            }            
        }
        $data=Jadwal::with('kelas', 'pelajaran')->get();
        return view('presensi',compact('data', 'wadah','student','pertemuanke'));
    }



    public function insertpresensi(Request $request)
    {
        
        $presensiData = $request->input('presensi');
        $pertemuan = $request->input('pertemuan');
        $semester = $request->input('semester');
        $tipekelas = $request->input('tipekelas');
        $kelas = $request->input('kelas');
        $jadwal = $request->input('jadwal');
        $pelajaran = $request->input('pelajaran');

        foreach ($presensiData as $studentId => $data) {
            Presensi::create([
                'contoh_id' => $studentId,
                'semester_id' => $semester, 
                'kelas_id' => $kelas,
                'tipekelas' => $tipekelas,
                'present' => $data['present'],
                'jadwal_id' => $jadwal,
                'pelajaran_id' => $pelajaran,
                'pertemuan' => $pertemuan, // Data dari luar foreach
            ]);
        }
        return redirect()->route('presensi')->with('success' ,'absensi berhasil ditambahkan');
    }






    public function rekap(Request $request)
    {
            // Query dasar untuk Presensi
        $studentQuery = Presensi::query();

        // Filter berdasarkan filter1 (kelas_id)
        if ($request->has('filter1') && $request->input('filter1') != '') {
            $kelas_id = $request->input('filter1');
            $studentQuery->where('kelas_id', $kelas_id);
        } 

        // Filter berdasarkan filter2 (semester_id)
        if ($request->has('filter2') && $request->input('filter2') != '') {
            $semester_id = $request->input('filter2');
            $studentQuery->where('semester_id', $semester_id);
        }

        // Filter berdasarkan filter3 (pelajaran_id)
        if ($request->has('filter3') && $request->input('filter3') != '') {
            $pelajaran_id = $request->input('filter3');
            $studentQuery->where('pelajaran_id', $pelajaran_id);
        } 
        if ($request->has('filter4') && $request->input('filter4') != '') {
            $bulan = $request->input('filter4');
            $studentQuery->whereMonth('created_at', $bulan);
        } 
        if ($request->has('filter5') && $request->input('filter5') != '') {
            $tipekelas = $request->input('filter5');
            $studentQuery->where('tipekelas', $tipekelas);
        } 

        // Eksekusi query dan ambil data yang sudah difilter
        $student = $studentQuery->orderBy('pertemuan', 'asc')
                                ->with('contoh', 'kelas', 'pelajaran', 'semester', 'jadwal')
                                ->get();
        // Ambil data lain untuk ditampilkan pada view, jika diperlukan
        $kelas = Kelas::all();
        $semester = Semester::all();
        $pelajaran = Pelajaran::all();
        $jadwal = Jadwal::all();

        // Menyampaikan data ke view
        return view('rekap', compact('kelas', 'student', 'semester', 'pelajaran', 'jadwal'));
    }




    // public function rekappdf(Request $request)
    // {
    //     // Mengambil data berdasarkan filter
    //     $kelasId = $request->input('filter1');
    //     $semesterId = $request->input('filter2');
    //     $pelajaranId = $request->input('filter3');
        
    //     // Filter data berdasarkan filter yang diterima
    //     $student = Presensi::query()
    //         ->when($kelasId, function ($query) use ($kelasId) {
    //             return $query->where('kelas_id', $kelasId);
    //         })
    //         ->when($semesterId, function ($query) use ($semesterId) {
    //             return $query->where('semester_id', $semesterId);
    //         })
    //         ->when($pelajaranId, function ($query) use ($pelajaranId) {
    //             return $query->where('pelajaran_id', $pelajaranId);
    //         })
    //         ->with('contoh')
    //         ->get();

    //     // Mengirim data siswa ke view yang akan digunakan untuk PDF
    //     $pdf = Pdf::loadView('rekappdf', compact('student'));
        
    //     // Mendownload PDF
    //     return $pdf->download('Rekap-Absensi.pdf');
    // }


    
    public function rekappdf(Request $request)
    {
        // Mengambil data berdasarkan filter
        $kelasId = $request->input('filter1');
        $semesterId = $request->input('filter2');
        $pelajaranId = $request->input('filter3');
        $bulan = $request->input('filter4');
        
        // Filter data berdasarkan filter yang diterima
        $students = Presensi::query()
            ->when($kelasId, function ($query) use ($kelasId) {
                return $query->where('kelas_id', $kelasId);
            })
            ->when($semesterId, function ($query) use ($semesterId) {
                return $query->where('semester_id', $semesterId);
            })
            ->when($pelajaranId, function ($query) use ($pelajaranId) {
                return $query->where('pelajaran_id', $pelajaranId);
            })
            ->when($bulan, function ($query) use ($bulan) {
                return $query->whereMonth('created_at', $bulan);
            })
            ->with('contoh') // Assume 'contoh' is a relation to 'siswa'
            ->get();
        
        // Mengelompokkan siswa berdasarkan 'nissiswa' dan 'nama'
        $groupedStudents = $students->groupBy(function ($item) {
            return $item->contoh->nissiswa . '-' . $item->contoh->nama;
        });

        $databulan = $bulan;
        
        // Mengirim data siswa ke view yang akan digunakan untuk PDF
        $pdf = Pdf::loadView('rekappdf', compact('groupedStudents', 'databulan' ))
        ->setPaper('a4', 'landscape');
        
        // Mendownload PDF
        return $pdf->download('Rekap-Absensi.pdf');
    }

    // public function exportexcel(){
    //     return Excel::download(new presensiExport, 'datapegawai.xlsx');
    // }
    
    public function rekapexcel(Request $request)
{
    // Mengambil data berdasarkan filter
    $kelasId = $request->input('filter1');
    $semesterId = $request->input('filter2');
    $pelajaranId = $request->input('filter3');
    $bulan = $request->input('filter4');
    
    // Validasi apakah semua filter diisi
    // if (empty($kelasId) || empty($semesterId) || empty($pelajaranId) || empty($bulan)) {
    //     return redirect()->back()->withErrors('Semua filter harus diisi.');
    // }

    // Mengambil data berdasarkan filter yang diterima dan ekspor ke Excel
    return Excel::download(new presensiExport($kelasId, $semesterId, $pelajaranId, $bulan), 'Rekap-Absensi.xlsx');
}

public function deletepresensi($id)
{
    $data = Presensi::find($id);
    $data->delete();
    return redirect()->back()->with('success', 'Data berhasil dihapus');
}
}
