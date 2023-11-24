@extends('admin_layout')
@section('content')
<style>
.modal-title-assign-officer {
  color: #000000;
  font-family: 'Alkatra', cursive;
  font-family: 'Lobster', cursive;
  font-weight: bold;
}
.modal-label-select-officer {
  color: rgb(0, 0, 0); 
  font-weight: bold; 
  font-family: 'Alkatra', cursive;
  font-family: 'Lobster', cursive;
}
</style>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Crimes Reported
                    <a href="{{ url('admin/crime/create') }}" class="float-right btn btn-success btn-sm">Add New</a>
                </h6>
            </div>
            <div class="card-body">
                @if(Session::has('success'))
                    <p class="text-success">{{ session('success') }}</p>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>REF</th>
                                <th>Role</th>
                                <th>Gender</th>
                                <th>Crime Type</th>
                                <th>Description</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $report)
                                <tr>
                                    <td>{{ $report->random_code }}</td>
                                    <td>{{ $report->role }}</td>
                                    <td>{{ $report->gender }}</td>
                                    <td>{{ $report->crime_type }}</td>
                                    <td>{{ $report->description }}</td>
                                    <td>{{ $report->location }}</td>
                                    <td>{{ $report->status }}</td>
                                    <td>
                                        <a href="{{ url('admin/crime/' . $report->id . '/delete') }}" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this report?')" title="Delete"><i class="fa fa-trash"></i>
                                        </a>
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#assignModal{{$report->id}}" title="Assign Officer">
                                            <i class="fa fa-tasks"></i>
                                        </button>
                                        <a href="{{ url('admin/crime/' . $report->id . '/complete-investigation') }}" class="btn btn-success btn-sm" title="Investigation Completed">
                                            <i class="fa fa-check-square-o"></i>
                                        </a>
                                        <a href="{{ url('admin/crime/' . $report->id . '/inconclusive-investigation') }}" class="btn btn-danger btn-sm" title="Inconclusive Investigation">
                                            <i class="fa fa-ban"></i>
                                        </a>
                                    </td>
                                </tr>
                                <!-- Assign Officer Modal -->
                                <div class="modal fade" id="assignModal{{$report->id}}" tabindex="-1" role="dialog" aria-labelledby="assignModalLabel{{$report->id}}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title modal-title-assign-officer" id="assignModalLabel{{$report->id}}">Assign Officer</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                @if($officers->isEmpty())
                                                    <p class="text-danger">No officers available. Please add officers first.</p>
                                                @else
                                                    <form action="{{ url('admin/crime/assign-officer/' . $report->id) }}" method="post">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="officer_id" class="modal-label-select-officer">Select Officer:</label>
                                                            <select name="officer_id" id="officer_id" class="form-control" required>
                                                                <option value="" disabled selected>Select an officer</option>
                                                                @foreach($officers as $officer)
                                                                    <option value="{{ $officer->id }}">{{ $officer->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <button type="submit" class="btn btn-success">Assign</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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
