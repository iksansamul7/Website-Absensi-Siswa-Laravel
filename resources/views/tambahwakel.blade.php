@extends('layout.admin')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tambah Data Wali Kelas</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">Tambah Data Wali Kelas</li>
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
                    <form action="/insertwakel" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                          <label for="exampleInputPassword1" class="form-label">Pilih Kelas</label>
                          <select class="form-control" name="kelas_id" aria-label="Default select example" required>
                            <option selected>Pilih Kelas</option>
                            @foreach ($personkelas as $item)
                            <option value="{{ $item->id }}">{{ $item->namakelas }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="exampleInputPassword1" class="form-label">Pilih Guru</label>
                          <select class="form-control" name="guru_id" aria-label="Default select example" required>
                            <option selected>Pilih Guru</option>
                            @foreach ($personguru as $item)
                            <option value="{{ $item->id }}">{{ $item->namaguru }}</option>
                            @endforeach
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







