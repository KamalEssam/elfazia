 <div class="form-body">
<!-- Form Field -->
<div class="form-group m-b-40 ">
{!! Form::text('form', null, ['class' => 'form-control','id'=>"form","required"]) !!}
     <span class="highlight"></span> <span class="bar"></span>
{!! Form::label('form', 'Form:') !!}
 </div>



<!-- To Field -->
<div class="form-group m-b-40 ">
{!! Form::text('to', null, ['class' => 'form-control','id'=>"to","required"]) !!}
     <span class="highlight"></span> <span class="bar"></span>
{!! Form::label('to', 'To:') !!}
 </div>



<!-- Message Field -->
<div class="form-group m-b-40 ">
{!! Form::text('message', null, ['class' => 'form-control','id'=>"message","required"]) !!}
     <span class="highlight"></span> <span class="bar"></span>
{!! Form::label('message', 'Message:') !!}
 </div>



<!-- Is Read Field -->
<div class="form-group m-b-40 ">
{!! Form::text('is_read', null, ['class' => 'form-control','id'=>"is_read","required"]) !!}
     <span class="highlight"></span> <span class="bar"></span>
{!! Form::label('is_read', 'Is Read:') !!}
 </div>



</div>
<div class="form-actions" style="margin-top:20px;">
    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> حفظ</button>
    <a href="{!! route('chats.index') !!}" class="btn btn-default">الغاء</a>
</div>