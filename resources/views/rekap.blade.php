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
            <h1 class="m-0">Rekap Absensi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active"><a href="/rekap">Rekap Absensi</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <!-- /.row -->
        <div class="container ">
            {{-- form dibawah digunakan untuk search data, digabung dengan controller index --}}
            <div class="  row g-3 mt-4">
              <div class="col-auto d-flex">
                  <form method="GET" action="/rekap">
                      <div class="d-flex align-items-center"> <!-- Menambahkan d-flex untuk membuat elemen berada dalam satu baris -->
                          <div class="form-group col-auto">
                              <select name="filter1" id="filter1" class="form-control">
                                  <option value="">Pilih Kelas</option>
                                  @foreach ($kelas as $item)
                                      <option value="{{ $item->id }}" {{ request('filter1') == $item->id ? 'selected' : '' }}>{{$item->namakelas}}</option>
                                  @endforeach
                              </select>
                          </div>
                          <div class="form-group col-auto">
                              <select name="filter2" id="filter2" class="form-control">
                                  <option value="">Pilih Semester</option>
                                  @foreach ($semester as $item)
                                      <option value="{{ $item->id }}" {{ request('filter2') == $item->id ? 'selected' : '' }}>{{$item->semester}}</option>
                                  @endforeach
                              </select>
                          </div>
                          <div class="form-group col-auto">
                              <select name="filter3" id="filter3" class="form-control">
                                  <option value="">Pilih Pelajaran</option>
                                  @foreach ($pelajaran as $item)
                                      <option value="{{ $item->id }}" {{ request('filter3') == $item->id ? 'selected' : '' }}>{{$item->kodepelajaran}}-{{$item->namapelajaran}}</option>
                                  @endforeach
                              </select>
                          </div>
                          <div class="form-group col-auto">
                            <select name="filter5" id="filter5" class="form-control">
                                <option value="" selected disabled>Pilih Jenis Kelas</option>
                                <option value="reguler">Kelas Reguler</option>
                                <option value="aliyah">Kelas Aliyah</option>
                            </select>
                        </div>
                          <div class="form-group col-auto">
                            <select name="filter4" id="filter4" class="form-control">
                                <option value="">Pilih Bulan</option>
                                <option value="1" {{ request('filter4') == '1' ? 'selected' : '' }}>Januari</option>
                                <option value="2" {{ request('filter4') == '2' ? 'selected' : '' }}>Februari</option>
                                <option value="3" {{ request('filter4') == '3' ? 'selected' : '' }}>Maret</option>
                                <option value="4" {{ request('filter4') == '4' ? 'selected' : '' }}>April</option>
                                <option value="5" {{ request('filter4') == '5' ? 'selected' : '' }}>Mei</option>
                                <option value="6" {{ request('filter4') == '6' ? 'selected' : '' }}>Juni</option>
                                <option value="7" {{ request('filter4') == '7' ? 'selected' : '' }}>Juli</option>
                                <option value="8" {{ request('filter4') == '8' ? 'selected' : '' }}>Agustus</option>
                                <option value="9" {{ request('filter4') == '9' ? 'selected' : '' }}>September</option>
                                <option value="10" {{ request('filter4') == '10' ? 'selected' : '' }}>Oktober</option>
                                <option value="11" {{ request('filter4') == '11' ? 'selected' : '' }}>November</option>
                                <option value="12" {{ request('filter4') == '12' ? 'selected' : '' }}>Desember</option>
                              </select>
                          </div>
                          <button type="submit" class="btn btn-primary form-group col-auto">Filter</button>
                      </div>
                  </form>

                  <div class="col-auto align-items-center" >
                      <form action="/rekappdf" method="GET">
                          <input type="hidden" name="filter1" value="{{ request('filter1') }}">
                          <input type="hidden" name="filter2" value="{{ request('filter2') }}">
                          <input type="hidden" name="filter3" value="{{ request('filter3') }}">
                          <input type="hidden" name="filter4" value="{{ request('filter4') }}">
                          <button type="submit" class="btn btn-danger form-group col-auto">PDF</button>
                      </form>
                  </div>
                  <div class="col-auto align-items-center">
                    <form action="/rekapexcel" method="GET">
                      <input type="hidden" name="filter1" value="{{ request('filter1') }}">
                      <input type="hidden" name="filter2" value="{{ request('filter2') }}">
                      <input type="hidden" name="filter3" value="{{ request('filter3') }}">
                      <input type="hidden" name="filter4" value="{{ request('filter4') }}">
                        <button type="submit" class="btn btn-success form-group col-auto">Excel</button>
                    </form>
                </div>
              </div>
          </div>

            @if(request('filter1') || request('filter2') || request('filter3') || request('filter4'))
            <div class="card" >
              <div class="card-body">
                  <div class="row">
                    <table class="table table-bordered mt-4">
                      <thead class="table-dark">
                          <tr>
                              <th>#</th>
                              <th>Nama Siswa</th>
                              <th>NIS</th>
                              <th>Pertemuan Ke</th>
                              <th>Hadir</th>
                              <th>Alpha</th>
                              <th>Sakit</th>
                              <th>Izin</th>
                              <th>Aksi</th>

                          </tr>
                      </thead>
                      <tbody>
                        @php
                            $no = 1;
                        @endphp
                          @foreach($student as $student)
                              <tr>
                                  <td>{{ $no++ }}</td>
                                  <td>{{ $student->contoh->nama ?? 'N/A' }}</td>
                                  <td>{{ $student->contoh->nissiswa ?? 'N/A' }}</td>
                                  <td>{{ $student->pertemuan ?? 'N/A' }}</td>
                                  <td>
                                    @if ($student->present == 'hadir') 1 
                                    @else 0 
                                    @endif
                                  </td>
                                  <td>
                                    @if ($student->present == 'alpha') 1 
                                    @else 0 
                                    @endif
                                  </td>
                                  <td>
                                    @if ($student->present == 'sakit') 1 
                                    @else 0 
                                    @endif
                                  </td>
                                  <td>
                                    @if ($student->present == 'izin') 1 
                                    @else 0 
                                    @endif
                                  </td>
                                  <td><a href="#" class="btn btn-danger delete" data-id="{{ $student->id }}" >Delete</a></td>
                              </tr>
                          @endforeach
                      </tbody>
                  </table>
                      {{-- kode dibawah juga digunakan untuk paginate , dan digabungkan dengan app servis provider yang berada di folder app provider --}}
                    
                  </div>
              </div>
            </div> 
            @else
            {{-- Pesan jika filter belum disubmit --}}
            <p class="text-center mt-5">Pilih filter untuk melihat data / Data kurang tepat.</p>
            @endif
   
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
       var presensiid = $(this).attr('data-id');
       swal({
           title: "Apa kamu yakin ?",
           text: "Apakah kamu yakin akan menghapus data presensi ini ?",
           icon: "warning",
           buttons: true,
           dangerMode: true,
       })
       .then((willDelete) => {
       if (willDelete) {
           //dibawah merupakan untuk memanggil fungsi menghapus dari route web.php
               window.location = "/deletepresensi/"+presensiid+""
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






