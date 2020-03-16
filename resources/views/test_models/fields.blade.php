 <div class="form-body">
<!-- Name Field -->
<div class="form-group m-b-40 ">
{!! Form::text('name', null, ['class' => 'form-control','id'=>"name","required"]) !!}
     <span class="highlight"></span> <span class="bar"></span>
{!! Form::label('name', 'Name:') !!}
 </div>



<!-- Name Field -->
<div class="form-group m-b-40 ">
{!! Form::text('name', null, ['class' => 'form-control','id'=>"name","required"]) !!}
     <span class="highlight"></span> <span class="bar"></span>
{!! Form::label('name', 'Name:') !!}
 </div>



<!-- Title Field -->
<div class="form-group m-b-40 ">
{!! Form::text('title', null, ['class' => 'form-control','id'=>"title","required"]) !!}
     <span class="highlight"></span> <span class="bar"></span>
{!! Form::label('title', 'Title:') !!}
 </div>



<!-- Title Field -->
<div class="form-group m-b-40 ">
{!! Form::text('title', null, ['class' => 'form-control','id'=>"title","required"]) !!}
     <span class="highlight"></span> <span class="bar"></span>
{!! Form::label('title', 'Title:') !!}
 </div>



</div>
<div class="form-actions" style="margin-top:20px;">
    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> حفظ</button>
    <a href="{!! route('testModels.index') !!}" class="btn btn-default">الغاء</a>
</div>