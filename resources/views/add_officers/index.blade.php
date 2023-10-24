@extends ('admin_layout')
@section ('content')

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Room Types
            <a href="{{url('admin/add_officers/create')}}" class="float-right btn btn-success btn-sm">Add New</a>
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
                        <th>Name</th>
                        <th>Badge Number</th>
                        <th>Rank</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Badge Number</th>
                        <th>Rank</th>
                    </tr>
                </tfoot>
                <tbody>
                    @if($officers)
                        @foreach($officers as $d)
                        <tr>
                            <td>{{$d->id}}</td>
                            <td>{{$d->name}}</td>
                            <td>{{$d->badge_number}}</td>
                            <td>
                                <a href="{{url('admin/add_officers/'.$d->id)}}" class="btn btn-info btn-sm"><i class= "fa fa-eye"></i></a>
                                <a href="{{url('admin/add_officers/'.$d->id.'/edit')}}" class="btn btn-primary btn-sm"><i class= "fa fa-edit"></i></a>
                                <a onclick="return confirm('Are you sure to delete this data?')" href="{{url('admin/add_officers/'.$d->id.'/delete')}}" class="btn btn-danger btn-sm"><i class= "fa fa-trash"></i></a>
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

<!-- Page level custom scripts -->
<script src="{{ asset('js/datatables-demo.js') }}"></script>

@endsection

@endsection