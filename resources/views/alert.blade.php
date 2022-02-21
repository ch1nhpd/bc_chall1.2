@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if(Session::has('error'))
<div class="alert alert-danger">
    <ul>
        {{Session::get('error')}}
    </ul>
</div>

@endif

@if(Session::has('success'))
<div class="alert alert-success">
    <ul>
        {{Session::get('success')}}
    </ul>
</div>
@endif

@if(Session::has('right-answer'))
<input type="hidden" id='contentAnswer' value="{{Session::get('right-answer')}}">
<script>
    var content = document.getElementById('contentAnswer').value;
    content = 'CONGRATULATION!! \n\n THIS IS CONTENT FILE: \n --------\n\n'+ content;
    alert(content);
</script>
@elseif(Session::has('wrong-answer'))
<script>
    alert('Wrong Answer')
</script>
@endif