@extends('teacher.main')

@section('content')

<div class="col-md-9 mx-auto">
        @include('alert')
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title"><b> Received Messages </b></h3>


                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <div class="mailbox-controls">
                    <div class="table-responsive mailbox-messages">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 20%">
                                        Time
                                    </th>
                                    <th style="width: 50%">
                                        Content
                                    </th>
                                    <th style="width: 25%">
                                        From
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($messages as $message)
                                <tr>
                                    <td class="mailbox-date">{{$message->updated_at}}</td>
                                    <td class="mailbox-subject">{{$message->content}}
                                    </td>
                                    <td class="mailbox-subject">{{$message->fullname}}
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