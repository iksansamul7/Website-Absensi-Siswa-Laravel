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

  <h2 id="judul">Data Guru</h2>
  <h4 id="judul">Ponpes Nurul ummah</h4>


<table id="customers">
  <tr>
    <th>No</th>
    <th>Nip</th>
    <th>Nama </th>
    <th>Email</th>
  </tr>
  @php
    $no=1;    
  @endphp
  @foreach ($data as $item)      
  <tr>
    <td>{{ $no++ }}</td>
    <td>{{ $item->nip }}</td>
    <td>{{ $item->namaguru }}</td>
    <td>{{ $item->email }}</td>
  </tr>
  @endforeach
  
</table>

</body>
</html>


