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
                            <h3 class="card-title">Data {{ $title }}</h3>

                            <div class="card-tools">
                                <a href="{{ route('sale.create') }}" class="btn btn-sm btn-primary mr-2"><i
                                        class="fas fa-plus mr-1"></i> Add</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive ">
                            <table class="table table-sm table-hover" id="table">
                                <thead>
                                    <tr>
                                        <th style="width: 30px;">#</th>
                                        <th>Number</th>
                                        <th>Date</th>
                                        <th>Customer</th>
                                        <th>Tax</th>
                                        <th>Total</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->number }}</td>
                                            <td>{{ $item->date }}</td>
                                            <td>{{ $item->customer->name }}</td>
                                            <td>{{ $item->tax }}</td>
                                            <td>{{ $item->total }}</td>
                                            <td class="text-center"><span
                                                    class="badge badge-{{ $item->status == 'paid' ? 'success' : ($item->status == 'unpaid' ? 'warning' : 'danger') }}">{{ $item->status }}</span>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="{{ route('sale.show', $item->id) }}"
                                                        class="btn btn-sm btn-info">
                                                        <i class="fas fa-info-circle"></i>
                                                    </a>
                                                    <a href="{{ route('sale.edit', $item->id) }}"
                                                        class="btn btn-sm btn-warning">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button value="{{ $item->id }}" type="button"
                                                        class="btn btn-sm btn-danger"
                                                        onclick="deleteData('{{ route('sale.destroy', $item->id) }}')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->

    </div>
    <!-- /.content -->

    <form action="" method="POST" id="form_delete">
        @csrf
        @method('DELETE')
    </form>
@endsection

@push('jslib')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('js/custom_crud.js') }}"></script>
@endpush

@push('js')
@endpush
