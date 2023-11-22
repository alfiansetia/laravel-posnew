@extends('layouts.template')

@push('csslib')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@section('content')
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add {{ $title }}</h3>

                            <div class="card-tools">
                                <a href="{{ route('adjustment.index') }}" class="btn btn-sm btn-primary mr-2"><i
                                        class="fas fa-arrow-left mr-1"></i> Back</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form id="form" class="form-horizontal" method="POST"
                                action="{{ route('adjustment.store') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="product" class="col-sm-2 col-form-label">Product</label>
                                        <div class="col-sm-10">
                                            <select name="product" id="product"
                                                class="form-control @error('product') is-invalid @enderror"
                                                style="width: 100%;" required>
                                                <option value="">Select Product</option>
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
                                                style="width: 100%;" required>
                                                <option value="">Select Type</option>
                                                <option value="plus" {{ old('type') == 'plus' ? 'selected' : '' }}>plus
                                                </option>
                                                <option value="minus" {{ old('type') == 'minus' ? 'selected' : '' }}>minus
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
                                                placeholder="Value" value="{{ old('value', 1) }}" min="1" required
                                                autofocus>
                                            @error('value')
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
                                                placeholder="Description" maxlength="100">{{ old('desc') }}</textarea>
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
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    <!-- jquery-validation -->
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <script src="{{ asset('js/custom_crud.js') }}"></script>
@endpush

@push('js')
    <script>
        $('button[type=reset]').click(function() {
            $('#product').val('').change()
            $('#type').val('').change()
        })

        $(document).ready(function() {
            $("#product").select2({
                theme: 'bootstrap4',
                placeholder: "Select a Product",
                ajax: {
                    delay: 1000,
                    url: "{{ route('product.paginate') }}",
                    data: function(params) {
                        return {
                            name: params.term,
                            page: params.page || 1
                        };
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;
                        return {
                            results: $.map(data.data, function(item) {
                                return {
                                    text: item.name,
                                    id: item.id,
                                }
                            }),
                            pagination: {
                                more: (params.page * data.per_page) < data.total,
                            },
                        };
                    },
                },
                cache: true,
            });
        })
    </script>
@endpush
