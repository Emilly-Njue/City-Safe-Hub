@extends ('admin_layout')
@section ('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Officers
            <a href="{{url('admin/add_officers')}}" class="float-right btn btn-success btn-sm">View All</a>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th>Name</th>
                        <td>{{$officer->name}}</td>
                    </tr>
                    <tr>
                        <th>Officer Email</th>
                        <td>{{$officer->email}}</td>
                    </tr>
                    <tr>
                        <th>Badge Number</th>
                        <td>{{$officer->badge_number}}</td>
                    </tr>
                    <tr>
                        <th>Rank</th>
                        <td>{{$officer->rank}}</td>
                    </tr>
                </table>
            </div>
        </div>
</div>

</div>
<!-- /.container-fluid -->

@endsection