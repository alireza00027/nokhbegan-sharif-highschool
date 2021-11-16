<div>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content pt-3">
            <form action={{route('admin.exams.store')}} method="post">
                @csrf
                <div>
                    <div class="card card-nokhbegan">
                        <div class="card-header">
                            <i class="fa fa-arrow-left ml-1"></i>
                            <span class="fs4 font-weight-bold">انتخاب جزئیات</span>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-sm-6 col-md-4">
                                    <label for="grade" class="form-label fs2">
                                        پایه <span class="text-danger">*</span>
                                    </label>
                                    <select wire:model="grade" id="grade" name="grade" class="form-control " style="width: 100%;">
                                        <option value="seventh">هفتم</option>
                                        <option value="eighth">هشتم</option>
                                        <option value="ninth">نهم</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6 col-md-4">
                                    <label for="course_id">درس <span class="text-danger">*</span></label>
                                    <select wire:model="courseId" id="course_id" name="course_id" class="form-control " style="width: 100%;">
                                        @foreach($courses as $course)
                                            <option value="{{$course->id}}">{{$course->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-sm-6 col-md-4">
                                    <label for="createdAt"> تاریخ</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                      <span class="input-group-text">
                                        <i class="fa fa-calendar"></i>
                                      </span>
                                        </div>
                                        <input id="createdAt" name="createdAt"  class="createdAt form-control"/>
                                        <input id="altCreatedAt" name="createdAtTimestamp" type="hidden">
                                    </div>
                                </div>
                            </div>
                            {{-- <button wire:click="getStudents" type="button" class="col-12 btn btn-primary mr-auto ml-2 mt-3 searchBtn">
                                پردازش
                            </button> --}}
                        </div>
                    </div>
                    <div>
                        <div class="card card-nokhbegan card-outline pb-3">
                            <div class="w-100 border-bottom-0 pt-3 pb-2 px-3 d-flex flex-column flex-sm-row align-items-center justify-content-between">
                                <h3 class="card-title">لیست دانش آموزان</h3>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0 table-responsive">
                                <table id="usersLists" class="table table-hover text-center"
                                       style="border-spacing: 0; border-collapse: separate;">
                                    <thead>
                                    <tr>
                                        <th>ردیف</th>
                                        <th>نام دانش آموز</th>
                                        <th>درس</th>
                                        <th>نمره</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                            @foreach($students as $student)
                                                <tr>
                                                    <td>{{$student->id}}</td>
                                                    <td>{{$student->name}}</td>
                                                    <td>{{$courseTitle}}</td>
                                                    <td><input type="text" class="form-control" name="point_{{$student->id}}" id="point" placeholder="نمره بین 0 تا 2"></td>
                                                </tr>
                                            @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-outline-nokhbegan">ثبت</button>
                            </div>
                        </div>
                        <!-- /. box -->
                    </div>
                </div>
            </form>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</div>
