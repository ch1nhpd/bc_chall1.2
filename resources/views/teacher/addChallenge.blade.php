@extends('teacher.main')
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="/template/custom/css/style.css">
<link rel="stylesheet" href="/template/custom/css/bootstrap-datetimepicker.min.css">
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Add Challenge</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Challenge</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

@include('alert')

<!-- Main content -->
<div class="row d-flex justify-content-center">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Challenge</h3>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group">
                        <label>Challenge Name</label>
                        <input type="text" class="form-control" name="description" placeholder="Enter Name">
                    </div>
                    <div class="form-group">
                        <label>Hint</label>
                        <input type="text" class="form-control" name="hint" placeholder="Enter Hint">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputFile">File input</label>
                        </br>
                        <input type="file" name="file_upload" enctype="multipart/form-data">
                    </div>
                </div>
                <div class="card-footer">
                    <input type="submit" value="Create Challenge" class="btn btn-primary">
                </div>
                @csrf
            </form>
        </div>
    </div>
</div>


<!-- /.content-wrapper -->
@endsection()