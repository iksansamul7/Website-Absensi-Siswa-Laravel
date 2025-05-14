@extends('layout.admin')
@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Presensi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active"><a href="/wakel">Presensi</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

  <section class="content">
      <!-- /.row -->
          <form method="GET" action="/presensi" id="filterForm">
              <div class="form-group">
                  <select name="search" id="search" class="form-control" onchange="document.getElementById('filterForm').submit();">
                      <option value="">Pilih Jadwal</option>
                      @foreach ($data as $item)
                          <option value="{{ $item->id }}" {{ request('search') == $item->id ? 'selected' : '' }}>{{$item->tipekelas}}-{{$item->pelajaran->namapelajaran}}-{{$item->kelas->namakelas}}</option>
                      @endforeach
                  </select> 
              </div>
          </form>

        @if($wadah->isNotEmpty())
          @foreach ($wadah as $item)    
            <div class="card ">
              <div class="card-body">
                  <div class="row ">
                      <div class="col-auto">
                          <p><strong>Kode Mata Pelajaran</strong></p>
                          <p><strong>Mata Pelajaran</strong></p>
                          <p><strong>Hari/Jam</strong></p>
                          <p><strong>Kelas</strong></p>
                          <p><strong>Jam ke</strong></p>
                          <p><strong>pertemuan ke</strong></p>
                          <p><strong>Jenis Kelas</strong></p>
                      </div>
                      <div class="col-auto">
                          <p>{{$item->pelajaran->kodepelajaran}}</p>
                          <p>{{$item->pelajaran->namapelajaran}}</p>
                          <p>{{ $item->hari }}/{{ $item->waktu }}</p>
                          <p>{{$item->kelas->namakelas}}</p>
                          <p>{{ $item->jamke }}</p>
                          <p>{{ $pertemuanke }}</p>
                          <p>{{ $item->tipekelas }}</p>
                      </div>
                  </div>
                  <form action="/insertpresensi" method="POST">
                    @csrf
                    {{-- <div class="mb-2">
                        <label for="exampleInputEmail1"  class="form-label">Masukan Pertemuan Ke :</label>
                        <input type="number" placeholder="Masukan Pertemuan Ke" name="pertemuan" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    </div> readonly --}}
                    <input type="hidden" name="pertemuan" class="form-control" value="{{ $pertemuanke }}" >
                    <input type="hidden" name="jadwal" value="{{ $item->id }}">
                    <input type="hidden" name="tipekelas" value="{{ $item->tipekelas }}">
                    <input type="hidden" name="pelajaran" value="{{ $item->pelajaran_id }}">
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Siswa</th>
                                <th>NIS</th>
                                <th>Status Kehadiran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($student as $data2)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data2->nama }}</td>
                                    <td>{{ $data2->nissiswa }}</td> 
                                    <td>
                                        <select class="form-control" name="presensi[{{ $data2->id }}][present]">
                                            <option value="hadir">Hadir</option>
                                            <option value="alpha">Alpha</option>
                                            <option value="izin">Izin</option>
                                            <option value="sakit">Sakit</option> 
                                        </select>
                                        <input type="hidden" name="semester" value="{{ $data2->semester_id }}">
                                        <input type="hidden" name="kelas" value="{{ $data2->kelas_id }}">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary">Simpan Presensi</button>
                </form>
              </div>
            </div>     
        @endforeach
        @else
          <p class="mt-3">Pilih Jadwal Terlebih Dahulu.</p>
        @endif
        </section>
      </div>
  <!--/. container-fluid -->

    <!-- /.content-header -->




@endsection
@push('scripts')
       {{-- dibawah cdn untuk boostrap  --}}
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
   {{-- dibawah cdn untuk jquery konfirmasi delete, sweet alert  --}}
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
      {{-- dibawah cdn toastr notifikasi semua success  --}}
   <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
   //dibawah adlah scripct jquery diguanakan animasi delete , dipanggil dengan class delete dan variabel nama dan id
   $('.delete').click(function(){
       var wakelid = $(this).attr('data-id');
       var wakelnama = $(this).attr('data-nama');
       swal({
           title: "Apa kamu yakin ?",
           text: "Data yang akan dihapus adalah "+wakelnama+"",
           icon: "warning",
           buttons: true,
           dangerMode: true,
       })
       .then((willDelete) => {
       if (willDelete) {
           //dibawah merupakan untuk memanggil fungsi menghapus dari route web.php
               window.location = "/deletewakel/"+wakelid+""
               swal("BERHASIL, Data mu berhasil dihapus", {
               icon: "success",
       });
       } else {
               swal("Data mu tidak jadi dihapus");
       }
       });
   });
</script>
<script>
   @if(Session::has('success'))
   toastr.success("{{ Session::get('success') }}")
   @endif
</script>
@endpush







