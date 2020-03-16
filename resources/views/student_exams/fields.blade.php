 <div class="form-body">
<!-- Student Id Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="student_id">Student Id</label>
            {!! Form::text('student_id', null, ['class' => 'form-control','id' => "student_id","required"]) !!}
       </div>
</div>

<!-- Exam Id Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="exam_id">Exam Id</label>
            {!! Form::text('exam_id', null, ['class' => 'form-control','id' => "exam_id","required"]) !!}
       </div>
</div>

<!-- Grade Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="grade">Grade</label>
            {!! Form::text('grade', null, ['class' => 'form-control','id' => "grade","required"]) !!}
       </div>
</div>

</div>

<div class="" style="margin-top:20px;">
     <button type="submit" class="btn btn-primary col-md-2 pd-x-20">حفظ</button>
    <a href="{!! route('studentExams.index') !!}" class="btn btn-warning col-md-2" style="color: #fff;">الغاء</a>
</div>