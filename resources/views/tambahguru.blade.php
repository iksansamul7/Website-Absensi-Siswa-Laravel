@extends('layout.admin')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tambah Data Guru</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">Tambah Data Guru</li>
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
                    <form action="/insertguru" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Nip</label>
                          <input type="text" name="nip" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                          @error('nip') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Nama</label>
                          <input type="text" name="namaguru" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                          @error('namaguru') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                            @error('email') <div class="alert alert-danger">{{ $message }}</div> @enderror
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







