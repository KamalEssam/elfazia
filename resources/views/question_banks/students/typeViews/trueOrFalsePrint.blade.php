<script>
    var isDisplayAnswer = false;
</script>

<div id="trueFalseDiv" style="display: block" >

<!-- Title Field -->
<div class="row" style="display: block;" id="true_or_falseID">
    <div class="col-md-12 form-group mb-3">
        <label for="title">نص السؤال</label>
        <br>
        {!! $questions->title !!}


    </div>
</div>

<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label class="checkbox checkbox-primary">
            <input type="checkbox" id="is_true" name="is_true" value="1" >
            <span>اجابة صحيحة</span>
            <span class="checkmark"></span>
        </label>
    </div>
</div>
</div>

@if($showBtns == true)

@if(\App\Models\QuestionBank::find($bank_id)->is_exam == 0)

<script>
    function submitOption(){
        var link = appUrl + '/questionsBank/ajax/check?question_id={{$questions->id}}';
        if($("#is_true").prop("checked") === true) {
            link += "&is_true=1";
        }

        if (isDisplayAnswer === true) {
            $("#testForm").submit();
            return
        }

        $.get(link, function (data) {


            if (data.length !== 0) {
                console.log(data);
                console.log(data.success);
                if(data.success === true) {
                    $("#testForm").submit();
                } else {
                    $('#is_true').attr('name', function(){
                        return 'is_wrong';
                    });

                    isDisplayAnswer = true;
                    if($("#is_true").prop("checked") === true) {
                        $('#is_true').prop('checked', false);
                    } else {
                        $('#is_true').prop('checked', true);
                    }
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