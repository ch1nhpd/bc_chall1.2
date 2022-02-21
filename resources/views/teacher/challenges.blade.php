@extends('teacher.main')

@section('content')
@include('alert')

<div class="card">
    <div class="card-header border-0">
        <h2 class="card-title" style="color: blue;"><b>Challenges</b></h3>
            @if($role==='T')
            <div class="card-tools">
                <a href="/challenges/add" class="btn btn-success btn-sm">
                    <i class="fas fa-plus-circle" style="border: 1px;"></i> <span style="margin: 5px;">New</span>
                </a>
            </div>
            @endif
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-striped table-valign-middle">
            <thead style="background-color: aquamarine;">
                <tr>
                    <th style="width: 20%">Challenge Name</th>
                    <th>Hint</th>
                    <th style="width: 20%">Create at</th>
                    <th> #</th>
                </tr>
            </thead>
            <tbody>
                @foreach($challenges as $challenge)
                <tr>
                    <td>
                        {{$challenge->description}}
                    </td>
                    <td>
                        @if($role==='T')
                        {{$challenge->hint}}
                        @else
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#showhintModel{{$challenge->id}}">
                            <i class="fas fa-eye"></i>
                            Show hint
                        </button>
                        @endif
                    </td>
                    <td>
                        {{$challenge->updated_at}}
                    </td>
                    <td class="column-verticallineMiddle form-inline" style="vertical-align:middle;" class="project-actions text-right">
                        @if($role==='T')
                        <form action="/challenges/view" method="get" style="margin-right: 2%;">
                            <input type="hidden" name='id' value="{{$challenge->id}}">
                            <input type="submit" value="Details" class="btn btn-primary btn-sm">
                        </form>
                        <form action="/challenges/delete" method="post" style="margin-right: 2%;">
                            <input type="hidden" name="id" value="{{$challenge->id}}">
                            <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                            @csrf
                        </form>
                        @else
                        <form action="/challenges/submit" method="post" style="margin-right: 2%;">
                            <input type="hidden" name="id" value="{{$challenge->id}}">
                            <input type="button" value="Submit" class="btn btn-success btn-sm" data-toggle="modal" data-target="#submitModel{{$challenge->id}}">
                            @csrf
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@foreach($challenges as $challenge)
<div class="modal fade" id="showhintModel{{$challenge->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hint</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div style="margin: 5%; ">
                {{$challenge->hint}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="submitModel{{$challenge->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{$challenge->description}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/challenges/submit" method="post">
                <input type="text" id="content" name="answer" placeholder="Input Your Answer Here" class="form-control">
                <input type="hidden" name="id" value="{{$challenge->id}}">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                @csrf
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection()