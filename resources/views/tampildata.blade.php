</html>
@extends('layout.admin')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tambah Data</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">Tambah Data</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    

    <div class="container">
      <div class="row justify-content-center">
          <div class="col-8">
              <div class="card">
                  <div class="card-body">
                      <form action="/updatedata/{{ $data->id }}" method="post" enctype="multipart/form-data">
                          @csrf
                            <div class="mb-3">
                              <label for="exampleInputEmail1" class="form-label">Nis/Nisn</label>
                              <input type="number" name="nissiswa" value="{{ $data->nissiswa }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                              @error('nissiswa') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nama</label>
                                <input type="text" name="nama" value="{{ $data->nama }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                @error('nama') <div class="alert alert-danger">{{ $message }}</div> @enderror
                              </div>
                              <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Pilih Kelas</label>
                                <select class="form-control" name="kelas_id" aria-label="Default select example" required>
                                  <option disabled value>Pilih Kelas</option>
                                  @foreach ($kelas as $item)
                                  <option value="{{ $item->id }}">{{ $item->namakelas }}</option>
                                  @endforeach
                                </select>
                              </div>
                              <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Pilih Tahun Semester</label>
                                <select class="form-select" name="semester_id" aria-label="Default select example" required>
                                  <option disabled value>Pilih Tahun Semester</option>
                                  @foreach ($semester as $item)
                                  <option value="{{ $item->id }}">{{ $item->semester }}</option>
                                  @endforeach
                                </select>
                              </div>
                              <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Tipe Kelas</label>
                                <select class="form-control" name="tipekelas" aria-label="Default select example">
                                  <option selected>Pilih Tipe Kelas</option>
                                  <option value="reguler">Reguler</option>
                                  <option value="aliyah">Aliyah</option>
                                </select>
                              </div>
                            <div class="mb-3">
                              <label for="exampleInputPassword1" class="form-label">Jenis Kelamin</label>
                              <select class="form-select" name="jeniskelamin" aria-label="Default select example" required>
                                <option selected>{{ $data->jeniskelamin }}</option>
                                <option value="cowok">Cowok</option>
                                <option value="cewek">Cewek</option>
                              </select>
                            </div>
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
    <!-- /.content -->
  </div>


@endsection







