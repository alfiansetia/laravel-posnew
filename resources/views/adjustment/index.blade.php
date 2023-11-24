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
                                <a href="{{ route('adjustment.create') }}" class="btn btn-sm btn-primary mr-2"><i
                                        class="fas fa-plus mr-1"></i> Add</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table class="table table-sm table-hover" id="table_serverside" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 30px;">#</th>
                                        <th>Number</th>
                                        <th>Date</th>
                                        <th>Product</th>
                                        <th class="text-center">Type [Value]</th>
                                        <th class="text-center">Status</th>
                                        <th>Desc</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
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
    <script>
        $(document).ready(function() {
            var table = $('#table_serverside').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('adjustment.index') }}",
                columns: [{
                        data: 'id',
                        orderable: false,
                        searchable: false,
                        className: "text-center",
                        render: function(data, type, row, meta) {
                            if (type === 'display') {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            } else {
                                return data
                            }
                        }
                    },
                    {
                        data: 'number',
                    },
                    {
                        data: 'date',
                    },
                    {
                        data: 'product',
                        defaultContent: '',
                        render: function(data, type, row, meta) {
                            if (type === 'display') {
                                if (data) {
                                    return `[${data.code ?? ''}] ${data.name}`
                                }
                            } else {
                                return data
                            }
                        }
                    },
                    {
                        data: 'type',
                        orderable: false,
                        searchable: false,
                        className: "text-center",
                        render: function(data, type, row, meta) {
                            if (type === 'display') {
                                return `${data} [${row.value}]`
                            } else {
                                return data
                            }
                        }
                    },
                    {
                        data: 'status',
                        className: "text-center",
                        render: function(data, type, row, meta) {
                            if (type === 'display') {
                                return `<span class="badge badge-${ data === 'done' ? 'success' : 'danger' }">${ data }</span>`
                            } else {
                                return data
                            }
                        }
                    },
                    {
                        data: 'desc',
                    },
                    {
                        data: 'id',
                        orderable: false,
                        searchable: false,
                        className: "text-center",
                        render: function(data, type, row, meta) {
                            if (type === 'display') {
                                let text =
                                    `<div class="btn-group">
                                    <a href="{{ url('adjustment') }}/${data}" class="btn btn-sm btn-info"> <i class="fas fa-info-circle"></i></a>
                                    <a href="{{ url('adjustment') }}/${data}/edit" class="btn btn-sm btn-warning"> <i class="fas fa-edit"></i></a>`;
                                if (row.status != 'cancel') {
                                    text +=
                                        `<button value="${data}" type="button" class="btn btn-sm btn-danger btn_delete"> <i class="fas fa-trash"></i></button>`
                                }
                                text += `</div>`
                                return text
                            } else {
                                return data
                            }
                        }
                    },
                ]
            });

            table.on('click', '.btn_delete', function() {
                let id = table.row($(this).closest('tr')).data().id;
                deleteData("{{ url('adjustment') }}/" + id)
            });

        });
    </script>
@endpush
