@extends('layouts.auth')

@section('content')
    <main>
        <div class="mainContainer d-flex centered flex-column">
            <div class="fs6 text-white">ثبت نام</div>
            <div class="col-10 col-sm-6 col-md-6 rounded p-3 mt-4 bg-white d-flex centered flex-column animation formContainer">
                <form action="{{route('register')}}" method="post" autocomplete="off" class="w-100 pb-2 px-3 py-4 needs-validation bg-nokhbegan" novalidate>
                    @csrf
                    @include('layouts.sections.errors')
                    <div>
                        <label for="name" class="form-label fs2">
                            نام و نام خانوادگی <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <input type="text"
                                   name="name"
                                   class="form-control fs1"
                                   id="name"
                                   placeholder=" نام و نام خانوادگی "
                                   pattern="[\u0600-\u06FF\s]{3,}$"
                                   required>
                            <span class="input-group-text">
                            <i class="fa fa-check-circle text-secondary"></i>
                        </span>
                            <div class="invalid-feedback">
                                نام و نام خانوادگی اشتباه است
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
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
                    <div class="mt-3 mb-2">
                        <label for="mobile" class="form-label fs2">
                            موبایل <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <input type="text"
                                   name="mobile"
                                   class="form-control fs1"
                                   id="mobile"
                                   placeholder="موبایل "
                                   required>
                            <span class="input-group-text">
                            <i class="fa fa-check-circle text-secondary"></i>
                        </span>
                            <div class="invalid-feedback">
                                موبایل اشتباه است
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 mb-2">
                        <label for="natural_id" class="form-label fs2">
                            کد ملی : <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <input type="text"
                                   name="natural_id"
                                   class="form-control fs1"
                                   id="natural_id"
                                   placeholder="کد ملی "
                                   required>
                            <span class="input-group-text">
                            <i class="fa fa-check-circle text-secondary"></i>
                        </span>
                            <div class="invalid-feedback">
                                کدملی اشتباه است
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 mb-2">
                        <label for="grade" class="form-label fs2">
                            پایه <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <select id="grade"  name="grade" class="form-control select2" style="width: 100%;">
                                <option value="seventh">هفتم</option>
                                <option value="eighth">هشتم</option>
                                <option value="ninth">نهم</option>
                                <option value="student">معلم</option>
                            </select>
                            <div class="invalid-feedback">
                                پایه اشتباه است
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 mb-2">
                        <label for="password" class="form-label fs2">
                            کلمه عبور <span class="text-danger">*</span>
                        </label>
                        <div class="input-group position-relative">
                            <input type="password"
                                   name="password"
                                   class="form-control passInput fs1"
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
                    <button class="btn btn-outline-secondary  col-12 mb-3 mt-4 mb-4" type="submit">ثبت نام</button>
                </form>
            </div>
            <p class="copyRight mt-3 fs1">تمامی حقوق مربوط به آریاپارت است.</p>
        </div>
    </main>
@endsection
