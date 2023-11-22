@extends('layouts.template')

@push('csslib')
@endpush

@section('content')
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit {{ $title }}</h3>

                            <div class="card-tools">
                                <a href="{{ route('adjustment.index') }}" class="btn btn-sm btn-primary mr-2"><i
                                        class="fas fa-arrow-left mr-1"></i> Back</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form id="form" class="form-horizontal" method="POST"
                                action="{{ route('adjustment.update', $data->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="product" class="col-sm-2 col-form-label">Product</label>
                                        <div class="col-sm-10">
                                            <select name="product" id="product"
                                                class="form-control @error('product') is-invalid @enderror"
                                                style="width: 100%;" required readonly disabled>
                                                <option value="{{ $data->product_id ?? '' }}">
                                                    {{ $data->product->name ?? 'Select Product' }}</option>
                                            </select>
                                            @error('product')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="type" class="col-sm-2 col-form-label">Type</label>
                                        <div class="col-sm-10">
                                            <select name="type" id="type"
                                                class="form-control select2 @error('type') is-invalid @enderror"
                                                style="width: 100%;" required readonly disabled>
                                                <option value="">Select Type</option>
                                                <option value="plus" {{ $data->type == 'plus' ? 'selected' : '' }}>plus
                                                </option>
                                                <option value="minus" {{ $data->type == 'minus' ? 'selected' : '' }}>minus
                                                </option>
                                            </select>
                                            @error('type')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="value" class="col-sm-2 col-form-label">Value</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="value"
                                                class="form-control @error('value') is-invalid @enderror" id="value"
                                                placeholder="value" value="{{ $data->value ?? 1 }}" min="1" required
                                                readonly disabled>
                                            @error('value')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="current_value" class="col-sm-2 col-form-label">Current Value</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="current_value"
                                                class="form-control @error('current_value') is-invalid @enderror"
                                                id="current_value" placeholder="Current Value"
                                                value="{{ $data->current_value ?? 1 }}" min="1" required readonly
                                                disabled>
                                            @error('current_value')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="after_value" class="col-sm-2 col-form-label">After Value</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="after_value"
                                                class="form-control @error('after_value') is-invalid @enderror"
                                                id="after_value" placeholder="After Value"
                                                value="{{ $data->after_value ?? 1 }}" min="1" required readonly
                                                disabled>
                                            @error('after_value')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="desc" class="col-sm-2 col-form-label">Description</label>
                                        <div class="col-sm-10">
                                            <textarea name="desc" id="desc" class="form-control @error('desc') is-invalid @enderror"
                                                placeholder="Description" maxlength="100" autofocus>{{ $data->desc }}</textarea>
                                            @error('desc')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="reset" class="btn btn-warning mr-2"><i
                                                    class="fas fa-undo mr-1"></i>Reset</button>
                                            <button type="submit" class="btn btn-info"><i
                                                    class="fas fa-paper-plane mr-1"></i>Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->

    </div>
    <!-- /.content -->
@endsection

@push('jslib')
    <!-- jquery-validation -->
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <script src="{{ asset('js/custom_crud.js') }}"></script>
@endpush

@push('js')
@endpush
