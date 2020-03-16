<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $attendance->id !!}</p>
</div>

<!-- Attend Field -->
<div class="form-group">
    {!! Form::label('attend', 'Attend:') !!}
    <p>{!! $attendance->attend !!}</p>
</div>

<!-- Attend Date Field -->
<div class="form-group">
    {!! Form::label('attend_date', 'Attend Date:') !!}
    <p>{!! $attendance->attend_date !!}</p>
</div>

<!-- Time Attend Field -->
<div class="form-group">
    {!! Form::label('time_attend', 'Time Attend:') !!}
    <p>{!! $attendance->time_attend !!}</p>
</div>

<!-- Time Out Field -->
<div class="form-group">
    {!! Form::label('time_out', 'Time Out:') !!}
    <p>{!! $attendance->time_out !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $attendance->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $attendance->updated_at !!}</p>
</div>

