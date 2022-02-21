@extends('teacher.main')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Users</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Users</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    @if($role==='T')
    <div class="card">
        <div class="card-header">
            <a href='/home/users/add'>
                <span class="btn btn-success col fileinput-button dz-clickable">
                    <i class="fas fa-plus"></i>
                    <span>Add User</span>
                </span>
            </a>
        </div>
    </div>
    @endif
    @include('alert')
    <div class="card-body p-0">
        <table class="table table-striped projects">
            <thead>
                <tr>
                    <th style="width: 1%" class="text-center">
                        #
                    </th>
                    <th style="width: 12%">
                        Username
                    </th>
                    <th style="width: 18%">
                        Full name
                    </th>
                    <th style="width: 18%">
                        Email
                    </th>
                    <th style="width: 12%" class="text-center">
                        Phone Number
                    </th>
                    <th style="width: 10%" class="text-center">
                        Role
                    </th>
                    <th style="width: 20%" class="text-center">
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>
                        #
                    </td>
                    <td>
                        <a>
                            {{$user->username}}
                        </a>
                        <br />
                        <!-- <small>
                            Created 01.01.2022
                        </small> -->
                    </td>
                    <td>
                        <ul class="list-inline">
                            {{$user->fullname}}
                        </ul>
                    </td>
                    <td class="project_progress">
                        {{$user->email}}
                    </td>
                    <td class="project-state">
                        {{$user->sdt}}
                    </td>
                    <td class="project-state">
                        {{$user->role}}
                    </td>
                    <td class="column-verticallineMiddle form-inline" style="vertical-align:middle;" class="project-actions text-right">
                        <form action="/home/users/p" method="get" style="margin-right: 2%;">
                            <input type="hidden" name='id' value="{{$user->id}}">
                            <input type="submit" value="Details" class="btn btn-primary btn-sm">
                        </form>
                        @if($role==='T')
                        <form action="/home/users/edit" method="get" style="margin-right: 2%;">
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <input type="submit" value="Edit" class="btn btn-info btn-sm">
                            @csrf
                        </form>

                        <form action="/home/users/delete" method="post" style="margin-right: 2%;">
                            <input type="hidden" name='id' value="{{$user->id}}">
                            <input type="submit" value="🗑 Delete" class="btn btn-danger btn-sm">
                            @csrf
                        </form>
                        @endif


                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
    </div>
    <!-- /.card -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection()