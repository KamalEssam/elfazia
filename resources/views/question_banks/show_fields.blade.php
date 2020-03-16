<!-- Id Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="id">رقم بنك الأسئلة</label>
                <p>{!! $questionBank->id !!}</p>
       </div>
</div>

<!-- Title Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="title">العنوان</label>
                <p>{!! $questionBank->title !!}</p>
       </div>
</div>

<!-- Description Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="description">الوصف</label>
                <p>{!! $questionBank->description !!}</p>
       </div>
</div>

<!-- Description Hide Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="description_hide">اخفاء الوصف</label>
        @if($questionBank->description_hide == 1)
            <p>نعم</p>
            @else
            <p>لا</p>
            @endif

       </div>
</div>

<!-- Retry Hide Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="retry_hide">اخفاء زر اعادة المحاولة</label>
        @if($questionBank->retry_hide == 1)
            <p>نعم</p>
        @else
            <p>لا</p>
        @endif
       </div>
</div>

<!-- Shuffle Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="shuffle">ترتيب الأسئلة عشوائيا</label>
        @if($questionBank->shuffle == 1)
            <p>نعم</p>
        @else
            <p>لا</p>
        @endif
     </div>
</div>

<!-- Shuffle Answers Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="shuffle_answers">ترتيب الأجابات عشوائيا</label>
        @if($questionBank->shuffle_answers == 1)
            <p>نعم</p>
        @else
            <p>لا</p>
        @endif
       </div>
</div>

<!-- Has End Time Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="has_end_time">لديه وقت محدد</label>
        @if($questionBank->has_end_time == 1)
            <p>نعم</p>
        @else
            <p>لا</p>
        @endif
       </div>
</div>

@if($questionBank->has_end_time == 1)
    <div class="row">
        <div class="col-md-12 form-group mb-3">
            <label for="time_of_bank">الوقت المحدد بالدقائق</label>
            <p>{!! $questionBank->time_of_bank !!}</p>
        </div>
    </div>

@endif
<!-- Time Of Bank Field -->

<!-- Full Display Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="full_display">اظهار زر عرض الأسئلة بالكامل</label>
        @if($questionBank->full_display == 1)
            <p>نعم</p>
        @else
            <p>لا</p>
        @endif
       </div>
</div>

<!-- Guest Hide Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="guest_hide">اظهار للزوار</label>
        @if($questionBank->guest_hide == 1)
            <p>نعم</p>
        @else
            <p>لا</p>
        @endif
       </div>
</div>

<!-- Link Temp Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="link_temp">رابط عشوائي</label>
                <p>{!! $questionBank->link_temp !!}</p>
       </div>
</div>

<!-- Must Answer All Bank Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="must_answer_all_bank">اجبار الطالب علي اجابة الأسئلة</label>
        @if($questionBank->must_answer_all_bank == 1)
            <p>نعم</p>
        @else
            <p>لا</p>
        @endif
       </div>
</div>

<!-- Power Question Hide Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="power_question_hide">اخفاء قوة السؤال</label>
        @if($questionBank->power_question_hide == 1)
            <p>نعم</p>
        @else
            <p>لا</p>
        @endif
       </div>
</div>

<!-- Level Id Field -->
<!-- Level Id Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="level_id">المستوي</label>
        @if(isset($questionBank->level))
            <p>{!! $questionBank->level->name !!}</p>
        @endif
    </div>
</div>

<!-- Created At Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="created_at">تاريخ انشاء البنك</label>
                <p>{!! date("Y-m-d",strtotime($questionBank->created_at)) !!}</p>
       </div>
</div>

