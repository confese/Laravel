@extends('layout.template')
<!-- START DATA -->
@section('content')
<div class="my-3 p-3 bg-body rounded shadow-sm">
    <!-- FORM PENCARIAN -->
    <div class="pb-3">
        <form class="d-flex" action="{{ url('student') }}" method="get">
            <input class="form-control me-1" type="search" name="keyword" value="{{ Request::get('keyword') }}" placeholder="Enter Keyword" aria-label="Search">
            <button class="btn btn-secondary" type="submit">Search</button>
        </form>
    </div>
                
    <!-- TOMBOL TAMBAH DATA -->
    <div class="pb-3">
        <a href='{{ url('student/create') }}' class="btn btn-primary">+ Add Data</a>
    </div>
          
    <table class="table table-striped">
        <thead>
            <tr>
                <th class="col-md-1">No</th>
                <th class="col-md-3">ID</th>
                <th class="col-md-4">Name</th>
                <th class="col-md-2">Major</th>
                <th class="col-md-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = $data->firstItem() ?>
            @foreach ($data as $item)   
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->major }}</td>
                <td>
                    <a href='{{ url('student/'.$item->id.'/edit')}}' class="btn btn-warning btn-sm">Edit</a>
                    <form onsubmit="return confirm('Are you sure want to delete data?')" class='d-inline' action="{{ url('student/'.$item->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" name="submit" class="btn btn-danger btn-sm">Del</button>
                    </form>
                </td>
            </tr>
            <?php $i++ ?>
            @endforeach
        </tbody>
    </table>    
    {{ $data->withQueryString()->links() }}        
</div>
<!-- AKHIR DATA -->
@endsection