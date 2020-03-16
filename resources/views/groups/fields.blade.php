 <div class="form-body">
<!-- Name Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="name">الأسم</label>
            {!! Form::text('name', null, ['class' => 'form-control','id' => "name","required"]) !!}
       </div>
</div>

<!-- Center Id Field -->
     <!-- Level Id Field -->
     <div class="row">
         <div class="col-md-12 form-group mb-3">
             <label for="center_id">السنتر</label>
             <select class="form-control" name="center_id">
                 @foreach(\App\Models\Center::all() as $center)
                     <option value="{{$center->id}}" @if(isset($group) && $group->center_id == $center->id) selected @endif>
                         {{$center->name}}</option>
                 @endforeach
             </select>
         </div>
     </div>

<!-- Level Id Field -->
     <!-- Level Id Field -->
     <div class="row">
         <div class="col-md-12 form-group mb-3">
             <label for="level_id">المستوي</label>
             <select class="form-control" name="level_id">
                 @foreach(\App\Models\Level::all() as $level)
                     <option value="{{$level->id}}" @if(isset($group) && $group->level_id == $level->id) selected @endif>
                         {{$level->name}}</option>
                 @endforeach
             </select>
         </div>
     </div>

</div>

<div class="" style="margin-top:20px;">
     <button type="submit" class="btn btn-primary col-md-2 pd-x-20">حفظ</button>
    <a href="{!! route('groups.index') !!}" class="btn btn-warning col-md-2" style="color: #fff;">الغاء</a>
</div>