@extends('teacher.main')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>List Assignments</h1>
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
<!-- Main content -->
<section class="content">

    <!-- Default box -->
    @if($role==='T')
    <div class="card">
        <div class="card-header">
            <a href='/assignments/add'>
                <span class="btn btn-success col fileinput-button dz-clickable">
                    <i class="fas fa-plus"></i>
                    <span>Add Assignment</span>
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
                    <th style="width: 20%">
                        Due to
                    </th>
                    <th style="width: 50%">
                        Description
                    </th>
                    <th style="width: 30%">
                        #
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($assignments as $assignment)
                <tr>
                    <td>
                        <a>
                            {{$assignment->due}}
                        </a>
                    </td>
                    <td>
                        <ul class="list-inline">
                            {{$assignment->description}}
                        </ul>
                    </td>
                    <td class="column-verticallineMiddle form-inline" style="vertical-align:middle;" class="project-actions text-right">
                        
                        @if($role==='T')
                        <form action="/assignments/view" method="get" style="margin-right: 2%;">
                            <input type="hidden" name='id' value="{{$assignment->id}}">
                            <input type="submit" value="Details" class="btn btn-primary btn-sm">
                        </form>
                        <form action="/assignments/edit" method="get" style="margin-right: 2%;">
                            <input type="hidden" name="id" value="{{$assignment->id}}">
                            <input type="submit" value="Edit" class="btn btn-info btn-sm">
                            @csrf
                        </form>

                        <form action="/assignments/delete" method="post" style="margin-right: 2%;">
                            <input type="hidden" name='id' value="{{$assignment->id}}">
                            <input type="submit" value="🗑 Delete" class="btn btn-danger btn-sm">
                            @csrf
                        </form>
                        @else
                        <form action="/assignments/submit" method="get" style="margin-right: 2%;">
                            <input type="hidden" name='id' value="{{$assignment->id}}">
                            <input type="submit" value="Details" class="btn btn-primary btn-sm">
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