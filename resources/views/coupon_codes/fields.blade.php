 <div class="form-body">
<!-- Code Field -->
<div class="form-group m-b-40 ">
{!! Form::text('code', null, ['class' => 'form-control','id'=>"code","required"]) !!}
     <span class="highlight"></span> <span class="bar"></span>
{!! Form::label('code', 'الكود') !!}
 </div>



<!-- Expire Date Field -->
<div class="form-group m-b-40 ">
{!! Form::text('expire_date', null, ['class' => 'form-control','id'=>"datepicker","required"]) !!}
     <span class="highlight"></span> <span class="bar"></span>
{!! Form::label('expire_date', 'تاريخ انتهاء الصلاحية') !!}
 </div>



<!-- Discount Field -->
<div class="form-group m-b-40 ">
{!! Form::text('discount', null, ['class' => 'form-control','id'=>"discount","required"]) !!}
     <span class="highlight"></span> <span class="bar"></span>
{!! Form::label('discount', 'نسبة الخصم بالمئوية') !!}
 </div>



</div>
<div class="form-actions" style="margin-top:20px;">
    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> حفظ</button>
    <a href="{!! route('couponCodes.index') !!}" class="btn btn-default">الغاء</a>
</div>