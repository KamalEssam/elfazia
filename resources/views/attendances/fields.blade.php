 <div class="form-body">
<!-- Attend Field -->
<div class="form-group m-b-40 ">
{!! Form::text('attend', null, ['class' => 'form-control','id'=>"attend","required"]) !!}
     <span class="highlight"></span> <span class="bar"></span>
{!! Form::label('attend', 'Attend:') !!}
 </div>



<!-- Attend Date Field -->
<div class="form-group m-b-40 ">
{!! Form::text('attend_date', null, ['class' => 'form-control','id'=>"attend_date","required"]) !!}
     <span class="highlight"></span> <span class="bar"></span>
{!! Form::label('attend_date', 'Attend Date:') !!}
 </div>



<!-- Time Attend Field -->
<div class="form-group m-b-40 ">
{!! Form::text('time_attend', null, ['class' => 'form-control','id'=>"time_attend","required"]) !!}
     <span class="highlight"></span> <span class="bar"></span>
{!! Form::label('time_attend', 'Time Attend:') !!}
 </div>



<!-- Time Out Field -->
<div class="form-group m-b-40 ">
{!! Form::text('time_out', null, ['class' => 'form-control','id'=>"time_out","required"]) !!}
     <span class="highlight"></span> <span class="bar"></span>
{!! Form::label('time_out', 'Time Out:') !!}
 </div>



</div>
<div class="form-actions" style="margin-top:20px;">
    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> حفظ</button>
    <a href="{!! route('attendances.index') !!}" class="btn btn-default">الغاء</a>
</div>