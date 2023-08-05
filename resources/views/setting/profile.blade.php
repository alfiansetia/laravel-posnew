@extends('layouts.template')

@section('content')
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-5">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="{{ $data->avatar }}"
                                    alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ $data->name }}</h3>

                            <p class="text-muted text-center"><span
                                    class="badge badge-{{ $data->role == 'admin' ? 'info' : 'warning' }}">{{ $data->role }}</span>
                            </p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Followers</b> <a class="float-right">1,322</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Following</b> <a class="float-right">543</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Friends</b> <a class="float-right">13,287</a>
                                </li>
                            </ul>

                            <button type="button" class="btn btn-danger btn-block"
                                onclick="logout_()"><b>Logout</b></button>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit {{ $title }}</h3>

                            <div class="card-tools">
                                <a href="{{ route('home') }}" class="btn btn-sm btn-primary mr-2"><i
                                        class="fas fa-arrow-left mr-1"></i> Back</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form id="form" class="form-horizontal" method="POST"
                                action="{{ route('setting.profile.update') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="name"
                                                class="form-control @error('name') is-invalid @enderror" id="name"
                                                placeholder="Name" value="{{ $data->name }}" maxlength="25" required
                                                autofocus>
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" name="email"
                                                class="form-control @error('email') is-invalid @enderror" id="email"
                                                placeholder="Email" value="{{ $data->email }}" maxlength="50" required
                                                disabled readonly>
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="phone"
                                                class="form-control @error('phone') is-invalid @enderror" id="phone"
                                                placeholder="Phone" value="{{ $data->phone }}" maxlength="15"
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
                                        <label for="avatar" class="col-sm-2 col-form-label">Avatar</label>
                                        <div class="col-sm-10">
                                            <div class="custom-control custom-radio d-inline-block">
                                                <input class="custom-control-input" type="radio" id="avatar1"
                                                    name="avatar" value="avatar1.png"
                                                    {{ $data->getRawOriginal('avatar') == 'avatar1.png' ? 'checked' : '' }}>
                                                <label for="avatar1" class="custom-control-label">
                                                    <img src="{{ asset('images/avatar/avatar1.png') }}" alt="avatar1"
                                                        width="50">
                                                </label>
                                            </div>
                                            <div class="custom-control custom-radio d-inline-block">
                                                <input class="custom-control-input" type="radio" id="avatar2"
                                                    name="avatar" value="avatar2.png"
                                                    {{ $data->getRawOriginal('avatar') == 'avatar2.png' ? 'checked' : '' }}>
                                                <label for="avatar2" class="custom-control-label">
                                                    <img src="{{ asset('images/avatar/avatar2.png') }}" alt="avatar2"
                                                        width="50">
                                                </label>
                                            </div>
                                            <div class="custom-control custom-radio d-inline-block">
                                                <input class="custom-control-input" type="radio" id="avatar3"
                                                    name="avatar" value="avatar3.png"
                                                    {{ $data->getRawOriginal('avatar') == 'avatar3.png' ? 'checked' : '' }}>
                                                <label for="avatar3" class="custom-control-label">
                                                    <img src="{{ asset('images/avatar/avatar3.png') }}" alt="avatar3"
                                                        width="50">
                                                </label>
                                            </div>
                                            <div class="custom-control custom-radio d-inline-block">
                                                <input class="custom-control-input" type="radio" id="avatar4"
                                                    name="avatar" value="avatar4.png"
                                                    {{ $data->getRawOriginal('avatar') == 'avatar4.png' ? 'checked' : '' }}>
                                                <label for="avatar4" class="custom-control-label">
                                                    <img src="{{ asset('images/avatar/avatar4.png') }}" alt="avatar4"
                                                        width="50">
                                                </label>
                                            </div>
                                            <div class="custom-control custom-radio d-inline-block">
                                                <input class="custom-control-input" type="radio" id="avatar5"
                                                    name="avatar" value="avatar5.png"
                                                    {{ $data->getRawOriginal('avatar') == 'avatar5.png' ? 'checked' : '' }}>
                                                <label for="avatar5" class="custom-control-label">
                                                    <img src="{{ asset('images/avatar/avatar5.png') }}" alt="avatar5"
                                                        width="50">
                                                </label>
                                            </div>
                                            @error('avatar')
                                                <div class="invalid-feedback d-block">
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
        </div>
    </div>
    <!-- /.content -->
@endsection

@push('jslib')
    <!-- InputMask -->
    <script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script>

    <!-- jquery-validation -->
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <script src="{{ asset('js/custom_crud.js') }}"></script>
@endpush
