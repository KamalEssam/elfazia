 <div class="form-body">
<!-- Bank Id Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="bank_id">Bank Id</label>
            {!! Form::text('bank_id', null, ['class' => 'form-control','id' => "bank_id","required"]) !!}
       </div>
</div>

<!-- Group Id Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="group_id">Group Id</label>
            {!! Form::text('group_id', null, ['class' => 'form-control','id' => "group_id","required"]) !!}
       </div>
</div>

</div>

<div class="" style="margin-top:20px;">
     <button type="submit" class="btn btn-primary col-md-2 pd-x-20">حفظ</button>
    <a href="{!! route('questionBankGroups.index') !!}" class="btn btn-warning col-md-2" style="color: #fff;">الغاء</a>
</div>