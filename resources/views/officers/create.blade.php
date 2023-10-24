@extends ('admin_layout')
@section ('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Officer
            <a href="{{url('admin/officers')}}" class="float-right btn btn-success btn-sm">View All</a>
            </h6>
        </div>
        <div class="card-body">
            @if(Session::has('success'))
                <p class="text-success">{{session('success')}}</p>
            @endif
            <div class="table-responsive">
                <form method="post" action="{{url('admin/officers')}}" enctype="multipart/form-data">
                    @csrf
                    <table class="table table-bordered">
                        <tr>
                            <th>Select An Officer</th>
                            <td>
                                <select name= "of_id" class="form-control">
                                    <option value= "0">---- Select ----</option>
                                    @foreach($officer as $of)
                                    <option value="{{$of->id}}">{{$of->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>About</th>
                            <td><textarea name="rank" class="form-control" rows="4"></textarea></td>
                        </tr>
                        <tr>
                            <th>Image 1</th>
                            <td><input type="file" name="images[]" class="form-control-file"></td>
                        </tr>
                        <tr>
                            <th>Image 2</th>
                            <td><input type="file" name="images[]" class="form-control-file"></td>
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