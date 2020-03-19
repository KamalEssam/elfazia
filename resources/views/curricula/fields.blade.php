 <div class="form-body">
<!-- Name Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="name">الأسم</label>
            {!! Form::text('name', null, ['class' => 'form-control','id' => "name","required"]) !!}
       </div>
</div>

<!-- Description Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="description">الوصف</label>
            {!! Form::text('description', null, ['class' => 'form-control','id' => "description","required"]) !!}
       </div>
</div>
     <!-- Description Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="video_url">لينك الفيديو</label>
            {!! Form::text('video_url', null, ['class' => 'form-control','id' => "description","required"]) !!}
       </div>
</div>

<!-- File Field -->
    <div class="form-row ">
      <div class="form-group col-md-12">
        <label for="file" class="ul-form__label">المنهج</label>

  <div class="input-group mb-3">
    <div class="custom-file">
          <input name="file" type="file" class="custom-file-input" id="inputGroupFile02">
          <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02"></label>
            </div>
       <div class="input-group-append">
                  <span class="input-group-text" id="inputGroupFileAddon02">Upload</span>
         </div>
     </div>

               </div>
         </div>



                 <select class="custom-select" style="width: 52%;display: inline-block;" name="card_value"
                         id="inputGroupSelect01">
                     <option selected>اختر قيمه المنهج </option>
                     <option value="1000">1000</option>
                     <option value="500">500</option>
                     <option value="250">250</option>
                 </select>
<!-- Level Id Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="level_id">المستوي</label>
            <select class="form-control" name="level_id">
                @foreach(\App\Models\Level::all() as $level)
                <option value="{{$level->id}}" @if(isset($curriculum) && $curriculum->level_id == $level->id) selected @endif>
                    {{$level->name}}</option>
                    @endforeach
            </select>
       </div>
</div>

</div>

<div class="" style="margin-top:20px;">
     <button type="submit" class="btn btn-primary col-md-2 pd-x-20">حفظ</button>
    <a href="{!! route('curricula.index') !!}" class="btn btn-warning col-md-2" style="color: #fff;">الغاء</a>
</div>