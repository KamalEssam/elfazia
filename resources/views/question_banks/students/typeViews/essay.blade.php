
<!-- Title Field -->
<div class="row" style="" id="essayID">
    <div class="col-md-12 form-group mb-3">
        <label for="title">نص السؤال</label>
        <br><br>
        {{--<div id="questionTitle" class="form-control"> {{$questions->title}} </div>--}}
        {!! $questions->title !!}

        <br><br>
        <label for="title">الأجابة </label>
        <textarea name="answer" class="form-control"> </textarea>

    </div>

    <div class="col-md-12 form-group mb-3">
       <img src="{{\Helper\Common\imageUrl($questions->image)}}" class="image-responsive">
    </div>
</div>



{{--<script src="{{url("public/vendor/mathEditor")}}/lib/mathquill.min.js"></script>--}}
{{--<script src="{{url("public/vendor/mathEditor")}}/lib/matheditor.js"></script>--}}
{{--<script type="text/javascript">--}}
    {{--var essay = new MathEditor('questionTitle');--}}

{{--</script>--}}
