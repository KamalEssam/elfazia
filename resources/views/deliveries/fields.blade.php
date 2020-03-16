 <div class="form-body">

     <!-- Name En Field -->
     <div class="form-group m-b-40 ">
         {!! Form::text('name', null, ['class' => 'form-control','id'=>"username","required"]) !!}
         <span class="highlight"></span> <span class="bar"></span>
         {!! Form::label('name', 'اسم المندوب') !!}
     </div>

     <!-- Name En Field -->
<div class="form-group m-b-40 ">
{!! Form::text('email', null, ['class' => 'form-control','id'=>"email","required"]) !!}
     <span class="highlight"></span> <span class="bar"></span>
{!! Form::label('email', 'البريد') !!}
 </div>


     <!--password Field -->
     <div class="form-group m-b-40 ">
         {!! Form::text('mobile', null, ['class' => 'form-control','id'=>"mobile","required"]) !!}
         <span class="highlight"></span> <span class="bar"></span>
         {!! Form::label('mobile', 'رقم الهاتف') !!}
     </div>

<!--password Field -->
<div class="form-group m-b-40 ">
{!! Form::text('password', null, ['class' => 'form-control','id'=>"password"]) !!}
     <span class="highlight"></span> <span class="bar"></span>
{!! Form::label('password', 'كلمة السر') !!}
 </div>

     <!--password Field -->
     <div class="form-group m-b-40 ">
         {!! Form::text('delivery_salary', null, ['class' => 'form-control','id'=>"delivery_salary","required"]) !!}
         <span class="highlight"></span> <span class="bar"></span>
         {!! Form::label('delivery_salary', 'الراتب بالجنية المصري') !!}
     </div>
     <!-- Image Field -->
     <div class="form-group m-b-40 ">
         <div class="fileupload btn btn-info btn-rounded waves-effect waves-light">
             <span><i class="ion-upload m-r-5"></i>رفع صورة</span>
             <input type="file" class="upload" name="image">
         </div>
     </div>
     <!-- Image Field -->
     <div class="form-group m-b-40 ">
         <div class="fileupload btn btn-info btn-rounded waves-effect waves-light">
             <span><i class="ion-upload m-r-5"></i>رفع صورة البطاقة الشخصية</span>
             <input type="file" class="upload" name="national_id_img">
         </div>
     </div>
     <!-- Image Field -->
     <div class="form-group m-b-40 ">
         <div class="fileupload btn btn-info btn-rounded waves-effect waves-light">
             <span><i class="ion-upload m-r-5"></i>رفع رخصة القيادة</span>
             <input type="file" class="upload" name="driving_license_img">
         </div>
     </div>
     <!-- Image Field -->
     <div class="form-group m-b-40 ">
         <div class="fileupload btn btn-info btn-rounded waves-effect waves-light">
             <span><i class="ion-upload m-r-5"></i>رفع رخصة الماكينة</span>
             <input type="file" class="upload" name="bike_license_img">
         </div>
     </div>
     <!-- Image Field -->
     <div class="form-group m-b-40 ">
         <div class="fileupload btn btn-info btn-rounded waves-effect waves-light">
             <span><i class="ion-upload m-r-5"></i>رفع الفيش والتشبيه</span>
             <input type="file" class="upload" name="check_details_img">
         </div>
     </div>
     <!-- Image Field -->
     <div class="form-group m-b-40 ">
         <div class="fileupload btn btn-info btn-rounded waves-effect waves-light">
             <span><i class="ion-upload m-r-5"></i>رفع تخليل المخدرات</span>
             <input type="file" class="upload" name="drugs_img">
         </div>
     </div>
 </div>
<div class="form-actions" style="margin-top:20px;">
    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> حفظ</button>
    <a href="{!! route('users.index') !!}" class="btn btn-default">الغاء</a>
</div>