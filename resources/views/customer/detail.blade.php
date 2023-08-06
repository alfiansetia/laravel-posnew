@extends('layouts.template')

@section('content')
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Detail {{ $title }} <a
                                    href="{{ route('customer.edit', $data->id) }}"><i class="fas fa-edit ml-1"></i></a></h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-6 order-1 order-md-1">
                                    <h3 class="text-primary"><i class="fas fa-truck mr-1"></i> {{ $data->name }}</h3>
                                    <div class="text-muted">
                                        <p class="text-sm">Email
                                            <b class="d-block">{{ $data->email }}</b>
                                        </p>
                                        <p class="text-sm">Phone
                                            <b class="d-block">{{ $data->phone }}</b>
                                        </p>
                                        <p class="text-sm">Address
                                            <b class="d-block">{{ $data->address }}</b>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-6 order-2 order-md-2">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="info-box bg-light">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center text-muted">Total Product</span>
                                                    <span
                                                        class="info-box-number text-center text-muted mb-0">{{ $data->product_count }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mt-5 mb-3">
                                <a href="{{ route('customer.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left mr-1"></i>Back
                                </a>
                                <a href="{{ route('customer.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus mr-1"></i>Add Data
                                </a>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->

    </div>
    <!-- /.content -->
@endsection
