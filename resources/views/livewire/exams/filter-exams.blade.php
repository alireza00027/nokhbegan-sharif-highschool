<div>
    <div class="row">
        <div class="form-group col-sm-6 col-md-4">
            <label for="grade" class="form-label fs2">
                پایه <span class="text-danger">*</span>
            </label>
            <select wire:model="grade" id="grade" name="grade" class="form-control " style="width: 100%;">
                <option value="seventh" {{request('grade')=="seventh"?'selected':''}}>هفتم</option>
                <option value="eighth" {{request('grade')=="eighth"?'selected':''}}>هشتم</option>
                <option value="ninth" {{request('grade')=="ninth"?'selected':''}}>نهم</option>
            </select>
        </div>
        <div class="form-group col-sm-6 col-md-4">
            <label for="student_id">دانش آموز <span class="text-danger">*</span></label>
            <select id="student_id" name="student_id" class="form-control " style="width: 100%;">
                <option value="all" {{request('student_id')=="all"?'selected':''}}>همه دانش آموزان</option>
                @foreach($students as $student)
                    <option value="{{$student->id}}" {{request('student_id')==$student->id?'selected':''}}>{{$student->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-sm-6 col-md-4">
            <label for="course_id">درس <span class="text-danger">*</span></label>
            <select id="course_id" name="course_id" class="form-control " style="width: 100%;">
                <option value="all" {{request('course_id')=="all"?'selected':''}}>همه دروس</option>
                @foreach($courses as $course)
                    <option value="{{$course->id}}"{{request('course_id')==$course->id?'selected':''}}>{{$course->title}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
