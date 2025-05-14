<!DOCTYPE html>
<html>
<head>
<style>
#tampilan {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%; /* Menggunakan lebar penuh kontainer */
  table-layout: auto; /* Lebar kolom disesuaikan dengan konten */
}

#tampilan td, #tampilan th {
  border: 1px solid #ddd;
  padding: 6px;
  text-align: left; /* Agar teks di kiri */
  word-wrap: break-word; /* Agar teks panjang dibungkus dalam kolom */
  white-space: normal; /* Memastikan teks yang panjang tidak terpotong */
}

#tampilan tr:nth-child(even) {
  background-color: #f2f2f2; /* Warna latar belakang baris genap */
}

#tampilan tr:hover {
  background-color: #ddd; /* Warna latar belakang saat hover */
}

#tampilan th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: #ffffff; /* Warna latar belakang header */
  color: rgb(0, 0, 0);
  font-size: 12px; /* Ukuran font untuk header */
}

#tampilan td {
  font-size: 12px; /* Ukuran font untuk isi tabel */
}

/* Pengaturan untuk print atau export ke PDF */
@media print {
  #tampilan {
    page-break-before: always; /* Pastikan tabel berada di halaman baru */
    width: 100%; /* Menggunakan lebar penuh halaman */
  }

  #tampilan td, #tampilan th {
    padding: 5px; /* Mengurangi padding untuk mencetak lebih efisien */
    font-size: 10px; /* Mengurangi ukuran font agar muat di halaman */
  }

  #tampilan tr:nth-child(even) {
    background-color: #f9f9f9; /* Warna latar belakang untuk print */
  }

  #tampilan tr:hover {
    background-color: transparent; /* Hilangkan efek hover saat print */
  }

}
#judul{
    text-align: center;
  }
</style>
</head>
<body>
<h2 id="judul">Rekap Absensi</h2>
<h4 id="judul">Ponpes Nurul ummah</h4>


<table id="tampilan">
  <tr>
    <th rowspan="2">No</th>
    <th rowspan="2">Nama Siswa</th>   
    <th rowspan="2">NIS</th>
    <th colspan="20">Pertemuan Ke</th>
</tr>
<tr>
    <th>1</th>
    <th>2</th>
    <th>3</th>
    <th>4</th>
    <th>5</th>
    <th>6</th>
    <th>7</th>
    <th>8</th>
    <th>9</th>
    <th>10</th>
    <th>11</th>
    <th>12</th>
    <th>13</th>
    <th>14</th>
    <th>15</th>
    <th>16</th>
    <th>17</th>
    <th>18</th>
    <th>19</th>
    <th>20</th>
</tr>

  {{-- @php
    $no=1;    
  @endphp
  @foreach ($student as $item)      
  <tr>
    <td>{{ $no++ }}</td>
    <td>{{ $item->contoh->nama }}</td>
    <td>{{ $item->contoh->nissiswa}}</td>
    @for ($i = 1; $i <= 12; $i++)
      <td>
          @if ($item->pertemuan == $i)   
              {{ $item->present }} <!-- Menampilkan data 'present' jika pertemuan sama dengan i -->
          @else
              none <!-- Jika pertemuan tidak sama dengan i, tampilkan 'none' -->
          @endif
      </td>
    @endfor
  </tr>
  @endforeach
  @php
  $no = 1; // Nomor urut untuk setiap siswa
@endphp --}}

@php
    $no = 1;
@endphp
@foreach ($groupedStudents as $groupKey => $items)
    @php
        // Ambil nama dan NIS siswa dari kelompok pertama
        $firstItem = $items->first();
        $nama = $firstItem->contoh->nama;
        $nissiswa = $firstItem->contoh->nissiswa;
    @endphp
    <tr> 
        <td>{{ $no++ }}</td>
        <td>{{ $nama }}</td>
        <td>{{ $nissiswa }}</td>
        
        @for ($i = 1; $i <= 20; $i++)
            <td>
                @php
                    // Gabungkan data pertemuan dan present siswa di kelompok ini
                    $presentData = '';
                    foreach ($items as $item) {
                        if ($item->pertemuan == $i) {
                            $presentData .= $item->present . ' '; // Gabungkan data present
                        }
                    }
                @endphp
                {{ $presentData ?: 'none' }} <!-- Jika tidak ada data, tampilkan 'none' -->
            </td>
        @endfor
    </tr>
@endforeach



  

</table>

</body>
</html>


