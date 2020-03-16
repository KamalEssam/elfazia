 <div class="form-body">
     <!-- Name En Field -->
     <div class="form-group m-b-40 ">
         {!! Form::text('cost', null, ['class' => 'form-control','id'=>"cost","required"]) !!}
         <span class="highlight"></span> <span class="bar"></span>
         {!! Form::label('cost', 'الرصيد') !!}
     </div>



         <div class="form-group m-b-40 " >
             <select name="type_of_cost" id="type_of_cost"  class="form-control" required style="height: calc(4.85rem);" >
                 <option value="{{\App\Models\UserWallet::$costs["to_client"]}}">اضافة</option>
                 <option value="{{\App\Models\UserWallet::$costs["to_admin"]}}">خصم</option>
             </select>
             <span class="highlight"></span> <span class="bar"></span>

             {!! Form::label('mall_id', 'اختار خصم ام اضافة') !!}
         </div>


     </div>



<div class="form-actions" style="margin-top:20px;">
    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> حفظ</button>
    <a href="{!! route('users.index') !!}" class="btn btn-default">الغاء</a>
</div>