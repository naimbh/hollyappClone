@extends('backend.layout')

@section('content')

    <div class="content">
        <div class="container-fluid">

            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="container">
                        <div class="card">
                            <div class="card-header">
                                <h3>Total Notes List</h3>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#Sl</th>
                                        <th>Tree Name</th>
                                        <th>Is Protected</th>
                                        <th>User Name</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($notes as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td><a href="{{route('note.create', $item->slug)}}">{{$item->name}}</a></td>
                                            <td>
                                                @if($item->is_protected)
                                                    <div class="badge badge-success">Yes</div>
                                                @else
                                                    <div class="badge badge-secondary">No</div>
                                                @endif
                                            </td>
                                            <td>{{$item->user != null ? $item->user->name : ''}}</td>
                                            <td>{{$item->created_at->diffForHumans()}}</td>
                                            <td>
                                                <a href="{{route('note.deleteNote', $item->id)}}"
                                                   title="Delete the user" class="btn-sm bg-danger"><i
                                                        class="fa fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    @push('js')
        <script>
            $(function () {
                $("#example1").DataTable({
                    "responsive": true,
                    "autoWidth": false,
                });
            });
        </script>
    @endpush

@endsection
