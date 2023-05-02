@extends('layout.template')
 <!-- START FORM -->
 @section('content')

 <form action='{{ url('student/'.$data->id)}}' method='post'>
@csrf
@method('PUT')
<div class="my-3 p-3 bg-body rounded shadow-sm">
    <a href='{{ url('student') }}' class="btn btn-secondary"><< Back</a>
    <div class="mb-3 row">
        <label for="id" class="col-sm-2 col-form-label">ID</label>
        <div class="col-sm-10">
            {{ $data->id }}
        </div>
    </div>
    <div class="mb-3 row">
        <label for="name" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name='name' value="{{ $data->name }}" id="name">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="major" class="col-sm-2 col-form-label">Major</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name='major' value="{{ $data->major }}" id="major">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="major" class="col-sm-2 col-form-label"></label>
        <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SAVE</button></div>
    </div>
</div>
</form>
<!-- AKHIR FORM -->
@endsection