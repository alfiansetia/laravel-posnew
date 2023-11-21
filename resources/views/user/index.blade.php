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
                                <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary mr-2"><i
                                        class="fas fa-plus mr-1"></i> Add</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive ">
                            <table class="table table-sm table-hover" id="table_serverside">
                                <thead>
                                    <tr>
                                        <th style="width: 30px;">#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th class="text-center">Role</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td class="text-center"><span
                                                    class="badge badge-{{ $item->role == 'admin' ? 'info' : 'warning' }}">{{ $item->role }}</span>
                                            </td>
                                            <td class="text-center"><span
                                                    class="badge badge-{{ $item->status == 'active' ? 'success' : 'danger' }}">{{ $item->status }}</span>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="{{ route('user.show', $item->id) }}"
                                                        class="btn btn-sm btn-info">
                                                        <i class="fas fa-info-circle"></i>
                                                    </a>
                                                    <a href="{{ route('user.edit', $item->id) }}"
                                                        class="btn btn-sm btn-warning">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button value="{{ $item->id }}" type="button"
                                                        class="btn btn-sm btn-danger"
                                                        onclick="deleteData('{{ route('user.destroy', $item->id) }}')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr> --}}
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
                ajax: "{{ route('user.index') }}",
                columns: [{
                        data: 'id',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            if (type === 'display') {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            } else {
                                return data
                            }
                        }
                    },
                    {
                        data: 'name',
                    },
                    {
                        data: 'email',
                    },
                    {
                        data: 'phone',
                    }, {
                        data: 'role',
                        className: "text-center",
                        render: function(data, type, row, meta) {
                            if (type === 'display') {
                                return `<span class="badge badge-${data == 'admin' ? 'info' : 'warning' }">${data}</span>`
                            } else {
                                return data
                            }
                        }
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
                                            <a href="{{ url('user') }}/${data}" class="btn btn-sm btn-info"> <i class="fas fa-info-circle"></i></a>
                                            <a href="{{ url('user') }}/${data}/edit" class="btn btn-sm btn-warning"> <i class="fas fa-edit"></i></a>
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
                deleteData("{{ url('user') }}/" + id)
            });

        });
    </script>
@endpush
