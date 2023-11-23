@extends('layouts.template')

@push('csslib')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endpush

@section('content')
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Detail {{ $title }} <span
                                    class="badge badge-{{ $data->status == 'done' ? 'success' : 'danger' }}">{{ $data->number }}</span>
                                <a href="{{ route('sale.edit', $data->id) }}"><i class="fas fa-edit ml-1"></i></a>
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
                                <div class="col-12">
                                    <h3 class="text-primary"><i class="fas fa-shipping-fast mr-1"></i> {{ $data->number }}
                                    </h3>
                                </div>
                                <div class="col-12 col-md-12 col-lg-6 order-1 order-md-1">
                                    <table class="table table-sm no-border">
                                        <tr class="mb-1">
                                            <td style="width: 25%;"><b>Number</b></td>
                                            <td>{{ $data->number }}</td>
                                        </tr>
                                        <tr class="mb-1">
                                            <td style="width: 25%;"><b>Date</b></td>
                                            <td>{{ $data->date }}</td>
                                        </tr>
                                        <tr class="mb-1">
                                            <td style="width: 25%;"><b>Customer</b></td>
                                            <td>{{ $data->customer->name ?? '-' }} {{ $data->customer->phone ?? '-' }}</td>
                                        </tr>
                                        <tr class="mb-1">
                                            <td style="width: 25%;"><b>Create By</b></td>
                                            <td>{{ $data->user->name ?? '-' }} {{ $data->user->phone ?? '-' }}</td>
                                        </tr>
                                        <tr class="mb-1">
                                            <td style="width: 25%;"><b>Status</b></td>
                                            <td><span
                                                    class="badge badge-{{ $data->status == 'done' ? 'success' : 'danger' }}">{{ $data->status }}</span>
                                            </td>
                                        </tr>
                                        <tr class="mb-1">
                                            <td style="width: 25%;"><b>Payment Type</b></td>
                                            <td>{{ $data->type }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-12 col-md-12 col-lg-6 order-2 order-md-2">
                                    <table class="table table-sm no-border">
                                        <tr class="mb-1">
                                            <td style="width: 25%;"><b>TRX ID</b></td>
                                            <td>{{ $data->trx_id }}</td>
                                        </tr>
                                        <tr class="mb-1">
                                            <td style="width: 25%;"><b>Tax</b></td>
                                            <td>{{ $data->tax }}%
                                                ({{ harga(($data->total * $data->tax) / 100) }})</td>
                                        </tr>
                                        <tr class="mb-1">
                                            <td style="width: 25%;"><b>Total</b></td>
                                            <td>{{ harga($data->total) }}</td>
                                        </tr>
                                        <tr class="mb-1">
                                            <td style="width: 25%;"><b>Bill</b></td>
                                            <td>{{ harga($data->bill) }}</td>
                                        </tr>
                                        <tr class="mb-1">
                                            <td style="width: 25%;"><b>Description</b></td>
                                            <td>{{ $data->desc }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="text-center mt-3 mb-2">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-info">
                                        <i class="fas fa-retweet mr-1"></i>Set Status
                                    </button>
                                    <button type="button" class="btn btn-info dropdown-toggle dropdown-icon"
                                        data-toggle="dropdown">
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <button class="dropdown-item">
                                            <i class="fas fa-dollar-sign mr-1"></i>Paid
                                        </button>
                                        <div class="dropdown-divider"></div>
                                        <button class="dropdown-item">
                                            <i class="fas fa-times mr-1"></i>Cancel
                                        </button>
                                    </div>
                                </div>

                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary">
                                        <i class="fas fa-print mr-1"></i>Print
                                    </button>
                                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-icon"
                                        data-toggle="dropdown">
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <button class="dropdown-item">
                                            <i class="fas fa-qrcode mr-1"></i>Small (Thermal)
                                        </button>
                                        <div class="dropdown-divider"></div>
                                        <button class="dropdown-item">
                                            <i class="far fa-sticky-note mr-1"></i>Big (Full)
                                        </button>
                                    </div>
                                </div>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-purple bg-purple">
                                        <i class="fas fa-download mr-1"></i>PDF
                                    </button>
                                    <button type="button" class="btn btn-purple bg-purple dropdown-toggle dropdown-icon"
                                        data-toggle="dropdown">
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <button class="dropdown-item">
                                            <i class="fas fa-qrcode mr-1"></i>Small (Thermal)
                                        </button>
                                        <div class="dropdown-divider"></div>
                                        <button class="dropdown-item">
                                            <i class="far fa-sticky-note mr-1"></i>Big (Full)
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>

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
                            <div class="row">
                                <div class="col-12 col-md-12 order-3 order-md-3">
                                    <table id="table" class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th style="width: 30px;">#</th>
                                                <th>Product Name</th>
                                                <th class="text-center">Price</th>
                                                <th class="text-center">Qty</th>
                                                <th class="text-center">Unit</th>
                                                <th class="text-center">Disc</th>
                                                <th class="text-center">Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data->sale_detail as $key => $item)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $item->product->name ?? '-' }}</td>
                                                    <td class="text-center">{{ harga($item->price) }}</td>
                                                    <td class="text-center">{{ $item->qty }}</td>
                                                    <td class="text-center">{{ $item->unit }}</td>
                                                    <td class="text-center">{{ $item->disc }}%</td>
                                                    @php
                                                        $itemtotal = $item->price * $item->qty;
                                                        $itemdisc = ($itemtotal * $item->disc) / 100;
                                                        $subtotal = $itemtotal - $itemdisc;
                                                    @endphp
                                                    <td class="text-center">{{ harga($subtotal) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
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

@push('jslib')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('js/custom_crud.js') }}"></script>
@endpush
