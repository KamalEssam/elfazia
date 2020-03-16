<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $chat->id !!}</p>
</div>

<!-- Form Field -->
<div class="form-group">
    {!! Form::label('form', 'Form:') !!}
    <p>{!! $chat->form !!}</p>
</div>

<!-- To Field -->
<div class="form-group">
    {!! Form::label('to', 'To:') !!}
    <p>{!! $chat->to !!}</p>
</div>

<!-- Message Field -->
<div class="form-group">
    {!! Form::label('message', 'Message:') !!}
    <p>{!! $chat->message !!}</p>
</div>

<!-- Is Read Field -->
<div class="form-group">
    {!! Form::label('is_read', 'Is Read:') !!}
    <p>{!! $chat->is_read !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $chat->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $chat->updated_at !!}</p>
</div>

