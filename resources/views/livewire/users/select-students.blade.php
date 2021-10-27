<div>
    <div>
        <div class="row">
            <div class="form-group col-sm-6 col-md-6">
                <label for="grade" class="form-label fs2">
                    پایه <span class="text-danger">*</span>
                </label>
                <select wire:model="grade" id="grade" name="grade" class="form-control " style="width: 100%;">
                    <option value="seventh" >هفتم</option>
                    <option value="eighth" >هشتم</option>
                    <option value="ninth" >نهم</option>
                </select>
            </div>
            <div class="form-group col-sm-6 col-md-6">
                <label for="student_id">دانش آموز <span class="text-danger">*</span></label>
                <select id="student_id" name="student_id" class="form-control " style="width: 100%;">
                    @foreach($selectedStudents as $student)
                        <option value="{{$student->id}}">{{$student->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
