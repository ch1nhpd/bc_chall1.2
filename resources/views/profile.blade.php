@extends('teacher.main')

@section('content')
<div class="row">
    <div class="col-12 col-sm-6 col-md-6 d-flex align-items-stretch flex-column">
        <div class="card bg-light d-flex flex-fill">
            <div class="card-header text-muted border-bottom-0">
                @if($user->role =='T')
                Teacher
                @else
                Student
                @endif
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-7">
                        <h2 class="lead"><b>{{$user->fullname}}</b></h2>
                        <p class="text-muted text-sm"><b>Username: </b> {{$user->username}}</p>
                        <ul class="ml-4 mb-0 fa-ul text-muted">
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-envelope"></i></span> Email: {{$user->email}}</li>
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: {{$user->sdt}}</li>
                        </ul>
                        </br>
                        <p class="text-muted text-sm"><b>Created at: </b>{{$user->created_at}}</p>
                        </br>
                        <p class="text-muted text-sm"><b>Thanh tich: </b> Chua co trong DB</p>
                    </div>
                    <div class="col-5 text-center">
                        <img src="https://thumbs.dreamstime.com/b/young-man-private-avatar-icon-brunette-brown-sweater-glasses-social-networks-business-users-75205463.jpg" alt="user-avatar" class="img-circle img-fluid">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="text-right">

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        <i class="fas fa-comments"></i>
                        Send Message
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->
    <div class="col-md-6">
        @include('alert')
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Messages sent to <b>{{$user->fullname}}</b></h3>
            </div>
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
                                    <th style="width: 15%">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($messages as $message)
                                <tr>
                                    <td class="mailbox-date">{{$message->updated_at}}</td>
                                    <td class="mailbox-subject ">
                                        <form action="/messages/update" method="post" style="margin-right: 2%;">
                                        <input name="content" value="{{$message->content}}" style="width: 70%">
                                            <input type="hidden" name="id" value="{{$message->id}}">
                                            <input type="submit" value="Update" class="btn-update-m btn btn-info btn-sm " data-toggle="modal" data-target="#ModalUpdate">
                                            @csrf
                                        </form>
                                    </td>
                                    <td class="project-actions text-right">
                                        <form action="/messages/delete" method="post" style="margin-right: 2%;">
                                            <input type="hidden" name='id' value="{{$message->id}}">
                                            <input type="submit" value="🗑 Delete" class="btn btn-danger btn-sm">
                                            @csrf
                                        </form>
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
    <!-- Modal send message-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Send to {{$user->fullname}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/messages/send" method="post">
                    <input type="text" id="content" name="content" placeholder="Input Message Here" class="form-control">
                    <input type="hidden" name="id" value="{{$user->id}}">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                    @csrf
                </form>
            </div>
        </div>
    </div>

</div>

@endsection()