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
            <h1 class="m-0">Data Jadwal</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active"><a href="/jadwal">Data Jadwal</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
 
        <!-- /.row -->
        <div class="container">
            
            {{-- form dibawah digunakan untuk search data, digabung dengan controller index --}}
            <div class="row g-3 mt-2">
              <form class="row g-3 " action="/jadwal" method="GET">
                @csrf
                <div class="col-auto">
                  <input type="search" name="search" class="form-control" id="inputPassword2" placeholder="Masukan kata kunci">
                </div>
                <div class="col-auto">
                  <button type="submit" class="btn btn-primary mb-3">Cari</button>
                </div>
            </form>
                <div class="col-auto">
                    <a href="/tambahjadwal" type="button"  class="btn btn-success">Tambah</a>
                  </div>   
                <div class="col-auto">
                    <a href="/jadwalpdf" type="button"  class="btn btn-danger">PDF</a>
                  </div>        
            </div>

    
            <div class="row">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Guru</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Mata Pelajaran</th>
                        <th scope="col">Hari/Jam</th>
                        <th scope="col">Jam ke</th>
                        <th scope="col">TipeKelas</th>
                        <th scope="col">Tahun Semester</th>
                        <th scope="col">Aksi</th>
                      </tr>
                    </thead>
                    <tbody> 
                        {{--dibawah untukyjme2 penomoran yang urut dan digabugnkan dengan pagnation " $index => "--}}
                        @foreach ($data as $index => $item)
                        
                        <tr>
                            {{--dibawah untuk pengulangan penomran yang dimasukan ke dalam th "{{ $index +$data->firstItem() }}"--}}
                            <th scope="row">{{ $index +$data->firstItem() }}</th>
                            <td>{{ $item->guru->namaguru }}</td>
                            <td>{{ $item->kelas->namakelas }}</td>
                            <td>{{ $item->pelajaran->namapelajaran }}</td>
                            <td>{{ $item->hari }}/{{ $item->waktu }}</td>
                            <td>{{ $item->jamke }}</td>
                            <td>{{ $item->tipekelas }}</td>
                            <td>{{ $item->semester->semester }}</td>

                            <td>
                                <a href="/tampiljadwal/{{ $item->id }}"  class="btn btn-warning">Update</a>
                                {{-- dibawah adalah contoh delete yang menggunakan animasi jquery --}}
                                <a href="#" class="btn btn-danger delete" data-id="{{ $item->id }}" data-nama="{{ $item->pelajaran->namapelajaran }}" >Delete</a>
                            </td>
                          </tr>
                        @endforeach
                      
                    </tbody>

                  </table>
                  {{-- kode dibawah juga digunakan untuk paginate , dan digabungkan dengan app servis provider yang berada di folder app provider --}}
                  {{ $data->links() }}
                
            </div>
        </div>
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>


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
       var jadwalid = $(this).attr('data-id');
       var jadwalnama = $(this).attr('data-nama');
       swal({
           title: "Apa kamu yakin ?",
           text: "Data yang akan dihapus adalah "+jadwalnama+"",
           icon: "warning",
           buttons: true,
           dangerMode: true,
       })
       .then((willDelete) => {
       if (willDelete) {
           //dibawah merupakan untuk memanggil fungsi menghapus dari route web.php
               window.location = "/deletejadwal/"+jadwalid+""
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







