@extends('admin_layout')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Officers
            <a href="{{url('admin/officers/create')}}" class="float-right btn btn-success btn-sm">Add New</a>
        </h6>
    </div>
    <div class="card-body">
        @if(Session::has('success'))
            <p class="text-success">{{session('success')}}</p>
        @endif
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Officer</th>
                        <th>Email</th>
                        <th>Rank</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @if($data)
                        @foreach($data as $d)
                        <tr>
                            <td>{{$d->id}}</td>
                            <td>{{$d->addOfficer->name}}</td>
                            <td>{{$d->addOfficer->email}}</td>
                            <td>{{$d->addOfficer->rank}}</td>
                            <td>
                                <a href="{{url('admin/officers/'.$d->id)}}" class="btn btn-info btn-sm"><i class= "fa fa-eye"></i></a>
                                <a href="{{url('admin/officers/'.$d->id.'/edit')}}" class="btn btn-primary btn-sm"><i class= "fa fa-edit"></i></a>
                                <a onclick="return confirm('Are you sure you want to delete this data?')" href="{{url('admin/officers/'.$d->id.'/delete')}}" class="btn btn-danger btn-sm"><i class= "fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->

@section('scripts')
<!-- Custom styles for this page -->
<link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<!-- Page level plugins -->
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>

<!-- Lightbox library -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('js/datatables-demo.js') }}"></script>

<style>
    .img-thumbnail {
        height: auto;
        max-width: 150px;
        margin: 5px;
    }
</style>
<script>
    $(document).ready(function() {
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true
        });
    });
</script>

@endsection

@endsection
