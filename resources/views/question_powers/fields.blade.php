 <div class="form-body">
<!-- Title Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="title">العنوان</label>
            {!! Form::text('title', null, ['class' => 'form-control','id' => "title","required"]) !!}
       </div>
</div>

</div>

<div class="" style="margin-top:20px;">
     <button type="submit" class="btn btn-primary col-md-2 pd-x-20">حفظ</button>
    <a href="{!! route('questionPowers.index') !!}" class="btn btn-warning col-md-2" style="color: #fff;">الغاء</a>
</div>