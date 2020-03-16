
<!-- Title Field -->
<div class="row" style="display: none;" id="essayID">
    <div class="col-md-12 form-group mb-3">
        <label for="title">نص السؤال</label>
        {{--<div id="questionTitle" class="form-control"> </div>--}}
        {{--<input style="display: none;" id="questionEssayInput" name="essayInput" type="text" class="form-control">--}}
        {{--<textarea class="full-featured" name="essayInput"> </textarea>--}}
        <textarea class="full-featured" name="essayInput"> </textarea>


    </div>
    <div class="col-md-12 form-group mb-3">
        <label class="checkbox checkbox-primary">
            <input type="checkbox" name="check_answer_by_system" value="1" >
            <span>تصحيح اوتوماتك</span>
            <span class="checkmark"></span>
        </label>
    </div>

    <!-- Num Of Options Field -->
    {{--<div class="col-md-12 form-group mb-3">--}}
        {{--<label for="title">عدد الأجابات</label>--}}
        {{--<select name="num_of_answers" id="num_of_answers" class="form-control">--}}
            {{--<option value="">اختار</option>--}}
            {{--@for($i = 1; $i < 6; $i++)--}}
                {{--<option value="{{$i}}">{{$i}}</option>--}}
            {{--@endfor--}}
        {{--</select>--}}
    {{--</div>--}}

    <div id="answersInput" class="col-md-12">
        @for($i=0; $i<6; $i++)
        <div class="col-md-12 form-group mb-3">
            <label for="title">الأجابة</label>
            {{--<div id="questionTitle" class="form-control"> </div>--}}
            {{--<input style="display: none;" id="questionEssayInput" name="essayInput" type="text" class="form-control">--}}
            {{--<textarea class="full-featured" name="essayInput"> </textarea>--}}
            <textarea class="full-featured" name="answers[]"> </textarea>


        </div>
            @endfor


    </div>


</div>


{{--<script>--}}
    {{--$( document ).ready(function() {--}}

        {{--$('#num_of_answers').on('change', function (e) {--}}


            {{--var number = e.target.value;--}}

            {{--@php $counter = 0; @endphp--}}

            {{--$("#answersInput").html("");--}}

            {{--for (i = 0; i < number; i++) {--}}

                {{--var input = '{!! Form::text("answers[]", null, ['class' => 'form-control']) !!}';--}}
                {{--var optionDiv = "<div class='col-md-12 form-group mb-3'>\n" +--}}
                    {{--"        <label >الجملة</label>\n" +--}}
                    {{--"           "+ input+--}}
                    {{--"       </div>" +--}}
                    {{--"</div>";--}}

                {{--$("#answersInput").append(optionDiv);--}}
            {{--}--}}

        {{--});--}}


    {{--});--}}
{{--</script>--}}