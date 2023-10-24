@extends ('admin_layout')
@section ('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Officers
            <a href="{{url('add_officers.index')}}" class="float-right btn btn-success btn-sm">View All</a>
            </h6>
        </div>
        <div class="card-body">

            @if($errors->any())
                @foreach($errors->all() as $error)
                    <p class="text-danger">{{$error}}</p>
                @endforeach
            @endif

            @if(Session::has('success'))
                <p class="text-success">{{session('success')}}</p>
            @endif
            <div class="table-responsive">
                <form enctype="multipart/form-data" method="post" action="{{url('add_officers.store')}}">
                    @csrf
                    <table class="table table-bordered">
                        <tr>
                            <th>Name</th>
                            <td><input name="name" type="text" class ="form-control"></td>
                        </tr>
                        <tr>
                            <th>Badge Number</th>
                            <td><input name="badge_number" type="number" class ="form-control"></td>
                        </tr>
                        <tr>
                            <th>Rank</th>
                            <td><textarea name="detail" class ="form-control"></textarea></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="submit" class ="btn btn-primary">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
</div>

</div>
<!-- /.container-fluid -->

@endsection