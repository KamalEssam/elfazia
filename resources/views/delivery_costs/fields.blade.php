
<div class="form-group m-b-40 " >
    <select name="from_city_id" id="from_city_id" class="form-control" style="height: calc(4.85rem);" required >
        <option value="">اختار المدينة</option>
        @foreach($cities as $city)
            <option value="{{$city->id}}" @if(isset($deliveryCost) and $city->id == $deliveryCost->from_city_id) selected @endif>
                {{$city->name}}</option>
        @endforeach
    </select>
    <span class="highlight"></span> <span class="bar"></span>

    {!! Form::label('from_city_id', 'من') !!}
</div>

<div class="form-group m-b-40 " >
    <select name="to_city_id" id="to_city_id" class="form-control" style="height: calc(4.85rem);" required >
        <option value="">اختار المدينة</option>
        @foreach($cities as $city)
            <option value="{{$city->id}}" @if(isset($deliveryCost) and $city->id == $deliveryCost->to_city_id) selected @endif>
                {{$city->name}}</option>
        @endforeach
    </select>
    <span class="highlight"></span> <span class="bar"></span>

    {!! Form::label('to_city_id', 'الي') !!}
</div>


 <div class="form-body">
<!-- Number Of First Kilos Field -->
<div class="form-group m-b-40 ">
{!! Form::text('number_of_first_kilos', null, ['class' => 'form-control','id'=>"number_of_first_kilos","required"]) !!}
     <span class="highlight"></span> <span class="bar"></span>
{!! Form::label('number_of_first_kilos', 'عدد الكيلوهات الاولي') !!}
 </div>



<!-- Price For First Kilos Field -->
<div class="form-group m-b-40 ">
{!! Form::text('price_for_first_kilos', null, ['class' => 'form-control','id'=>"price_for_first_kilos","required"]) !!}
     <span class="highlight"></span> <span class="bar"></span>
{!! Form::label('price_for_first_kilos', 'سعر عدد الكيلوهات') !!}
 </div>



<!-- Price Per Kilo Field -->
<div class="form-group m-b-40 ">
{!! Form::text('price_per_kilo', null, ['class' => 'form-control','id'=>"price_per_kilo","required"]) !!}
     <span class="highlight"></span> <span class="bar"></span>
{!! Form::label('price_per_kilo', 'سعر كل كيلو') !!}
 </div>



</div>
<div class="form-actions" style="margin-top:20px;">
    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> حفظ</button>
    <a href="{!! route('deliveryCosts.index') !!}" class="btn btn-default">الغاء</a>
</div>