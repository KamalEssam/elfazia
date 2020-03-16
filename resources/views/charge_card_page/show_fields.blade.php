<!-- Id Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="id">رقم الطلب</label>
                <p>{!! $reservationRequest->id !!}</p>
       </div>
</div>

<!-- Name Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="name">الأسم</label>
                <p>{!! $reservationRequest->name !!}</p>
       </div>
</div>

<!-- Email Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="email">البريد الألكتروني</label>
                <p>{!! $reservationRequest->email !!}</p>
       </div>
</div>

<!-- Mobile Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="mobile">الهاتف</label>
                <p>{!! $reservationRequest->mobile !!}</p>
       </div>
</div>

<!-- Level Id Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="level_id">المستوي</label>
        @if(isset($reservationRequest->level))
                <p>{!! $reservationRequest->level->name !!}</p>
            @endif
       </div>
</div>

<!-- Group Id Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="group_id">المجموعة</label>
        @if(isset($reservationRequest->group))
            <p>{!! $reservationRequest->group->name !!}</p>
        @endif
       </div>
</div>

<!-- Center Id Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="center_id">السنتر</label>
        @if(isset($reservationRequest->center))
            <p>{!! $reservationRequest->center->name !!}</p>
        @endif
       </div>
</div>

<!-- Created At Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="created_at">تاريخ الطلب</label>
        <p>{!! date("Y-m-d", strtotime($reservationRequest->created_at)) !!}</p>
       </div>
</div>
