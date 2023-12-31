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
                                <a href="{{ route('product.create') }}" class="btn btn-sm btn-primary mr-2"><i
                                        class="fas fa-plus mr-1"></i> Add</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive ">
                            <table class="table table-sm table-hover" id="table_serverside" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 30px;">#</th>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Stock</th>
                                        <th class="text-center">Status</th>
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
                ajax: "{{ route('product.index') }}",
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
                        data: 'code',
                    },
                    {
                        data: 'name',
                    },
                    {
                        data: 'category.name',
                    }, {
                        data: 'stock',
                        className: "text-center",
                    }, {
                        data: 'status',
                        className: "text-center",
                        render: function(data, type, row, meta) {
                            if (type === 'display') {
                                return `<span class="badge badge-${data == 'active' ? 'success' : 'danger' }">${data}</span>`
                            } else {
                                return data
                            }
                        }
                    },
                    {
                        data: 'id',
                        orderable: false,
                        searchable: false,
                        className: "text-center",
                        render: function(data, type, row, meta) {
                            if (type === 'display') {
                                return `<div class="btn-group">
                                        <a href="{{ url('product') }}/${data}" class="btn btn-sm btn-info"> <i class="fas fa-info-circle"></i></a>
                                        <a href="{{ url('product') }}/${data}/edit" class="btn btn-sm btn-warning"> <i class="fas fa-edit"></i></a>
                                        <button value="${data}" type="button" class="btn btn-sm btn-danger btn_delete"> <i class="fas fa-trash"></i></button>
                                    </div>`
                            } else {
                                return data
                            }
                        }
                    },
                ]
            });

            table.on('click', '.btn_delete', function() {
                let id = table.row($(this).closest('tr')).data().id;
                deleteData("{{ url('product') }}/" + id)
            });

        });
    </script>
@endpush
