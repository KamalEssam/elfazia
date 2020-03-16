@php /** @var \App\Models\Question $questions **/ @endphp

<div class="form-body">
<!-- Title Field -->

    <script src="{{url("public/vendor/mathEditor")}}/lib/mathquill.min.js"></script>
    <script src="{{url("public/vendor/mathEditor")}}/lib/matheditor.js"></script>

    @foreach($questions as $question)
    <!-- Title Field -->
    <div class="row" style="" id="essayID">
        <div class="col-md-12 form-group mb-3">
            <label for="title">نص السؤال</label>
            <div id="questionTitle{{$question->id}}" class="form-control"> {{$question->title}} </div>

            <br><br>
            <label for="title">الأجابة </label>
            <textarea name="answer" class="form-control" disabled=""> {{$question->answer->answer}} </textarea>


        </div>
    </div>

        <!-- Grade Field -->
        <div class="row">
            <div class="col-md-12 form-group mb-3">
                <label for="grade">الدرجة</label>
                {!! Form::text('grade['.$question->answer->id.']', null, ['class' => 'form-control','id' => "grade","required"]) !!}
            </div>
        </div>





        <script type="text/javascript">
            var essay = new MathEditor('questionTitle{{$question->id}}');

        </script>



        @endforeach

</div>



<div class="" style="margin-top:20px;">
    <button type="submit" class="btn btn-primary col-md-2 pd-x-20">حفظ</button>
    <a href="{!! route('questionBanks.index') !!}" class="btn btn-warning col-md-2" style="color: #fff;">الغاء</a>
</div>