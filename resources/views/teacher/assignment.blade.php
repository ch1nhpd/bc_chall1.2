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
            <div style="color: red;"> Due to: {{$assignment->due}} </div><!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <div class="mailbox-controls">
                <div class="table-responsive mailbox-messages">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th style="width: 20%">
                                    Time Submit
                                </th>
                                <th style="width: 50%">
                                    File
                                </th>
                                <th style="width: 25%">
                                    Student
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($submitedList as $ass)
                            <tr>
                                <td class="mailbox-date">{{$ass->updated_at}}</td>
                                <td>
                                <a href="/download/{{$ass->link_file}}"> {{$ass->link_file}} </a>
                                </td>
                                <td>{{$ass->fullname}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- /.table -->
                </div>
                <!-- /.mail-box-messages -->
            </div>
            <!-- /.card-body -->

        </div>
        <!-- /.card -->
    </div>
</div>

@endsection()