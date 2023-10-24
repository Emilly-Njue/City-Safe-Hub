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
            @if(Session::has('success'))
                <p class="text-success">{{session('success')}}</p>
            @endif
            <div class="table-responsive">
                <form enctype="multipart/form-data" method="post" action="{{url('admin/add_officers/'.$officer->id)}}">
                    @csrf
                    @method('put')
                    <table class="table table-bordered">
                        <tr>
                            <th>Name</th>
                            <td><input value="{{$officer->name}}" name="name" type="text" class ="form-control"></td>
                        </tr>
                        <tr>
                            <th>Badge Number</th>
                            <td><input value="{{$officer->price}}" name="badge_number" type="number" class ="form-control"></td>
                        </tr>
                        <tr>
                            <th>Rank</th>
                            <td>
                                <select name="rank" class ="form-control">{{$officer->rank}}
                                    <option value="">Select Rank</option>
                                    <option value="Officer/Constable">Officer/Constable</option>
                                    <option value="Sergeant">Sergeant</option>
                                    <option value="Inspector">Inspector</option>
                                    <option value="Lieutenant">Lieutenant</option>
                                    <option value="Corporal">Corporal</option>
                                    <option value="Detective">Detective</option>
                                    <option value="Deputy Chief">Deputy Chief</option>
                                    <option value="Assistant Chief">Assistant Chief</option>
                                </select>
                            </td>
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