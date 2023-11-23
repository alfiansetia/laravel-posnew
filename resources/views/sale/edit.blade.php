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
                            <h3 class="card-title">Edit {{ $title }}</h3>
                            <div class="card-tools">
                                <a href="{{ route('sale.index') }}" class="btn btn-sm btn-primary mr-2"><i
                                        class="fas fa-arrow-left mr-1"></i> Back</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form id="form" class="form-horizontal" method="POST"
                                action="{{ route('sale.update', $data->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="number" class="col-sm-2 col-form-label">Sale Number</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control @error('number') is-invalid @enderror"
                                                id="number" placeholder="Sale Number" value="{{ $data->number }}"
                                                disabled readonly>
                                            @error('number')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="date" class="col-sm-2 col-form-label">Date</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control @error('date') is-invalid @enderror"
                                                id="date" placeholder="Date" value="{{ $data->date }}" disabled
                                                readonly>
                                            @error('date')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tax" class="col-sm-2 col-form-label">TAX %</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control @error('tax') is-invalid @enderror"
                                                id="tax" placeholder="TAX" value="{{ $data->tax }}" disabled
                                                readonly>
                                            @error('tax')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="total" class="col-sm-2 col-form-label">Total</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control @error('total') is-invalid @enderror"
                                                id="total" placeholder="Total" value="{{ harga($data->total) }}"
                                                disabled readonly>
                                            @error('total')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="type" class="col-sm-2 col-form-label">Payment</label>
                                        <div class="col-sm-10">
                                            <select name="type" id="type"
                                                class="form-control @error('type') is-invalid @enderror"
                                                style="width: 100%;" required>
                                                <option value="cash" {{ $data->type == 'cash' ? 'selected' : '' }}>CASH
                                                </option>
                                                <option value="cashless" {{ $data->type == 'cashless' ? 'selected' : '' }}>
                                                    CASHLESS
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
                                        <label for="trx_id" class="col-sm-2 col-form-label">TRX ID</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="trx_id"
                                                class="form-control @error('trx_id') is-invalid @enderror" id="trx_id"
                                                placeholder="TRX ID" value="{{ $data->trx_id }}" maxlength="50">
                                            @error('trx_id')
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
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    <script src="{{ asset('js/custom_crud.js') }}"></script>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            change_trx()


            $('button[type=reset]').click(function() {
                $('#type').val("{{ $data->type }}").change()
            })

            $("#type").select2({
                theme: 'bootstrap4',
                placeholder: "Select a Payment",
            })

            $('#type').change(function() {
                change_trx()
            })

            function change_trx() {
                let type = $("#type").val()
                if (type == 'cash') {
                    $("#trx_id").prop('required', false);
                    $("#trx_id").prop('readonly', true);
                } else {
                    $("#trx_id").prop('required', true);
                    $("#trx_id").prop('readonly', false);
                }
            }
        })
    </script>
@endpush
