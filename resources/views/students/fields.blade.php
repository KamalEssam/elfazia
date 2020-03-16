 <div class="form-body">
<!-- Name Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="name">الأسم</label>
            {!! Form::text('name', null, ['class' => 'form-control','id' => "name","required"]) !!}
       </div>
</div>

<!-- Mobile Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="mobile">رقم الهاتف</label>
            {!! Form::text('mobile', null, ['class' => 'form-control','id' => "mobile","required"]) !!}
       </div>
</div>

<!-- Password Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="password">كلمة السر</label>
            {!! Form::text('password', null, ['class' => 'form-control','id' => "password"]) !!}
       </div>
</div>

<!-- Email Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="email">البريد الألكتروني</label>
            {!! Form::text('email', null, ['class' => 'form-control','id' => "email","required"]) !!}
       </div>
</div>


     <!-- group Id Field -->
     <div class="row">
         <div class="col-md-12 form-group mb-3">
             <label for="group_id">السنتر</label>
             <select class="form-control" name="center_id">
                 @foreach(\App\Models\Center::all() as $item)
                     <option value="{{$item->id}}" @if(isset($student) && $student->center_id == $item->id) selected @endif>
                         {{$item->name}}</option>
                 @endforeach
             </select>
         </div>
     </div>

     <!-- group Id Field -->
     <div class="row">
         <div class="col-md-12 form-group mb-3">
             <label for="level_id">المستوي</label>
             <select id="level_id" class="form-control" name="level_id">
                 @foreach(\App\Models\Level::all() as $item)
                     <option value="{{$item->id}}" @if(isset($student) && $student->level_id == $item->id) selected @endif>
                         {{$item->name}}</option>
                 @endforeach
             </select>
         </div>
     </div>

     <!-- group Id Field -->
     <div class="row">
         <div class="col-md-12 form-group mb-3">
             <label for="group_id">المجموعة</label>
             <select id="group" class="form-control" name="group_id">
                 @foreach(\App\Models\Group::all() as $item)
                     <option value="{{$item->id}}" @if(isset($student) && $student->group_id == $item->id) selected @endif>
                         {{$item->name}}</option>
                 @endforeach
             </select>
         </div>
     </div>



</div>

<div class="" style="margin-top:20px;">
     <button type="submit" class="btn btn-primary col-md-2 pd-x-20">حفظ</button>
    <a href="{!! route('students.index') !!}" class="btn btn-warning col-md-2" style="color: #fff;">الغاء</a>
</div>


 <script>
     $( document ).ready(function() {
         $('#level_id').on('change', function (e) {


             var level_id = e.target.value;
             if (level_id > 0) {
                 $.get(appUrl + '/groups/ajax/' + level_id, function (data) {

                     $('#group').empty();

                     if (data.length !== 0) {
                         $.each(data, function (index, subCatObj) {

                             $('#group').append($('<option>', {
                                 value: subCatObj.id,
                                 text: subCatObj.name
                             }));

                         });

                     }

                 });
             }
             else {
                 $('#group').empty();

                 $('#group').append($('<option>', {
                     value: '',
                     text: "اختر",
                     selected: true
                 }));
             }

         });
     });


 </script>