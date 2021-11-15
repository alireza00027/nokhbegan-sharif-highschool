@extends('layouts.auth')

@section('content')
    <main>
        <div class="mainContainer d-flex centered flex-column">
            <div class="fs6 text-white">ورود</div>
            <div class="col-10 col-sm-6 col-md-6 rounded p-3 mt-4 bg-white d-flex centered flex-column animation formContainer">
                <form action="{{route('login')}}" method="post" autocomplete="off" class="w-100 pb-2 px-3 py-4 needs-validation bg-nokhbegan" novalidate>
                    @csrf
                    @include('layouts.sections.errors')
                    <div>
                        <label for="email" class="form-label fs2">
                            ایمیل <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <input type="email"
                                   name="email"
                                   class="form-control fs1"
                                   id="email"
                                   placeholder="  ایمیل "
                                   pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
                                   required>
                            <span class="input-group-text">
                            <i class="fa fa-check-circle text-secondary"></i>
                        </span>
                            <div class="invalid-feedback">
                                ایمیل اشتباه است
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 mb-1">
                        <label for="password" class="form-label fs2">
                            کلمه عبور <span class="text-danger">*</span>
                        </label>
                        <div class="input-group position-relative has-validation">
                            <input type="password"
                                   name="password"
                                   class="form-control fs1"
                                   id="password"
                                   pattern="^[A-Za-z\d@$!%*#?&]{8,}$"
                                   placeholder="کلمه عبور"
                                   required>
                            <i class="fa fa-eye-slash position-absolute p-2 eye-slash-icon text-secondary"
                               onclick="showPassword(this, 'password')">
                            </i>
                            <span class="input-group-text" id="passwordValidation">
                            <i class="fa fa-check-circle text-secondary"></i>
                        </span>
                            <div class="invalid-feedback">
                                کلمه عبور اشتباه است
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-outline-secondary col-12 mb-3 mt-4" type="submit">ورود</button>
                    <a href="{{route('password.request')}}"class="btn btn-outline-secondary forgetBtn col-12 mb-3 mt-3">فراموشی رمز</a>
                </form>
            </div>
        </div>
    </main>


@endsection
