 <div class="form-body">
<!-- Exam Id Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="exam_id">Exam Id</label>
            {!! Form::text('exam_id', null, ['class' => 'form-control','id' => "exam_id","required"]) !!}
       </div>
</div>

<!-- Question Id Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="question_id">Question Id</label>
            {!! Form::text('question_id', null, ['class' => 'form-control','id' => "question_id","required"]) !!}
       </div>
</div>

</div>

<div class="" style="margin-top:20px;">
     <button type="submit" class="btn btn-primary col-md-2 pd-x-20">حفظ</button>
    <a href="{!! route('examQuestions.index') !!}" class="btn btn-warning col-md-2" style="color: #fff;">الغاء</a>
</div>