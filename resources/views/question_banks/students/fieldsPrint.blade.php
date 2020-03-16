@php /** @var \App\Models\Question $questions **/ @endphp

<div class="form-body" id="form-body">
    @if(\App\Models\QuestionBank::find($bank_id)->has_end_time == 1)
<div class="col-md-12">
    <a id="timer" class="btn btn-danger col-md-2" style="color: #fff;"></a>
    <br><br>
</div>
    @endif

<!-- Title Field -->
@if($questions->type->type_custom == "essay")
@include("question_banks.students.typeViews.essay")
@if($showBtns == true)
</div>


<div class="" style="margin-top:20px;">
    <button type="submit" class="btn btn-primary col-md-2 pd-x-20">حفظ</button>
    <a href="{!! route('questionBanks.index') !!}" class="btn btn-warning col-md-2" style="color: #fff;">الغاء</a>
</div>
@endif

    @endif
    @if($questions->type->type_custom == "options")
        @include("question_banks.students.typeViews.optionsPrint")



    @endif
    @if($questions->type->type_custom == "true_or_false")
        @include("question_banks.students.typeViews.trueOrFalsePrint")

    @endif

    @if($questions->type->type_custom == "order")
        @include("question_banks.students.typeViews.orderable")

@if($showBtns == true)

</div>


<div class="" style="margin-top:20px;">
    <a onclick="submit()"  class="btn btn-primary col-md-2 pd-x-20" style="color: white;">حفظ</a>
    <a href="{!! route('questionBanks.index') !!}" class="btn btn-warning col-md-2" style="color: #fff;">الغاء</a>
</div>
@endif
    @endif


@if($questions->type->type_custom == "complete")
@include("question_banks.students.typeViews.complete")
@if($showBtns == true)


</div>


<div class="" style="margin-top:20px;">
    <a onclick="submit()"  class="btn btn-primary col-md-2 pd-x-20" style="color: white;">حفظ</a>
    <a href="{!! route('questionBanks.index') !!}" class="btn btn-warning col-md-2" style="color: #fff;">الغاء</a>
</div>
@endif

@endif

    @if($questions->type->type_custom == "match")
    @include("question_banks.students.typeViews.Drages")

@if($showBtns == true)


</div>


<div class="" style="margin-top:20px;">
    <a onclick="submit()"  class="btn btn-primary col-md-2 pd-x-20" style="color: white;">حفظ</a>
    <a href="{!! route('questionBanks.index') !!}" class="btn btn-warning col-md-2" style="color: #fff;">الغاء</a>
</div>
@endif


@endif



@if(\App\Models\QuestionBank::find($bank_id)->has_end_time == 1)

<script>
    $( document ).ready(function() {

        @php $checkerStart = \App\Models\StudentExam::where("student_id",auth()->id())->where("exam_id",$bank_id)->first(); @endphp

        // Set the date we're counting down to
        var countDownDate = new Date("{{date("Y-m-d H:i:s",$checkerStart->end_time)}}").getTime();
        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;
            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            // Display the result in the element with id="demo"
            $("#timer").html("");

            $("#timer").append(days + "d " + hours + "h "
                + minutes + "m " + seconds + "s ");

            // If the count down is finished, write some text
            if (distance < 0) {
                clearInterval(x);
                $("#timer").html("");
                $("#timer").append("EXPIRED") ;
            }
        }, 1000);

    });

</script>
    @endif