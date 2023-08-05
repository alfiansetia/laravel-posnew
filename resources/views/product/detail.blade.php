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
                                    href="{{ route('product.edit', $data->id) }}"><i class="fas fa-edit ml-1"></i></a></h3>
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
                                <div class="col-12 col-md-12 col-lg-8 order-1 order-md-1">
                                    <h3 class="text-primary">
                                        <i class="fas fa-cube mr-1"></i>
                                        [{{ $data->code }}] {{ $data->name }}
                                    </h3>
                                    <p class="d-block">{{ $data->desc }}</p>
                                    <p class="d-block">
                                    <div class="custom-control custom-checkbox">
                                        <input name="status" class="custom-control-input" type="checkbox"
                                            {{ $data->status == 'active' ? 'checked' : '' }} disabled>
                                        <label for="status" class="custom-control-label">Active</label>
                                    </div>
                                    <br>
                                </div>
                                <div class="col-12 col-md-12 col-lg-4 order-2 order-md-2">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="info-box d-flex justify-content-center">
                                                <img src="{{ $data->image }}" alt="{{ $data->name }}" width="100">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12 order-2 order-md-2">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card card-primary card-outline card-outline-tabs">
                                                <div class="card-header p-0 border-bottom-0">
                                                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" id="custom-tabs-four-home-tab"
                                                                data-toggle="pill" href="#custom-tabs-four-home"
                                                                role="tab" aria-controls="custom-tabs-four-home"
                                                                aria-selected="true">General</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="custom-tabs-four-profile-tab"
                                                                data-toggle="pill" href="#custom-tabs-four-profile"
                                                                role="tab" aria-controls="custom-tabs-four-profile"
                                                                aria-selected="false">Sales</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="custom-tabs-four-messages-tab"
                                                                data-toggle="pill" href="#custom-tabs-four-messages"
                                                                role="tab" aria-controls="custom-tabs-four-messages"
                                                                aria-selected="false">Purchase</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="custom-tabs-four-settings-tab"
                                                                data-toggle="pill" href="#custom-tabs-four-settings"
                                                                role="tab" aria-controls="custom-tabs-four-settings"
                                                                aria-selected="false">Cargo Info</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="card-body">
                                                    <div class="tab-content" id="custom-tabs-four-tabContent">
                                                        <div class="tab-pane fade show active" id="custom-tabs-four-home"
                                                            role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                                                            <div class="row">
                                                                <table class="table table-sm no-border pt-0">
                                                                    <tr class="mb-1">
                                                                        <td style="width: 20%;"><b>SKU</b></td>
                                                                        <td>{{ $data->sku }}</td>
                                                                    </tr>
                                                                    <tr class="mb-1">
                                                                        <td style="width: 20%;"><b>Code</b></td>
                                                                        <td>{{ $data->code }}</td>
                                                                    </tr>
                                                                    <tr class="mb-1">
                                                                        <td style="width: 20%;"><b>Category</b></td>
                                                                        <td><a
                                                                                href="{{ route('category.show', $data->category_id) }}">{{ $data->category->name }}</a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="mb-1">
                                                                        <td style="width: 20%;"><b>Unit</b></td>
                                                                        <td>{{ $data->unit }}</td>
                                                                    </tr>
                                                                    <tr class="mb-1">
                                                                        <td style="width: 20%;"><b>Stock</b></td>
                                                                        <td>{{ $data->stock }}</td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="custom-tabs-four-profile"
                                                            role="tabpanel"
                                                            aria-labelledby="custom-tabs-four-profile-tab">
                                                            <div class="row">
                                                                <table class="table table-sm no-border pt-0">
                                                                    <tr class="mb-1">
                                                                        <td style="width: 20%;"><b>Selling Price</b></td>
                                                                        <td>{{ $data->sell_price }}</td>
                                                                    </tr>
                                                                    <tr class="mb-1">
                                                                        <td style="width: 20%;"><b>Discount</b></td>
                                                                        <td>{{ $data->disc }}</td>
                                                                    </tr>
                                                                    <tr class="mb-1">
                                                                        <td style="width: 20%;"><b>Min Stock</b></td>
                                                                        <td>{{ $data->min_stock }}</td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="custom-tabs-four-messages"
                                                            role="tabpanel"
                                                            aria-labelledby="custom-tabs-four-messages-tab">
                                                            <div class="row">
                                                                <table class="table table-sm no-border pt-0">
                                                                    <tr class="mb-1">
                                                                        <td style="width: 20%;"><b>Purchase Price</b></td>
                                                                        <td>{{ $data->purc_price }}</td>
                                                                    </tr>
                                                                    <tr class="mb-1">
                                                                        <td style="width: 20%;"><b>Supplier</b></td>
                                                                        <td><a
                                                                                href="{{ route('supplier.show', $data->supplier_id) }}">{{ $data->supplier->name }}</a>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="custom-tabs-four-settings"
                                                            role="tabpanel"
                                                            aria-labelledby="custom-tabs-four-settings-tab">
                                                            <div class="row">
                                                                <table class="table table-sm no-border pt-0">
                                                                    <tr class="mb-1">
                                                                        <td style="width: 20%;"><b>Length (cm)</b></td>
                                                                        <td>{{ $data->length }}</td>
                                                                    </tr>
                                                                    <tr class="mb-1">
                                                                        <td style="width: 20%;"><b>Width (cm)</b></td>
                                                                        <td>{{ $data->width }}</td>
                                                                    </tr>
                                                                    <tr class="mb-1">
                                                                        <td style="width: 20%;"><b>Height (cm)</b></td>
                                                                        <td>{{ $data->height }}</td>
                                                                    </tr>
                                                                    <tr class="mb-1">
                                                                        <td style="width: 20%;"><b>Weight (gr)</b></td>
                                                                        <td>{{ $data->weight }}</td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mt-3 mb-3">
                                <a href="{{ route('product.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left mr-1"></i>Back
                                </a>
                                <a href="{{ route('product.create') }}" class="btn btn-primary">
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
