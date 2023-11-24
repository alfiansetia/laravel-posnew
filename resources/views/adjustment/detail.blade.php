@extends('layouts.template')

@section('content')
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Detail {{ $title }} <span
                                    class="badge badge-{{ $data->status === 'cancel' ? 'danger' : 'success' }}">{{ $data->status }}</span>
                                <a href="{{ route('adjustment.edit', $data->id) }}"><i class="fas fa-edit ml-1"></i></a>
                            </h3>

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
                                    <h3 class="text-primary"><i class="fas fa-pencil-alt mr-1"></i>
                                        [{{ $data->product->code ?? '-' }}] {{ $data->product->name ?? '-' }}
                                    </h3>
                                    <h5 class="text-muted">{{ $data->date }} [{{ $data->user->name ?? '-' }}]</h5>
                                    <p class="text-muted">{{ $data->desc }}</p>
                                </div>
                                <div class="col-12 col-md-12 col-lg-2 order-2 order-md-2">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="info-box bg-light">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center text-muted">Current Value</span>
                                                    <span
                                                        class="info-box-number text-center text-muted mb-0">{{ $data->current_value }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-2 order-2 order-md-2">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="info-box bg-light">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center text-muted">Value</span>
                                                    <span
                                                        class="info-box-number text-center text-muted mb-0">{{ $data->type }}
                                                        {{ $data->value }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-2 order-2 order-md-2">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="info-box bg-light">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center text-muted">After Value</span>
                                                    <span
                                                        class="info-box-number text-center text-muted mb-0">{{ $data->after_value }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mt-5 mb-3">
                                <a href="{{ route('adjustment.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left mr-1"></i>Back
                                </a>
                                @if ($data->status != 'cancel')
                                    <button type="button"
                                        onclick="deleteData('{{ route('adjustment.destroy', $data->id) }}')"
                                        class="btn btn-danger">
                                        <i class="fas fa-trash mr-1"></i>Cancel
                                    </button>
                                @endif
                                <a href="{{ route('adjustment.create') }}" class="btn btn-primary">
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

    <form action="{{ route('adjustment.destroy', $data->id) }}" method="POST" id="form_delete">
        @csrf
        @method('DELETE')
    </form>
@endsection
@push('jslib')
@endpush
