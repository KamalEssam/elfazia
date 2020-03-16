<!-- Id Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="id">رقم المنهج</label>
                <p>{!! $curriculum->id !!}</p>
       </div>
</div>

<!-- Name Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="name">عنوان المنخج</label>
                <p>{!! $curriculum->name !!}</p>
       </div>
</div>

<!-- Description Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="description">الوصف</label>
                <p>{!! $curriculum->description !!}</p>
       </div>
</div>

<!-- File Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="file">الملف</label>
        <br>
                <a target="_blank" href="{!! url("".$curriculum->file) !!}">تحميل</a>
       </div>
</div>
<!-- video url filed Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="description">الفيديو</label>
        <p>{!! $curriculum->video_url !!}</p>
    </div>
</div>
<!-- Level Id Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="level_id">المستوي</label>
        @if(isset($curriculum->level))
                <p>{!! $curriculum->level->name !!}</p>
            @endif
       </div>
</div>

<!-- Created At Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="created_at">تاريخ الأنشاء</label>
                <p>{!! $curriculum->created_at !!}</p>
       </div>
</div>
