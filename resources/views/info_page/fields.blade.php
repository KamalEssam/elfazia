 <div class="form-body">
<!-- Name Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="name">Name</label>
            {!! Form::text('name', null, ['class' => 'form-control','id' => "name","required"]) !!}
       </div>
</div>

<!-- Email Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="email">Email</label>
            {!! Form::text('email', null, ['class' => 'form-control','id' => "email","required"]) !!}
       </div>
</div>

<!-- Mobile Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="mobile">Mobile</label>
            {!! Form::text('mobile', null, ['class' => 'form-control','id' => "mobile","required"]) !!}
       </div>
</div>

<!-- Level Id Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="level_id">Level Id</label>
            {!! Form::text('level_id', null, ['class' => 'form-control','id' => "level_id","required"]) !!}
       </div>
</div>

<!-- Group Id Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="group_id">Group Id</label>
            {!! Form::text('group_id', null, ['class' => 'form-control','id' => "group_id","required"]) !!}
       </div>
</div>

<!-- Center Id Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="center_id">Center Id</label>
            {!! Form::text('center_id', null, ['class' => 'form-control','id' => "center_id","required"]) !!}
       </div>
</div>

</div>

<div class="" style="margin-top:20px;">
     <button type="submit" class="btn btn-primary col-md-2 pd-x-20">حفظ</button>
    <a href="{!! route('reservationRequests.index') !!}" class="btn btn-warning col-md-2" style="color: #fff;">الغاء</a>
</div>