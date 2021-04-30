@extends('backend.layout')

@section('content')

    <div class="content">
        <div class="container-fluid">

            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="container">
                        <div class="card">
                            <div class="card-header">
                                <h3>Total Users List</h3>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#Sl</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Subscription</th>
                                        <th>Sub ID</th>
                                        <th>Registered</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($users as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item->name}}</td>
                                        <td><a href="mailto:{{$item->email}}">{{$item->email}}</a></td>
                                        <td>
                                            @if($item->is_paid)
                                                <div class="badge badge-success">Yes</div>
                                            @else
                                                <div class="badge badge-secondary">No</div>
                                            @endif
                                        </td>
                                        <td>{{$item->subscriptionId}}</td>
                                        <td>{{$item->created_at->diffForHumans()}}</td>
                                        <td>
                                            <a href="{{route('user.deleteUser', $item->id)}}" title="Delete the user" class="btn-sm bg-danger"><i class="fa fa-trash-alt"></i></a>

                                            @if($item->is_paid)
                                                <a href="{{route('user.subscribeToggle', $item->id)}}" title="Unsubscribe the User" class="btn-sm bg-warning">Unsub <i class="fa fa-bell-slash"></i></a>
                                            @else
                                                <a href="{{route('user.subscribeToggle', $item->id)}}" title="Subscribe the User" class="btn-sm bg-info">Sub <i class="fa fa-bell"></i></a>
                                            @endif
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
