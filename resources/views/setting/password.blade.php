@extends('layouts.template')

@section('content')
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">

                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Change {{ $title }}</h3>

                            <div class="card-tools">
                                <a href="{{ route('home') }}" class="btn btn-sm btn-primary mr-2"><i
                                        class="fas fa-arrow-left mr-1"></i> Back</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form id="form" class="form-horizontal" method="POST"
                                action="{{ route('setting.password.update') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="password" class="col-sm-2 col-form-label">New Password</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <input type="password" name="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    id="password" placeholder="New Password" value="{{ old('password') }}"
                                                    minlength="5" required autofocus>
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary" type="button"
                                                        id="passwordToggle" onclick="togglePassword('password')"><i
                                                            class="fa fa-eye-slash"></i></button>
                                                </div>
                                                @error('password')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="confirm_password" class="col-sm-2 col-form-label">Confirm
                                            Password</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <input type="password" name="confirm_password"
                                                    class="form-control @error('confirm_password') is-invalid @enderror"
                                                    id="confirm_password" placeholder="Confirm Password"
                                                    value="{{ old('confirm_password') }}" minlength="5" required>
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary" type="button"
                                                        id="confirm_passwordToggle"
                                                        onclick="togglePassword('confirm_password')"><i
                                                            class="fa fa-eye-slash"></i></button>
                                                </div>
                                                @error('confirm_password')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
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
    <!-- jquery-validation -->
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <script src="{{ asset('js/custom_crud.js') }}"></script>
@endpush

@push('js')
    <script>
        function togglePassword(inputId) {
            var passwordInput = $("#" + inputId);

            if (passwordInput.attr("type") === "password") {
                passwordInput.attr("type", "text");
                $("#" + inputId + "Toggle").find("i").removeClass("fa-eye-slash").addClass("fa-eye");
            } else {
                passwordInput.attr("type", "password");
                $("#" + inputId + "Toggle").find("i").removeClass("fa-eye").addClass("fa-eye-slash");
            }
        }
    </script>
@endpush
