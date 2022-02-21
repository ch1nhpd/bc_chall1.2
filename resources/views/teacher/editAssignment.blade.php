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
                <h1>Update Assignments</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Assignments</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

@include('alert')

<!-- Main content -->
<div class="col-md-6">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Assignment</h3>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="card-body">
                <div class="form-group">
                    <label>Description</label>
                    <input type="text" class="form-control" name="description" value="{{$assignment->description}}" placeholder="Enter Description">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">File input</label>
</br>
                    <input type="file" name="file_upload" enctype="multipart/form-data">
                </div>
                <div class="form-group ">
                    <label for="exampleInputFile">Due to</label>
                    <div class="w-100">
                        <div class="input-group date" id="id_0">
                            <input type="text" name="due" class="form-control" value="{{$assignment->due}}" placeholder="MM/DD/YYYY hh:mm:ss" required />
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <input type="hidden" name="id" value="{{$assignment->id}}">
                <input type="submit" value="Update" class="btn btn-primary">
            </div>
            @csrf
        </form>
    </div>
</div>

<script src="/template/custom/js/jquery.min.js"></script>
<script src="/template/custom/js/popper.js"></script>
<script src="/template/custom/js/bootstrap.min.js"></script>
<script src="/template/custom/js/moment-with-locales.min.js"></script>
<script src="/template/custom/js/bootstrap-datetimepicker.min.js"></script>
<script src="/template/custom/js/main.js"></script>


<!-- /.content-wrapper -->
@endsection()