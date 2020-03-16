@php /** @var \App\Models\Delivery $delivery */ @endphp

<script>
    var driver_id = {{$delivery->id}};
</script>
<style>
    #mapDelivery {
        width: 100%;
        height: 400px;
        background-color: grey;
    }
</style>

<div id="mapDelivery"></div>

<br><br>

<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'رقم المندوب') !!}
    <p>{!! $delivery->uniqueID !!}</p>
</div>


<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'الاسم') !!}
    <p>{!! $delivery->name !!}</p>
</div>

<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'البريد') !!}
    <p>{!! $delivery->email !!}</p>
</div>

<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'رقم الجوال') !!}
    <p>{!! $delivery->mobile !!}</p>
</div>


<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'الراتب') !!}
    <p>{!! $delivery->delivery_salary !!}</p>
</div>

<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'العمولة') !!}
    <p>{!! $delivery->delivery_commission !!}</p>
</div>


<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'الصورة') !!}
    <p><img src="{!! \Helper\Common\imageUrl($delivery->image) !!}" class="img-responsive"></p>
</div>

<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'صورة البطاقة الشخصية') !!}
    <p><img src="{!! \Helper\Common\imageUrl($delivery->national_id_img) !!}" class="img-responsive"></p>
</div>

<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'صورة رخصة القيادة') !!}
    <p><img src="{!! \Helper\Common\imageUrl($delivery->driving_license_img) !!}" class="img-responsive"></p>
</div>

<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'صورة رخصة الماكينة') !!}
    <p><img src="{!! \Helper\Common\imageUrl($delivery->bike_license_img) !!}" class="img-responsive"></p>
</div>

<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'صورة الفيش ') !!}
    <p><img src="{!! \Helper\Common\imageUrl($delivery->check_details_img) !!}" class="img-responsive"></p>
</div>

<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'صورة تحليل المخدرات ') !!}
    <p><img src="{!! \Helper\Common\imageUrl($delivery->drugs_img) !!}" class="img-responsive"></p>
</div>
