 <div class="form-body">
<!-- Name Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="name">الأسم</label>
            {!! Form::text('name', null, ['class' => 'form-control','id' => "name","required"]) !!}
       </div>
</div>

</div>

<div class="" style="margin-top:20px;">
     <button type="submit" class="btn btn-primary col-md-2 pd-x-20">حفظ</button>
    <a href="{!! route('levels.index') !!}" class="btn btn-warning col-md-2" style="color: #fff;">الغاء</a>
</div>