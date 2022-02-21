@extends('teacher.main')

@section('content')

<div class="col-md-9 mx-auto">
    @include('alert')
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title"><b> Challenge [{{$challenge->description}}]</b></h3>
            </br>
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
                                <th style="width: 45%">
                                    Student
                                </th>
                                <th style="width: 25%">
                                    Points
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($submitedList as $chall)
                            <tr>
                                <td class="mailbox-date">{{$chall->updated_at}}</td>
                                <td>{{$chall->fullname}}
                                </td>
                                <td>{{$chall->points}}</td>
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