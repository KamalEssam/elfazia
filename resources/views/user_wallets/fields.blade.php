 <div class="form-body">
<!-- Message Field -->
<div class="form-group m-b-40 ">
{!! Form::text('message', null, ['class' => 'form-control','id'=>"message","required"]) !!}
     <span class="highlight"></span> <span class="bar"></span>
{!! Form::label('message', 'Message:') !!}
 </div>



<!-- Cost Field -->
<div class="form-group m-b-40 ">
{!! Form::text('cost', null, ['class' => 'form-control','id'=>"cost","required"]) !!}
     <span class="highlight"></span> <span class="bar"></span>
{!! Form::label('cost', 'Cost:') !!}
 </div>



<!-- User Id Field -->
<div class="form-group m-b-40 ">
{!! Form::text('user_id', null, ['class' => 'form-control','id'=>"user_id","required"]) !!}
     <span class="highlight"></span> <span class="bar"></span>
{!! Form::label('user_id', 'User Id:') !!}
 </div>



</div>
<div class="form-actions" style="margin-top:20px;">
    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> حفظ</button>
    <a href="{!! route('userWallets.index') !!}" class="btn btn-default">الغاء</a>
</div>