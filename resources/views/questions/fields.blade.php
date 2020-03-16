<link href="{{url("public/vendor/mathEditor")}}/lib/mathquill.css" rel="stylesheet">
<link href="{{url("public/vendor/mathEditor")}}/lib/matheditor.css" rel="stylesheet">


<div class="form-body">

    <!-- Question Type Id Field -->
    <div class="row">
        <div class="col-md-12 form-group mb-3">
            <label for="">نوع السؤال</label>
             <select name="question_type_id" id="question_type_id" class="form-control">
                 <option value="">اختار</option>
             @foreach(\App\Models\QuestionType::all() as $item)
                     <option value="{{$item->type_custom}}">{{$item->title}}</option>
                     @endforeach
             </select>
        </div>
    </div>

    <!-- Question Power Id Field -->
    <div class="row">
        <div class="col-md-12 form-group mb-3">
            <label for="question_power_id">قوة السؤال</label>
            <select name="question_power_id" class="form-control">
                @foreach(\App\Models\QuestionPower::all() as $item)
                    <option value="{{$item->id}}">{{$item->title}}</option>
                @endforeach
            </select>
        </div>
    </div>


<!-- Note Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="note">ملاحظه علي السؤال</label>
            {!! Form::text('note', null, ['class' => 'form-control','id' => "note","required"]) !!}
       </div>
</div>


<!-- Image Field -->
    <div class="form-row ">
      <div class="form-group col-md-12">
        <label for="image" class="ul-form__label">صورة توضيحية</label>

  <div class="input-group mb-3">
    <div class="custom-file">
          <input name="image" type="file" class="custom-file-input" id="inputGroupFile02">
          <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02"></label>
            </div>
       <div class="input-group-append">
                  <span class="input-group-text" id="inputGroupFileAddon02">Upload</span>
         </div>
     </div>

               </div>
         </div>



<!-- Grade Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="grade">الدرجة</label>
            {!! Form::text('grade', null, ['class' => 'form-control','id' => "grade","required"]) !!}
       </div>
</div>

<!-- Num Of Options Field -->
{{--<div class="row">--}}
    {{--<div class="col-md-12 form-group mb-3">--}}
        {{--<label for="num_of_options">Num Of Options</label>--}}
            {{--{!! Form::text('num_of_options', null, ['class' => 'form-control','id' => "num_of_options","required"]) !!}--}}
       {{--</div>--}}
{{--</div>--}}

<!-- Bank Id Field -->
{{--<div class="row">--}}
    {{--<div class="col-md-12 form-group mb-3">--}}
        {{--<label for="bank_id">Bank Id</label>--}}
            {{--{!! Form::text('bank_id', null, ['class' => 'form-control','id' => "bank_id","required"]) !!}--}}
       {{--</div>--}}
{{--</div>--}}

    @include("layouts.editor.editor")
    @include("questions.typeViews.essay")
    @include("questions.typeViews.options")
    @include("questions.typeViews.trueOrFalse")
    @include("questions.typeViews.Drages")
    @include("questions.typeViews.orderable")
    @include("questions.typeViews.complete")

</div>

<div class="" style="margin-top:20px;">
     <a onclick="submit()" id="btn" style="color: #fff;" class="btn btn-primary col-md-2 pd-x-20">حفظ</a>
    <a href="{!! route('questions.index') !!}?bank_id={{$bank_id}}" class="btn btn-warning col-md-2" style="color: #fff;">الغاء</a>
</div>


<script type="text/javascript">

    // me.removeButtons(['fraction']);
    // me.setTemplate('floating-toolbar');
    function submit() {

        $("#form").submit();
    }
</script>

<script>
    $( document ).ready(function() {

        $('#question_type_id').on('change', function (e) {


            var type = e.target.value;

            if (type === "essay") {
                $("#essayID").fadeIn(1000);
                $("#optionsDiv").fadeOut(1000);
                $("#trueFalseDiv").fadeOut(1000);
                $("#matchDiv").fadeOut(1000);
                $("#orderDiv").fadeOut(1000);
            } else if (type === "options") {
                $("#essayID").fadeOut(1000);
                $("#trueFalseDiv").fadeOut(1000);
                $("#matchDiv").fadeOut(1000);
                $("#orderDiv").fadeOut(1000);
                $("#optionsDiv").fadeIn(1000);
            } else if (type === "true_or_false") {
                $("#essayID").fadeOut(1000);
                $("#trueFalseDiv").fadeIn(1000);
                $("#optionsDiv").fadeOut(1000);
                $("#matchDiv").fadeOut(1000);
                $("#orderDiv").fadeOut(1000);
            } else if (type === "match") {
                $("#essayID").fadeOut(1000);
                $("#trueFalseDiv").fadeOut(1000);
                $("#optionsDiv").fadeOut(1000);
                $("#orderDiv").fadeOut(1000);
                $("#matchDiv").fadeIn(1000);
            } else if (type === "order") {
                $("#essayID").fadeOut(1000);
                $("#trueFalseDiv").fadeOut(1000);
                $("#optionsDiv").fadeOut(1000);
                $("#orderDiv").fadeIn(1000);
                $("#matchDiv").fadeOut(1000);
            } else if (type === "complete") {
                $("#essayID").fadeOut(1000);
                $("#trueFalseDiv").fadeOut(1000);
                $("#optionsDiv").fadeOut(1000);
                $("#orderDiv").fadeOut(1000);
                $("#matchDiv").fadeOut(1000);
                $("#completeDiv").fadeIn(1000);
            }
            else {
                $("#essayID").fadeOut(1000);
                $("#optionsDiv").fadeOut(1000);
                $("#trueFalseDiv").fadeOut(1000);
                $("#matchDiv").fadeOut(1000);
                $("#orderDiv").fadeOut(1000);
            }

        });


    });
</script>
