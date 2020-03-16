 <div class="form-body">
<!-- Title Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="title">Title</label>
            {!! Form::text('title', null, ['class' => 'form-control','id' => "title","required"]) !!}
       </div>
</div>

<!-- Question Id Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="question_id">Question Id</label>
            {!! Form::text('question_id', null, ['class' => 'form-control','id' => "question_id","required"]) !!}
       </div>
</div>

<!-- Is True Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="is_true">Is True</label>
            {!! Form::text('is_true', null, ['class' => 'form-control','id' => "is_true","required"]) !!}
       </div>
</div>

<!-- Ordered Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="ordered">Ordered</label>
            {!! Form::text('ordered', null, ['class' => 'form-control','id' => "ordered","required"]) !!}
       </div>
</div>

</div>

<div class="" style="margin-top:20px;">
     <button type="submit" class="btn btn-primary col-md-2 pd-x-20">حفظ</button>
    <a href="{!! route('questionOptions.index') !!}" class="btn btn-warning col-md-2" style="color: #fff;">الغاء</a>
</div>