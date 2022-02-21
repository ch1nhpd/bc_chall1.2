@extends('teacher.main')

@section('content')

<div class="col-md-9 mx-auto">
    @include('alert')
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title"><b> Assignment [{{$assignment->description}}]</b></h3>
            </br>
            </br>
            File:
            <a href="/download/{{$assignment->linkfile}}"> {{$assignment->linkfile}} </a>
            </br>
            <div style="color: red;"> <b>Due to:</b> {{$assignment->due}} </div><!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        @if($fileSubmited)
        <div class="card-body">
            </br>
            <b> File submited:</b>
            <a href="/download/{{$fileSubmited->link_file}}"> {{$fileSubmited->link_file}} </a>
            </br>
            <div style="color: green;"><b>Time submit:</b> {{$fileSubmited->updated_at}}</div>
            
        </div>
        @else
        <form action="" method="post" enctype="multipart/form-data">
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputFile">File submit</label>
                    </br>
                    <input type="file" name="file_upload" enctype="multipart/form-data">
                </div>
            </div>
            <div class="card-footer">
                <input type="hidden" name="id" value="{{$assignment->id}}">
                <input type="submit" value="Turn in" class="btn btn-primary">
            </div>
            @csrf
        </form>
        @endif

        <!-- /.card -->
    </div>
</div>

@endsection()