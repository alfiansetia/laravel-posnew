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
            <form id="form" class="form-horizontal" method="POST" action="{{ route('setting.company.update') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Setting {{ $title }} General</h3>
                                <div class="card-tools">
                                    <a href="{{ route('home') }}" class="btn btn-sm btn-primary mr-2"><i
                                            class="fas fa-arrow-left mr-1"></i> Back</a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 col-form-label">Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="name"
                                                class="form-control @error('name') is-invalid @enderror" id="name"
                                                placeholder="Name" value="{{ $company->name }}" maxlength="50" required
                                                autofocus>
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="phone" class="col-sm-3 col-form-label">Phone</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="phone"
                                                class="form-control @error('phone') is-invalid @enderror" id="phone"
                                                placeholder="Phone" value="{{ $company->phone }}" maxlength="50"
                                                data-inputmask="'mask': ['999999999999', '99999999999[9]']" data-mask
                                                required>
                                            @error('phone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="address" class="col-sm-3 col-form-label">Address</label>
                                        <div class="col-sm-9">
                                            <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror"
                                                placeholder="Address" minlength="3" maxlength="100" required>{{ $company->address }}</textarea>
                                            @error('address')
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
                                <h3 class="card-title">Image</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="logo" class="col-sm-3 col-form-label">Logo</label>
                                        <div class="col-sm-9">
                                            <div class="custom-file">
                                                <input type="file" name="logo" id="logo"
                                                    class="custom-file-input @error('logo') is-invalid @enderror"
                                                    accept="image/*">
                                                <label class="custom-file-label" for="logo">Choose
                                                    file</label>
                                                @error('logo')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <img class="mt-3" src="{{ $company->logo }}" alt="{{ $company->name }}"
                                                    width="80">
                                            </div>
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
                                        <label for="tax" class="col-sm-3 col-form-label">TAX</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <input type="number" name="tax"
                                                    class="form-control @error('tax') is-invalid @enderror" id="tax"
                                                    placeholder="tax" value="{{ $company->tax ?? 0 }}" min="0"
                                                    required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                                @error('tax')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="paper_size" class="col-sm-3 col-form-label">Thermal Paper Size</label>
                                        <div class="col-sm-9">
                                            <select name="paper_size" id="paper_size"
                                                class="form-control select2 @error('paper_size') is-invalid @enderror"
                                                style="width: 100%;" required>
                                                <option value="">Select Thermal Paper Size</option>
                                                <option {{ $company->paper_size == 58 ? 'selected' : '' }} value="58">
                                                    58mm</option>
                                                <option {{ $company->paper_size == 80 ? 'selected' : '' }} value="80">
                                                    80mm</option>
                                            </select>
                                            @error('paper_size')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="footer_thermal" class="col-sm-3 col-form-label">Footer Thermal</label>
                                        <div class="col-sm-9">
                                            <textarea name="footer_thermal" id="footer_thermal"
                                                class="form-control @error('footer_thermal') is-invalid @enderror" placeholder="Footer Thermal" maxlength="100">{{ $company->footer_thermal }}</textarea>
                                            @error('footer_thermal')
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
            $('#paper_size').val("{{ $company->paper_size }}").change()
        })

        bsCustomFileInput.init();
    </script>
@endpush
