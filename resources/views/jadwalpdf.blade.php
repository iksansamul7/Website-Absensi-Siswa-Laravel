<!DOCTYPE html>
<html>
<head>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
#judul{
  text-align: center;
}
</style>
</head>
<body>

  <h2 id="judul">Data Jadwal</h2>
<h4 id="judul">Ponpes Nurul ummah</h4>

<table id="customers">
  <tr>
    <th>No</th>
    <th>Nama Guru</th>
    <th>Nama Kelas</th>
    <th>Nama Pelajaran</th>
    <th>Hari/Jam</th>
    <th>Tahun Semester</th>
  </tr>
  @php
    $no=1;    
  @endphp
  @foreach ($data as $item)      
  <tr>
    <td>{{ $no++ }}</td>
    <td>{{ $item->guru->namaguru }}</td>
    <td>{{ $item->kelas->namakelas }}</td>
    <td>{{ $item->pelajaran->namapelajaran }}</td>
    <td>{{ $item->hari }}/{{ $item->waktu }}</td>
    <td>{{ $item->semester->semester }}</td>
  </tr>
  @endforeach
  
</table>

</body>
</html>


