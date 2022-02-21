@extends('teacher.main')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">User Edit</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Edit User</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
@include('alert')
<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-md-7 mx-auto">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Input Info</h3>

                </div>
                <div class="card-body">
                    <form action="/home/users/update" method="post">
                        <input type="hidden" id="id" name="id" value="{{$user->id}}">
                        
                        @if($user->role === "T")
                        <div class="form-group">
                            <label for="inputName"> Full Name</label>
                            <input type="text" id="inputName" name="fullname" value="{{$user->fullname}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" value="{{$user->username}}" class="form-control">
                        </div>
                        @else
                        <input type="hidden" id="inputName" name="fullname" value="{{$user->fullname}}" class="form-control">
                        <input type="hidden" id="username" name="username" value="{{$user->username}}" class="form-control">
                        @endif 
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" id="email" name="email" value="{{$user->email}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" id="phonenumber" name="phonenumber" value="{{$user->sdt}}" class="form-control">
                        </div>
                        <div class="col-12">
                            <input type="submit" value="Update User" class="btn btn-success float-right">
                        </div>
                        @csrf
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>

    </div>

</section>
<!-- /.content -->
</div>

@endsection()