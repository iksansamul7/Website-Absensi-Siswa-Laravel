<?php

namespace App\Exports;

use App\Models\Presensi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class presensiExport implements FromCollection, WithHeadings, WithMapping
{
    protected $kelasId;
    protected $semesterId;
    protected $pelajaranId;
    protected $bulan;

    public function __construct($kelasId, $semesterId, $pelajaranId, $bulan)
    {
        $this->kelasId = $kelasId;
        $this->semesterId = $semesterId;
        $this->pelajaranId = $pelajaranId;
        $this->bulan = $bulan;
    }

    public function collection()
    {
        // Mengambil data berdasarkan filter yang diterima
        return Presensi::query()
            ->when($this->kelasId, function ($query) {
                return $query->where('kelas_id', $this->kelasId);
            })
            ->when($this->semesterId, function ($query) {
                return $query->where('semester_id', $this->semesterId);
            })
            ->when($this->pelajaranId, function ($query) {
                return $query->where('pelajaran_id', $this->pelajaranId);
            })
            ->when($this->bulan, function ($query) {
                return $query->whereMonth('created_at', $this->bulan);
            })
            ->with('contoh', 'pelajaran', 'kelas', 'semester') // Assume 'contoh' is the relation to 'siswa'
            ->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Siswa',
            'NIS Siswa',
            'Kelas',
            'Pelajaran',
            'Semester',
            'Pertemuan 1', 'Pertemuan 2', 'Pertemuan 3', 'Pertemuan 4', 'Pertemuan 5',
            'Pertemuan 6', 'Pertemuan 7', 'Pertemuan 8', 'Pertemuan 9', 'Pertemuan 10', 
            'Pertemuan 11', 'Pertemuan 12', 'Pertemuan 13', 'Pertemuan 14', 'Pertemuan 15', 'Pertemuan 16', 'Pertemuan 17', 'Pertemuan 18', 'Pertemuan 19', 'Pertemuan 20'
        ];
    }

    public function map($row): array
    {
          $no = 1;

        // Mendapatkan data untuk setiap baris
        $data = [
            $no++,
            $row->contoh->nama,
            $row->contoh->nissiswa,
            $row->kelas->namakelas,
            $row->pelajaran->namapelajaran,
            $row->semester->semester,
            // $row->kelas_id,
            // $row->pelajaran_id,
            // $row->semester_id
        ];

        // Menambahkan kolom untuk pertemuan dan status absensi
        for ($i = 1; $i <= 20; $i++) {
            $data[] = $row->pertemuan == $i ? $row->present : 'none';
        }

        return $data;
    }
}
