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
            <form id="form" class="form-horizontal" method="POST" action="{{ route('product.update', $data->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Add {{ $title }} General</h3>
                                <div class="card-tools">
                                    <a href="{{ route('product.index') }}" class="btn btn-sm btn-primary mr-2"><i
                                            class="fas fa-arrow-left mr-1"></i> Back</a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="code" class="col-sm-3 col-form-label">Code</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="code"
                                                class="form-control @error('code') is-invalid @enderror" id="code"
                                                placeholder="Code" value="{{ $data->code }}" maxlength="50" required
                                                autofocus>
                                            @error('code')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="sku" class="col-sm-3 col-form-label">SKU</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="sku"
                                                class="form-control @error('sku') is-invalid @enderror" id="sku"
                                                placeholder="SKU" value="{{ $data->sku }}" maxlength="50">
                                            @error('sku')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 col-form-label">Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="name"
                                                class="form-control @error('name') is-invalid @enderror" id="name"
                                                placeholder="Name" value="{{ $data->name }}" maxlength="50" required>
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="category" class="col-sm-3 col-form-label">Category</label>
                                        <div class="col-sm-9">
                                            <select name="category" id="category"
                                                class="form-control select2 @error('category') is-invalid @enderror"
                                                style="width: 100%;" required>
                                                <option value="{{ $data->category_id ?? '' }}">
                                                    {{ $data->category->name ?? 'Select Category' }}</option>
                                            </select>
                                            @error('category')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="supplier" class="col-sm-3 col-form-label">Supplier</label>
                                        <div class="col-sm-9">
                                            <select name="supplier" id="supplier"
                                                class="form-control select2 @error('supplier') is-invalid @enderror"
                                                style="width: 100%;" required>
                                                <option value="{{ $data->supplier_id ?? '' }}">
                                                    {{ $data->supplier->name ?? 'Select Supplier' }}</option>
                                            </select>
                                            @error('supplier')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="desc" class="col-sm-3 col-form-label">Description</label>
                                        <div class="col-sm-9">
                                            <textarea name="desc" id="desc" class="form-control @error('desc') is-invalid @enderror"
                                                placeholder="Description" maxlength="100">{{ $data->desc }}</textarea>
                                            @error('desc')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-3 col-sm-9">
                                            <div class="custom-control custom-checkbox">
                                                <input name="status"
                                                    class="custom-control-input @error('status') is-invalid @enderror"
                                                    type="checkbox" id="status" value="active"
                                                    {{ $data->status == 'active' ? 'checked' : '' }}>
                                                <label for="status" class="custom-control-label">Active?</label>
                                                @error('status')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        <div class="card collapsed-card">
                            <div class="card-header">
                                <h3 class="card-title">Image</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove"
                                        title="Remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="image" class="col-sm-3 col-form-label">Image</label>
                                        <div class="col-sm-9">
                                            <div class="custom-file">
                                                <input type="file" name="image" id="image"
                                                    class="custom-file-input @error('image') is-invalid @enderror"
                                                    accept="image/*">
                                                <label class="custom-file-label" for="image">Choose
                                                    file</label>
                                                @error('image')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <img class="mt-3" src="{{ $data->image }}" alt="{{ $data->name }}"
                                                width="80">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>

                    </div>
                    <div class="col-lg-6">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Sales</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove"
                                        title="Remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="unit" class="col-sm-3 col-form-label">Unit</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="unit"
                                                class="form-control @error('unit') is-invalid @enderror" id="unit"
                                                placeholder="Unit" value="{{ $data->unit ?? 'PCS' }}" maxlength="50"
                                                required autofocus>
                                            @error('unit')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- <div class="form-group row">
                                        <label for="stock" class="col-sm-3 col-form-label">Stock</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="stock"
                                                class="form-control @error('stock') is-invalid @enderror" id="stock"
                                                placeholder="Stock" value="{{ $data->stock ?? 0 }}" min="0"
                                                required>
                                            @error('stock')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div> --}}
                                    <div class="form-group row">
                                        <label for="min_stock" class="col-sm-3 col-form-label">Min Stock</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="min_stock"
                                                class="form-control @error('min_stock') is-invalid @enderror"
                                                id="min_stock" placeholder="Min Stock"
                                                value="{{ $data->min_stock ?? 0 }}" min="0" required>
                                            @error('min_stock')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="discount" class="col-sm-3 col-form-label">Discount</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="discount"
                                                class="form-control @error('discount') is-invalid @enderror"
                                                id="discount" placeholder="Discount" value="{{ $data->discount ?? 0 }}"
                                                min="0" required>
                                            @error('discount')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="selling_price" class="col-sm-3 col-form-label">Selling Price</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="selling_price"
                                                class="form-control @error('selling_price') is-invalid @enderror"
                                                id="selling_price" placeholder="Selling Price"
                                                value="{{ $data->sell_price ?? 0 }}" min="0" required>
                                            @error('selling_price')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="purchase_price" class="col-sm-3 col-form-label">Purchase Price</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="purchase_price"
                                                class="form-control @error('purchase_price') is-invalid @enderror"
                                                id="purchase_price" placeholder="Purchase Price"
                                                value="{{ $data->purc_price ?? 0 }}" min="0" required>
                                            @error('purchase_price')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        <div class="card collapsed-card">
                            <div class="card-header">
                                <h3 class="card-title">Cargo</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove"
                                        title="Remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="length" class="col-sm-3 col-form-label">Length (cm)</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="length"
                                                class="form-control @error('length') is-invalid @enderror" id="length"
                                                placeholder="Length" value="{{ $data->length ?? 0 }}" min="0"
                                                required>
                                            @error('length')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="width" class="col-sm-3 col-form-label">Width (cm)</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="width"
                                                class="form-control @error('width') is-invalid @enderror" id="width"
                                                placeholder="Width" value="{{ $data->width ?? 0 }}" min="0"
                                                required>
                                            @error('width')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="height" class="col-sm-3 col-form-label">Height (cm)</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="height"
                                                class="form-control @error('height') is-invalid @enderror" id="height"
                                                placeholder="Height" value="{{ $data->height ?? 0 }}" min="0"
                                                required>
                                            @error('height')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="weight" class="col-sm-3 col-form-label">Weight (gr)</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="weight"
                                                class="form-control @error('weight') is-invalid @enderror" id="weight"
                                                placeholder="Weight" value="{{ $data->weight ?? 0 }}" min="0"
                                                required>
                                            @error('weight')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>

                    </div>

                    <div class="col-lg-12">
                        <div class="form-group row">
                            <div class="offset-sm-6 col-sm-6">
                                <button type="reset" class="btn btn-warning mr-2"><i
                                        class="fas fa-undo mr-1"></i>Reset</button>
                                <button type="submit" class="btn btn-info"><i
                                        class="fas fa-paper-plane mr-1"></i>Save</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>

        </div><!-- /.container-fluid -->

    </div>
    <!-- /.content -->
@endsection

@push('jslib')
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    <!-- InputMask -->
    <script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script>

    <!-- bs-custom-file-input -->
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

    <!-- jquery-validation -->
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <script src="{{ asset('js/custom_crud.js') }}"></script>
@endpush

@push('js')
    <script>
        $('button[type=reset]').click(function() {
            $('#category').val("{{ $data->category_id }}").change()
            $('#supplier').val("{{ $data->supplier_id }}").change()
        })

        bsCustomFileInput.init();

        $(document).ready(function() {
            $("#category").select2({
                theme: 'bootstrap4',
                placeholder: "Select a Category",
                ajax: {
                    delay: 1000,
                    url: "{{ route('category.paginate') }}",
                    data: function(params) {
                        return {
                            number: params.term,
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

            $("#supplier").select2({
                theme: 'bootstrap4',
                placeholder: "Select a Supplier",
                ajax: {
                    delay: 1000,
                    url: "{{ route('supplier.paginate') }}",
                    data: function(params) {
                        return {
                            name: params.term,
                            phone: params.term,
                            page: params.page || 1
                        };
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;
                        return {
                            results: $.map(data.data, function(item) {
                                return {
                                    text: item.name + ' ' + (item.phone ?? ''),
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
