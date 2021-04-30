@extends('backend.layout')

@section('content')

    <div class="content">
        <div class="container-fluid">

            <div class="row text-center justify-content-center">
                <div class="col-sm-12 col-lg-4 col-md-6">
                    <!-- small box -->
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3>{{$users->count()}}</h3>

                            <p>Total Registered Users</p>
                            <small class="badge badge-danger"> (All Time)</small>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{route('admin.users')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-sm-12 col-lg-4 col-md-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{$users->where('is_paid', true)->count()}}</h3>

                            <p>Premium Members</p>
                            <small class="badge badge-danger"> (All Time)</small>

                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{route('admin.users')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-sm-12 col-lg-4 col-md-6">
                    <!-- small box -->
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{$notes->count()}}</h3>

                            <p class="text-white">Total Notes</p>
                            <small class="badge badge-danger"> (All Time)</small>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{route('admin.notes')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

@endsection
