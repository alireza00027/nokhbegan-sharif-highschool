@extends('layouts.app',['title'=>$title])
@section('style')
    <link rel="stylesheet" href="{{asset('css/user/profile/profile.css')}}">
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content pt-3">
            <div class="row d-flex flex-row flex-wrap px-3">
                <div class="card card-primary card-outline col-12">
                    <div class="card-header border-0 d-flex align-items-center justify-content-between">
                        <h3 class="card-title">اطلاعات کاربری</h3>
                        <div class="d-none d-sm-flex align-items-center justify-content-end">
                            <button type="button" class="btn btn-outline-primary mx-2" data-toggle="modal" data-target="#editUser">
                                ویرایش اطلاعات
                            </button>
                            <button type="button" class="btn btn-outline-secondary btn-change-password" data-modalaction="{{route('users.changePassword',['user'=>$user->id])}}" data-toggle="modal" data-target="#editPassword">
                                ویرایش کلمه عبور
                            </button>
                        </div>
                        <div class="d-flex d-sm-none btn-group">
                            <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-ellipsis-v fs4"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-left" role="menu">
                                <button type="button" class="dropdown-item py-2" data-toggle="modal" data-target="#editUser">
                                    ویرایش اطلاعات
                                </button>
                                <button type="button" class="dropdown-item py-2"  data-toggle="modal" data-target="#editPassword">
                                    ویرایش کلمه عبور
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body pt-0">
                        @include('layouts.sections.errors')
                        <hr class="w-100 m-0">
                        <div class="d-flex flex-column flex-sm-row align-items-center align-items-sm-start mx-sm-3 mt-4">
                            <div class="d-flex flex-column">
                                <div id="images-part" class="userImage d-flex centered">
                                    @if($user->avatar==NULL)
                                        <i class="fa fa-user text-light-gray fs10"></i>
                                    @else
                                        <img class="userImage" src="{{asset('avatars/'.$user->avatar)}}" >
                                    @endif
                                </div>
                            </div>
                            <div class="mr-sm-5 mt-4 mt-sm-0">
                                <div class="mt-3 mt-sm-2">
                                    <label for="name" class="width120">نام و نام خانوادگی: </label>
                                    <span id="name">{{$user->name}}</span>
                                </div>
                                <div class="mt-3 mt-sm-2">
                                    <label for="grade" class="width120">پایه: </label>
                                    <span id="grade">{{$user->getGadeText()}}</span>
                                </div>
                                <div class="mt-3 mt-sm-2">
                                    <label for="mobile" class="width120">شماره موبایل: </label>
                                    <span id="mobile">{{$user->mobile}}</span>
                                </div>
                                <div class="mt-3 mt-sm-2">
                                    <label for="email" class="width120">ایمیل: </label>
                                    <span id="email">{{$user->email}}</span>
                                </div>
                                <div class="mt-3 mt-sm-2">
                                    <label for="natural_id" class="width120">کد ملی: </label>
                                    <span id="natural_id">{{$user->natural_id}}</span>
                                </div>
                                <div class="mt-3 mt-sm-2">
                                    <label for="birthday" class="width120">سال تولد: </label>
                                    <span id="birthday">{{$user->birthday}}</span>
                                </div>
                                <div class="mt-3 mt-sm-2">
                                    <label for="post" class="width120">سمت و مقام: </label>
                                    <span id="post">{{$user->post}}</span>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body-1 -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="editUser" aria-hidden="true">
        <div class="modal-dialog modal-lg animation" role="document">
            <div class="modal-content">
                <form action="{{route('users.update',['user'=>$user->id])}}" method="post" enctype="multipart/form-data" autocomplete="off" class="w-100 needs-validation" novalidate>
                    {{csrf_field()}}
                    {{method_field('PATCH')}}
                    <div class="modal-header d-flex flex-row align-items-center justify-content-between">
                        <h5 class="modal-title">ویرایش اطلاعات</h5>
                    </div>
                    <div class="modal-body d-flex flex-wrap">
                        <div class="w-100 d-flex flex-column centered mb-5">
                            <button type="button" id="selectBtn" class="btn bg-transparent userImage userSelect outline p-0 m-0 position-relative centered" onclick="selectImage()">
                                <i class="fa fa-plus fs5 text-light-gray"></i>
                            </button>
                            <button type="button" id="selectedImage" class="btn bg-transparent userImage userSelect outline p-0 m-0 position-relative border-0 d-none" onclick="selectImage()">
                                <img alt="AriaPart" id="previewImage" src="{{asset('avatars/'.$user->avatar)}}" class="selectedImage" />
                                <span class="userImage userSelect border-0 d-flex flex-column centered customOverlay">
                                        <i class="fa fa-edit text-light fs4"></i>
                                        <span class="text-light mt-1 fs3">Edit</span>
                                    </span>
                            </button>
                            <input type="file" id="avatar" name="avatar" accept="image/*" class="d-none" onchange="readURL(this)" />
                            <button id="removeImage" type="button" class="btn btn-danger centered py-0 mt-1 width120 d-none" onclick="removeSelectedImage()">
                                حذف تصویر
                            </button>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="name" class="form-label fs2">
                                نام و نام خانوادگی <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   name="name"
                                   class="form-control fs1"
                                   id="name"
                                   placeholder="نام و نام خانوادگی"
                                   value="{{old('name',$user->name)}}"
                                   required />
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="mobile" class="form-label fs2">
                                شماره موبایل <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   name="mobile"
                                   class="form-control fs1"
                                   id="mobile"
                                   placeholder="شماره موبایل"
                                   value="{{old('mobile',$user->mobile)}}"
                                   required />
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="email" class="form-label fs2">
                                ایمیل <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   name="email"
                                   class="form-control fs1"
                                   id="email"
                                   placeholder="ایمیل"
                                   value="{{old('email',$user->email)}}"
                                   required />
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="natural_id" class="form-label fs2">
                                کد ملی <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   name="natural_id"
                                   class="form-control fs1"
                                   id="natural_id"
                                   placeholder="کد ملی"
                                   value="{{old('natural_id',$user->natural_id)}}"
                                   required />
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="birthday" class="form-label fs2">
                                سال تولد <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   name="birthday"
                                   class="form-control fs1"
                                   id="birthday"
                                   placeholder="سال تولد"
                                   value="{{old('birthday',$user->birthday)}}"
                                   required />
                        </div>
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label for="card_number" class="form-label fs2">
                                    شماره کارت<span class="text-danger">*</span>
                                </label>
                                <input type="number"
                                       name="card_number"
                                       class="form-control fs1"
                                       id="card_number"
                                       placeholder="شماره کارت"
                                       value="{{old('card_number',$user->card_number)}}"
                                       required />
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="account_number" class="form-label fs2">
                                    شماره حساب <span class="text-danger">*</span>
                                </label>
                                <input type="number"
                                       name="account_number"
                                       class="form-control fs1"
                                       id="account_number"
                                       placeholder="شماره حساب"
                                       value="{{old('account_number',$user->account_number)}}"
                                       required />
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="shaba" class="form-label fs2">
                                    شماره شبا<span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                       name="shaba"
                                       class="form-control fs1"
                                       id="shaba"
                                       placeholder="شماره شبا"
                                       value="{{old('shaba',$user->shaba)}}"
                                       required />
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="bank_name" class="form-label fs2">
                                    نام بانک <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                       name="bank_name"
                                       class="form-control fs1"
                                       id="bank_name"
                                       placeholder="نام بانک"
                                       value="{{old('bank_name',$user->bank_name)}}"
                                       required />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex align-items-center justify-content-between">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                        <button type="submit" class="btn btn-primary">ثبت اطلاعات</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editPassword" tabindex="-1" role="dialog" aria-labelledby="editPassword" aria-hidden="true">
        <div class="modal-dialog modal-lg animation" role="document">
            <div class="modal-content">
                <form id="modal-change-password" action="" method="post" autocomplete="off" class="w-100 needs-validation" novalidate>
                    {{csrf_field()}}
                    <div class="modal-header d-flex flex-row align-items-center justify-content-between">
                        <h5 class="modal-title">ویرایش کلمه عبور</h5>
                    </div>
                    <div class="modal-body d-flex flex-column">
                        <div class="col-md-6 form-group">
                            <label for="prevPassword" class="form-label fs2">
                                کلمه عبور قبلی <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   name="prevPassword"
                                   class="form-control fs1"
                                   id="prevPassword"
                                   placeholder="کلمه عبور قبلی"
                                   required />
                        </div>
                        <div class="col-md-6 form-group mt-2">
                            <label for="newPassword" class="form-label fs2">
                                کلمه عبور جدید<span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   name="newPassword"
                                   class="form-control fs1"
                                   id="newPassword"
                                   placeholder="کلمه عبور جدید"
                                   required />
                        </div>
                        <div class="col-md-6 form-group mt-2">
                            <label for="reNewPassword" class="form-label fs2">
                                تکرار کلمه عبور جدید <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   name="reNewPassword"
                                   class="form-control fs1"
                                   id="reNewPassword"
                                   placeholder="تکرار کلمه عبور جدید"
                                   required />
                        </div>
                    </div>
                    <div class="modal-footer d-flex align-items-center justify-content-between">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                        <button type="submit" class="btn btn-primary">ثبت اطلاعات</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <!-- PAGE PLUGINS -->
    <!-- SparkLine -->
    <script src="{{asset('plugins/sparkline/jquery.sparkline.min.js')}}"></script>
    <!-- jVectorMap -->
    <script src="{{asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
    <script src="{{asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="{{asset('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
    <!-- ChartJS 1.0.2 -->
    <script src="{{asset('plugins/chartjs-old/Chart.min.js')}}"></script>
    <script src="{{asset('js/user/profile/profile.js')}}"></script>
    <script>
        $('.btn-change-password').click(function () {
            let formAction = $(this).data('modalaction');
            $('#modal-change-password').attr('action', formAction);
        });
    </script>
@endsection
