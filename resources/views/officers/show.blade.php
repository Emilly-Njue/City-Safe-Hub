@extends ('admin_layout')
@section ('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Officer Details
            <a href="{{url('admin/officers')}}" class="float-right btn btn-success btn-sm">View All</a>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th>Name</th>
                        <td>{{$data->name}}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{{$data->description}}</td>
                    </tr>
                    <tr>
                        <th>Officer Images</th>
                            <td>
                                @for ($i = 1; $i <= 2; $i++)
                                    @if ($data->{"image" . $i})
                                        <a href="{{ asset('storage/images/'.$data->{"image" . $i}) }}" data-lightbox="officer-images">
                                            <img src="{{ asset('storage/images/'.$data->{"image" . $i}) }}" alt="Officer Image" width="120" class="img-thumbnail">
                                        </a>
                                    @else
                                        No Image
                                    @endif
                                @endfor
                            </td>
                    </tr>
                </table>
            </div>
            
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<style>
    .img-thumbnail {
        height: auto;
        max-width: 150px;
        margin: 5px;
    }
</style>
@endsection

@section('scripts')
<!-- Lightbox library -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
@endsection