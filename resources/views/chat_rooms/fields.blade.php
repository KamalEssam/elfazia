 <div class="form-body">
<!-- From Field -->
<div class="form-group m-b-40 ">
{!! Form::text('from', null, ['class' => 'form-control','id'=>"from","required"]) !!}
     <span class="highlight"></span> <span class="bar"></span>
{!! Form::label('from', 'From:') !!}
 </div>



<!-- To Field -->
<div class="form-group m-b-40 ">
{!! Form::text('to', null, ['class' => 'form-control','id'=>"to","required"]) !!}
     <span class="highlight"></span> <span class="bar"></span>
{!! Form::label('to', 'To:') !!}
 </div>



</div>
<div class="form-actions" style="margin-top:20px;">
    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> حفظ</button>
    <a href="{!! route('chatRooms.index') !!}" class="btn btn-default">الغاء</a>
</div>