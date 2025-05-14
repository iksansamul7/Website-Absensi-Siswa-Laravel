</html>
@extends('layout.admin')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Update Pelajaran</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">Update Pelajaran</li>
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
                      <form action="/updatepelajaran/{{ $data->id }}" method="post" enctype="multipart/form-data">
                          @csrf
                            <div class="mb-3">
                              <label for="exampleInputEmail1" class="form-label">Kode Pelajaran</label>
                              <input type="number" value="{{ $data->kodepelajaran}}" name="kodepelajaran" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                            </div>
                            <div class="mb-3">
                              <label for="exampleInputEmail1" class="form-label">Nama Pelajaran</label>
                              <input type="text" value="{{ $data->namapelajaran}}" name="namapelajaran" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
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







