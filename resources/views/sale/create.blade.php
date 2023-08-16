@extends('layouts.template')

@push('csslib')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@section('content')
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <form id="form" action="{{ route('sale.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Detail {{ $title }} </h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="customer" class="col-sm-3 col-form-label">Customer</label>
                                    <div class="col-sm-9">
                                        <select name="customer" id="customer"
                                            class="form-control select2 @error('customer') is-invalid @enderror"
                                            style="width: 100%;" required>
                                            <option value="">Select Customer</option>
                                            @foreach ($customer as $item)
                                                <option {{ old('customer') == $item->id ? 'selected' : '' }}
                                                    value="{{ $item->id }}">{{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('customer')
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
                                            placeholder="Description" maxlength="100" autofocus>{{ old('desc') }}</textarea>
                                        @error('desc')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-center mt-5 mb-2">
                                    <div class="form-group">
                                        <div class="ml-auto mr-auto">
                                            <button type="reset" class="btn btn-warning mr-2">
                                                <i class="fas fa-undo mr-1"></i>Reset
                                            </button>
                                            <button type="submit" class="btn btn-info mr-2">
                                                <i class="fas fa-paper-plane mr-1"></i>Save
                                            </button>
                                            <button type="button" id="btn_select_product" class="btn btn-primary">
                                                <i class="fas fa-list mr-1"></i>Select Product
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Detail {{ $title }} </h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="tax" class="col-sm-3 col-form-label">TAX</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input type="number" name="tax"
                                                class="form-control @error('tax') is-invalid @enderror" id="tax"
                                                placeholder="tax" value="{{ old('tax', $company->tax) }}" min="0" max="100"
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
                                    <label for="bill" class="col-sm-3 col-form-label">Bill</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="bill"
                                            class="form-control @error('bill') is-invalid @enderror" id="bill"
                                            placeholder="Bill" value="{{ old('bill') }}" maxlength="50">
                                        @error('bill')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>


                        <div class="callout callout-success">
                            <h5 id="total_price"></h5>

                            <p>This is a green callout.</p>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title" id="total_item">0 Item 0 Qty</h3>

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
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-12 order-3 order-md-3">
                                        <table id="table_cart" class="table table-sm" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Product Name</th>
                                                    <th>Price</th>
                                                    <th>Qty</th>
                                                    <th>Disc</th>
                                                    <th>Subtotal</th>
                                                    <th style="width: 30px;">#</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </form>

        </div><!-- /.container-fluid -->

    </div>
    <!-- /.content -->

    <div class="modal fade" id="modal_product" tabindex="-1" aria-labelledby="modal_productLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_productLabel">
                        Product Active
                        <button id="btn_modal_refresh" class="btn btn-sm btn-info ml-1"><i
                                class="fas fa-sync"></i></button>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body table-responsive">
                    <table id="table_product" class="table table-sm table-hover" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 30px;">#</th>
                                <th>Code [SKU]</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Disc</th>
                                <th>Stock</th>
                                <th>Desc</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('jslib')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    <!-- jquery-validation -->
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <script src="{{ asset('js/custom_crud.js') }}"></script>
@endpush

@push('js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });

        var table_product = $('#table_product').DataTable({
            ajax: "{{ route('product.index') }}",
            rowId: 'id',
            columnDefs: [{
                orderable: false,
                targets: [7],
                class: 'text-center'
            }],
            columns: [{
                title: '#',
                data: 'id',
                width: "30px",
                render: function(data, type, row, meta) {
                    if (type == 'display') {
                        return meta.row + 1;
                    } else {
                        return data
                    }
                }
            }, {
                title: 'Code [SKU]',
                data: 'code',
                render: function(data, type, row, meta) {
                    if (type == 'display') {
                        return row.sku != null ? `${data} [${row.sku}]` : data
                    } else {
                        return data
                    }
                }
            }, {
                title: 'Name',
                data: 'name',
            }, {
                title: 'Category',
                data: 'category.name',
            }, {
                title: 'Disc',
                data: 'disc',
            }, {
                title: 'Stock',
                data: 'stock',
            }, {
                title: 'Desc',
                data: 'desc',
            }, {
                title: 'Action',
                data: 'id',
                render: function(data, type, row, meta) {
                    if (type == 'display') {
                        return `<button id="btn_select_product_table" class="btn btn-sm btn-info" value="${data}">Select</button>`
                    } else {
                        return data
                    }
                }
            }, ],
        });

        var table_cart = $('#table_cart').DataTable({
            ajax: "{{ route('cart.index') }}",
            rowId: 'id',
            columns: [{
                title: '#',
                data: 'id',
                width: "30px",
                render: function(data, type, row, meta) {
                    return `<button class="btn btn-sm btn-danger" id="btn_delete" value="${data}" type="button"><i class="fas fa-trash"></i></button>`
                }
            }, {
                title: 'Name',
                data: 'product.name',
            }, {
                title: 'Price',
                data: 'product.sell_price',
            }, {
                title: 'Qty',
                data: 'qty',
                render: function(data, type, row, meta) {
                    if (type == 'display') {
                        return `<div class="input-group" style="white-space: nowrap;">
                                <div class="input-group-prepend">
                                <button type="button" id="qty_minus" class="btn btn-primary btn-sm"><i class="fas fa-minus"></i></button>
                                </div>
                                <input type="number" id="qty" class="form-control form-control-sm" value="${data}" min="1" placeholder="Qty" style="width:30px;">
                                <div class="input-group-append">
                                <button type="button" id="qty_plus" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>`
                    } else {
                        return data
                    }
                }
            }, {
                title: 'Disc',
                data: 'product.disc',
            }, {
                title: 'Subtotal',
                data: 'product.sell_price',
                render: function(data, type, row, meta) {
                    let text = (data * row.qty) - (data * row.qty * row.product.disc / 100)
                    if (type == 'display') {
                        return text
                    } else {
                        return data
                    }
                }
            }, ],
            drawCallback: function(settings) {
                let tax = $('#tax').val() || 0
                let data = this.api().ajax.json()?.data ?? [];
                let total = 0
                let qty = 0;
                data.forEach(item => {
                    total += (item.product.sell_price * item.qty) - (item.product.sell_price * item
                        .qty * item.product.disc / 100);
                    qty += item.qty;
                });
                total -= total * (tax / 100);
                $('#total_price').text(total)
                $('#total_item').text(data.length + ' Item, ' + qty + ' Qty')
                $('#tax').val(tax)
            },
        });

        $('#btn_select_product').click(function() {
            table_product.ajax.reload()
            $('#modal_product').modal('show')
        })

        $('#btn_modal_refresh').click(function() {
            table_product.ajax.reload()
        })

        $('#tax').change(function() {
            table_cart.ajax.reload()
        })

        $('#table_product').on('click', '#btn_select_product_table', function() {
            let row = $(this).parents('tr')[0];
            let id = table_product.row(row).id()
            $.post("{{ route('cart.store') }}", {
                qty: 1,
                product: id
            }).fail(function(xhr) {
                show_error(xhr.responseJSON.message);
            })
            table_cart.ajax.reload()
        });

        $('#table_cart').on('click', '#btn_delete', function() {
            let row = $(this).parents('tr')[0];
            let id = table_cart.row(row).id()
            $.ajax({
                url: "{{ route('cart.destroy', '') }}/" + id,
                type: "DELETE",
                error: function(xhr) {
                    show_error(xhr.responseJSON.message);
                }
            })
            table_cart.ajax.reload()
        });

        $('#table_cart').on('click', '#qty_plus', function() {
            let row = $(this).parents('tr')[0];
            data = table_cart.row(row).data()
            qty = $(this).closest("td").find("#qty")
            if (qty.val() > 0) {
                qty.val(parseInt(qty.val()) + 1).change();
            }
        });

        $('#table_cart').on('click', '#qty_minus', function() {
            let row = $(this).parents('tr')[0];
            data = table_cart.row(row).data()
            qty = $(this).closest("td").find("#qty")
            if (qty.val() > 1) {
                qty.val(parseInt(qty.val()) - 1).change();
            }
        });

        $('#table_cart').on('change', '#qty', function() {
            let row = $(this).parents('tr')[0];
            let id = table_cart.row(row).id()
            let qty = Math.max(this.value, 1);
            update_cart(id, qty)
        });

        function total_data(data) {

        }

        function update_cart(id, qty) {
            $.ajax({
                url: "{{ route('cart.update', '') }}/" + id,
                data: {
                    qty: qty
                },
                type: "PUT",
                error: function(xhr) {
                    show_error(xhr.responseJSON.message);
                }
            })
            table_cart.ajax.reload()
        }

        function show_error(message) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: message,
            })
        }
    </script>
@endpush
