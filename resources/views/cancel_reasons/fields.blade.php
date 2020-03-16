 <div class="form-body">
<!-- Name Ar Field -->
<div class="form-group m-b-40 ">
{!! Form::text('name_ar', null, ['class' => 'form-control','id'=>"name_ar","required"]) !!}
     <span class="highlight"></span> <span class="bar"></span>
{!! Form::label('name_ar', 'الاسم عربي') !!}
 </div>



<!-- Name En Field -->
<div class="form-group m-b-40 ">
{!! Form::text('name_en', null, ['class' => 'form-control','id'=>"name_en","required"]) !!}
     <span class="highlight"></span> <span class="bar"></span>
{!! Form::label('name_en', 'الاسم انجليزي') !!}
 </div>



</div>
<div class="form-actions" style="margin-top:20px;">
    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> حفظ</button>
    <a href="{!! route('cancelReasons.index') !!}" class="btn btn-default">الغاء</a>
</div>