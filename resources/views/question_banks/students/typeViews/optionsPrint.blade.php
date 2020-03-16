<script>
    var isDisplayAnswer = false;
</script>

<div id="optionsDiv" style="">
<!-- Title Field -->
<div class="row" id="optionID">
    <div class="col-md-12 form-group mb-3">
        <label for="title">نص السؤال</label>
        <br><br>
        {!! $questions->title !!}

    </div>
</div>



    <div id="optionsInputs">
        @for($i = 0; $i< count($questions->options); $i++)
        <div class='row'>
               <div class='col-md-9 form-group mb-3'>
                       <label >الأسم</label>
                   @if(str_contains($questions->options[$i]->title, '/storage' ))
                       <img src="{{\Helper\Common\imageUrl($questions->options[$i]->title)}}" class="img-responsive" height="250">
                       @else

                       {!! $questions->options[$i]->title !!}
                       <br><br>
                   @endif
                     </div>
             <div class='col-md-3 form-group mb-3' style='margin-top: 30px;'>
                           <label class='checkbox checkbox-primary'>
                               <input type='radio' id="is_true_option" name='is_true_option[]'  value='{{$questions->options[$i]->id}}'>
                                   <span>الأجابة الصحيحة</span>
                                  <span class='checkmark'></span>
                               </label>
                       </div>
            </div>

            @endfor


    </div>

</div>



{{--<script src="{{url("public/vendor/mathEditor")}}/lib/mathquill.min.js"></script>--}}
{{--<script src="{{url("public/vendor/mathEditor")}}/lib/matheditor.js"></script>--}}
{{--<script type="text/javascript">--}}
    {{--var essay = new MathEditor('questionOptionTitle');--}}

{{--</script>--}}

@if($showBtns == true)


@if(\App\Models\QuestionBank::find($bank_id)->is_exam == 0)

<script>
    function submitOption(){
        if (isDisplayAnswer === true) {
            $("#testForm").submit();
            return
        }
        var val1 = [];
        $('input[name="is_true_option[]"]:checked').each(function() {
            val1.push($(this).val());
        });

        console.log(val1)
        $.get(appUrl + '/questionsBank/ajax/check?question_id={{$questions->id}}&is_true_option='+val1, function (data) {


            if (data.length !== 0) {
                console.log(data);
                console.log(data.success);
                console.log(data.trueID);
                var div = "" +
                    " <label >الأجابة الصحيحة</label>\n" +
                    "<div class='row'> " +

                    "                <div class='col-md-9 form-group mb-3'>\n" +
                    "                    <label >الأسم</label>\n" +
                    "                    \n";

                if(data.success === true) {
                    $("#testForm").submit();
                } else {
                    isDisplayAnswer = true;

                    $('#optionsInputs').empty();
                    //$("#optionsInputs").append(div);
                    if(data.isFile === true) {
                        div += '<img src="{{url("")}}"'+data.title+' class="img-responsive" height="250">\n';
                    } else {
                        div += ' ' + data.title + ' \n';
                    }
                    div += " </div>\n" +
                        "                <div class='col-md-3 form-group mb-3' style='margin-top: 30px;'>\n" +
                        "                    <label class='checkbox checkbox-primary'>\n" +
                        "                        <input type='radio' checked id='is_true_option' name='is_true_option[]'  value=''"+ data.trueID +" >\n" +
                        "                        <span>الأجابة الصحيحة</span>\n" +
                        "                        <span class='checkmark'></span>\n" +
                        "                    </label>\n" +
                        "                </div>\n" +
                        "            </div>";
                    $('#optionsInputs').append(div);

                }


            }

        });
        //$("#testForm").submit();
    }

</script>


</div>


<div class="" style="margin-top:20px;">
    <a onclick="submitOption()"  class="btn btn-primary col-md-2 pd-x-20" style="color: white;">حفظ</a>
    <a href="{!! route('questionBanks.index') !!}" class="btn btn-warning col-md-2" style="color: #fff;">الغاء</a>
</div>



@else

</div>


<div class="" style="margin-top:20px;">
    <button type="submit" class="btn btn-primary col-md-2 pd-x-20">حفظ</button>
    <a href="{!! route('questionBanks.index') !!}" class="btn btn-warning col-md-2" style="color: #fff;">الغاء</a>
</div>
    @endif



    @endif

