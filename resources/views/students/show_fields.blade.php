<!-- Id Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="id">رقم الطالب</label>
                <p>{!! $student->user_id !!}</p>
       </div>
</div>

<!-- Name Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="name">الأسم</label>
                <p>{!! $student->user->name !!}</p>
       </div>
</div>

<!-- Mobile Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="mobile">رقم الهاتف</label>
                <p>{!! $student->user->mobile !!}</p>
       </div>
</div>

<!-- Password Field -->
{{--<div class="row">--}}
    {{--<div class="col-md-12 form-group mb-3">--}}
        {{--<label for="password">كلمة السر</label>--}}
                {{--<p>{!! $student->password !!}</p>--}}
       {{--</div>--}}
{{--</div>--}}

<!-- Email Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="email">البريد الألكتروني</label>
                <p>{!! $student->user->email !!}</p>
       </div>
</div>

<!-- Level Id Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="level_id">المستوي</label>
        @if(isset($student->level))
            <p>{!! $student->level->name !!}</p>
        @endif
    </div>
</div>

<!-- Group Id Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="group_id">المجموعة</label>
        @if(isset($student->group))
            <p>{!! $student->group->name !!}</p>
        @endif
    </div>
</div>

<!-- Center Id Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="center_id">السنتر</label>
        @if(isset($student->center))
            <p>{!! $student->center->name !!}</p>
        @endif
    </div>
</div>
<!-- Created At Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="created_at">تاريخ التسجيل</label>
                <p>{!! date("Y-m-d", strtotime($student->created_at)) !!}</p>
       </div>
</div>

