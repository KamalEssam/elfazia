 <div class="form-body">
<!-- Question Id Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="question_id">Question Id</label>
            {!! Form::text('question_id', null, ['class' => 'form-control','id' => "question_id","required"]) !!}
       </div>
</div>

<!-- Student Id Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="student_id">Student Id</label>
            {!! Form::text('student_id', null, ['class' => 'form-control','id' => "student_id","required"]) !!}
       </div>
</div>

<!-- Option Id Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="option_id">Option Id</label>
            {!! Form::text('option_id', null, ['class' => 'form-control','id' => "option_id","required"]) !!}
       </div>
</div>

<!-- Answer Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="answer">Answer</label>
            {!! Form::text('answer', null, ['class' => 'form-control','id' => "answer","required"]) !!}
       </div>
</div>

<!-- Test Id Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="test_id">Test Id</label>
            {!! Form::text('test_id', null, ['class' => 'form-control','id' => "test_id","required"]) !!}
       </div>
</div>

</div>

<div class="" style="margin-top:20px;">
     <button type="submit" class="btn btn-primary col-md-2 pd-x-20">حفظ</button>
    <a href="{!! route('questionAnswers.index') !!}" class="btn btn-warning col-md-2" style="color: #fff;">الغاء</a>
</div>