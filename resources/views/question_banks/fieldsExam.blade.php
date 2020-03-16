

<div class="form-body">
<!-- Title Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="title">العنوان</label>
            {!! Form::text('title', null, ['class' => 'form-control','id' => "title","required"]) !!}
       </div>
</div>

<!-- Description Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label for="description">الوصف</label>
            {!! Form::text('description', null, ['class' => 'form-control','id' => "description","required"]) !!}
       </div>
</div>

<!-- Description Hide Field -->
<div class="row">
    <div class="col-md-12 form-group mb-3">
        <label class="checkbox checkbox-primary">
            <input type="checkbox" name="description_hide" value="1"
                   @if(isset($questionBank) && $questionBank->description_hide == 1) checked @endif>
            <span>اخفاء الوصف</span>
            <span class="checkmark"></span>
        </label>
    </div>
</div>

<!-- Retry Hide Field -->
     <div class="row">
         <div class="col-md-12 form-group mb-3">
             <label class="checkbox checkbox-primary">
                 <input type="checkbox" name="retry_hide" value="1"
                        @if(isset($questionBank) && $questionBank->retry_hide == 1) checked @endif>
                 <span> اخفاء اعادة المحاولة</span>
                 <span class="checkmark"></span>
             </label>
         </div>
     </div>


<!-- Shuffle Field -->
     <div class="row">
         <div class="col-md-12 form-group mb-3">
             <label class="checkbox checkbox-primary">
                 <input type="checkbox" name="shuffle" value="1"
                        @if(isset($questionBank) && $questionBank->shuffle == 1) checked @endif>
                 <span>ترتيب الأسئلة عشوائيا</span>
                 <span class="checkmark"></span>
             </label>
         </div>
     </div>


<!-- Shuffle Answers Field -->

     <div class="row">
         <div class="col-md-12 form-group mb-3">
             <label class="checkbox checkbox-primary">
                 <input type="checkbox" name="shuffle_answers" value="1"
                        @if(isset($questionBank) && $questionBank->shuffle_answers == 1) checked @endif>
                 <span>اعرض الأجابات عشوائيا</span>
                 <span class="checkmark"></span>
             </label>
         </div>
     </div>


<!-- Has End Time Field -->
     <div class="row">
         <div class="col-md-12 form-group mb-3">
             <label class="checkbox checkbox-primary">
                 <input type="checkbox" name="has_end_time" value="1" id="has_end_time"
                        @if(isset($questionBank) && $questionBank->has_end_time == 1) checked @endif>
                 <span>لديه وقت محدد</span>
                 <span class="checkmark"></span>
             </label>
         </div>
     </div>



     <!-- Time Of Bank Field -->
<div class="row" style=" @if(isset($questionBank) && $questionBank->has_end_time == 1)  display: block; @else display: none; @endif"
     id="time_of_bank">
    <div class="col-md-12 form-group mb-3">
        <label for="time_of_bank">الوقت المحدد بالدقايق</label>
            {!! Form::text('time_of_bank', null, ['class' => 'form-control','id' => ""]) !!}
       </div>
</div>


<!-- Full Display Field -->

     <div class="row">
         <div class="col-md-12 form-group mb-3">
             <label class="checkbox checkbox-primary">
                 <input type="checkbox" name="full_display" value="1"
                        @if(isset($questionBank) && $questionBank->full_display == 1) checked @endif>
                 <span>اظهار زر عرض الأسئلة بالكامل</span>
                 <span class="checkmark"></span>
             </label>
         </div>
     </div>


<!-- Guest Hide Field -->
     <div class="row">
         <div class="col-md-12 form-group mb-3">
             <label class="checkbox checkbox-primary">
                 <input type="checkbox" name="guest_hide" value="1"
                        @if(isset($questionBank) && $questionBank->guest_hide == 1) checked @endif>
                 <span>اظهار للزوار</span>
                 <span class="checkmark"></span>
             </label>
         </div>
     </div>


     <!-- Link Temp Field -->
{{--<div class="row">--}}
    {{--<div class="col-md-12 form-group mb-3">--}}
        {{--<label for="link_temp">رابط عشوائي</label>--}}
            {{--{!! Form::text('link_temp', null, ['class' => 'form-control','id' => "link_temp"]) !!}--}}
       {{--</div>--}}
{{--</div>--}}

<!-- Must Answer All Bank Field -->

     <div class="row">
         <div class="col-md-12 form-group mb-3">
             <label class="checkbox checkbox-primary">
                 <input type="checkbox" name="must_answer_all_bank" value="1"
                        @if(isset($questionBank) && $questionBank->must_answer_all_bank == 1) checked @endif>
                 <span>اجبار الطالب علي اجابة كل الأسئلة</span>
                 <span class="checkmark"></span>
             </label>
         </div>
     </div>


<!-- Power Question Hide Field -->
     <div class="row">
         <div class="col-md-12 form-group mb-3">
             <label class="checkbox checkbox-primary">
                 <input type="checkbox" name="power_question_hide" value="1"
                        @if(isset($questionBank) && $questionBank->power_question_hide == 1) checked @endif>
                 <span>اخفاء قوة السؤال</span>
                 <span class="checkmark"></span>
             </label>
         </div>
     </div>


<!-- Level Id Field -->

     <!-- Level Id Field -->
     <div class="row">
         <div class="col-md-12 form-group mb-3">
             <label for="level_id">المستوي</label>
             <select class="form-control" id="level_id" name="level_id">
                 <option>اختار</option>
                 @foreach(\App\Models\Level::all() as $level)
                     <option value="{{$level->id}}" @if(isset($questionBank) && $questionBank->level_id == $level->id) selected @endif>
                         {{$level->name}}</option>
                 @endforeach
             </select>
         </div>
     </div>
     <div class="row">
         <div class="col-md-12 form-group mb-3">
             <label for="group_id">المجموعات</label>
             <select class="form-control" id="groups" name="groups[]" multiple>
                 @if(isset($questionBank))
                     @php $groups = $questionBank->groups()->pluck("group_id")->toArray(); @endphp
                     @foreach(\App\Models\Group::where("level_id",$questionBank->level_id)->get() as $group)
                         <option value="{{$group->id}}" @if(in_array($group->id, $groups)) selected @endif>
                             {{$group->name}}</option>
                     @endforeach
                     @endif

             </select>
         </div>
     </div>

    <div class="row">
        <div class="col-md-12 form-group mb-3">
            <label class="checkbox checkbox-primary">
                <input type="checkbox" id="power_by_bank" name="power_by_bank" value="1"
                      >
                <span>توليد من بنك اسئلة</span>
                <span class="checkmark"></span>
            </label>
        </div>
    </div>

    <div id="generate" style="display: none;">

    <div class="row">
        <div class="col-md-12 form-group mb-3">
            <label for="title">عدد الأسئلة</label>
            {!! Form::text('num_of_questions', null, ['class' => 'form-control','id' => "num_of_question"]) !!}
        </div>
    </div>


    <div class="row">
        <div class="col-md-12 form-group mb-3">
            <label for="level_id">قوة السؤال</label>
            <select class="form-control" id="question_power" name="question_power_id">
                <option value="">اختار</option>
                @foreach(\App\Models\QuestionPower::all() as $power)
                    <option value="{{$power->id}}">
                        {{$power->title}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 form-group mb-3">
            <label for="group_id">اختار من بنك الأسئلة</label>
            <select class="form-control" id="banks" name="banks[]" multiple>
                    @foreach(\App\Models\QuestionBank::where("is_exam",0)->get() as $bank)
                        <option value="{{$bank->id}}" >
                            {{$bank->title}}</option>
                    @endforeach

            </select>
        </div>
    </div>
    {{--<button type="submit" class="btn btn-primary col-md-2 pd-x-20">اعرض الأسئلة</button>--}}


    <button type="button" onclick="showQuestions()" class="btn btn-primary col-md-2 pd-x-20">عرض الأسئلة</button>

    <br><br>
    <div class="row" id="questionsGenerate" style="display: none;">
        <div class="col-md-12 form-group mb-3">
            <label for="group_id">اختار من الأسئلة</label>
            <select class="form-control" id="questions" name="questions[]" multiple>
            </select>
        </div>
    </div>

    </div>



</div>

<div class="" style="margin-top:20px;">
     <button type="submit" class="btn btn-primary col-md-2 pd-x-20">حفظ</button>
    <a href="{!! route('questionBanks.index') !!}" class="btn btn-warning col-md-2" style="color: #fff;">الغاء</a>
</div>


 <script>
     function showQuestions() {
         var power = $('#question_power').val();
         var banks = $('#banks').val();
         $.get(appUrl + '/questionsBank/generate/ajax?power='+power+'&banks='+banks, function (data) {

             $("#questionsGenerate").fadeIn(1000);
             $('#questions').empty();
             if (data.length !== 0) {
                 $.each(data, function (index, subCatObj) {
                     $('#questions').append($('<option>', {
                         value: subCatObj.id,
                         text: subCatObj.title
                     }));

                 });

             }

         });
     }

     $( document ).ready(function() {

         $('#power_by_bank').on('change', function (e) {
             if($(this).prop("checked") == true) {
                 $("#generate").fadeIn(1000);
             } else {
                 $("#generate").fadeOut(1000);
             }

         });

         $('#has_end_time').on('change', function (e) {
             if($(this).prop("checked") == true) {
                 $("#time_of_bank").fadeIn(1000);
             } else {
                 $("#time_of_bank").fadeOut(1000);
             }

         });
         // var level_id = $('#level_id').val();
         // if (level_id > 0) {
         //     $.get(appUrl + '/groups/ajax/' + level_id, function (data) {
         //
         //         $('#groups').empty();
         //
         //         if (data.length !== 0) {
         //             $.each(data, function (index, subCatObj) {
         //
         //                 $('#groups').append($('<option>', {
         //                     value: subCatObj.id,
         //                     text: subCatObj.name
         //                 }));
         //
         //             });
         //
         //         }
         //
         //     });
         // }
         // else {
         //     $('#groups').empty();
         //
         //     $('#groups').append($('<option>', {
         //         value: '',
         //         text: "اختر",
         //         selected: true
         //     }));
         // }
         $('#level_id').on('change', function (e) {


             var level_id = e.target.value;
             if (level_id > 0) {
                 $.get(appUrl + '/groups/ajax/' + level_id, function (data) {

                     $('#groups').empty();

                     if (data.length !== 0) {
                         $.each(data, function (index, subCatObj) {

                             $('#groups').append($('<option>', {
                                 value: subCatObj.id,
                                 text: subCatObj.name
                             }));

                         });

                     }

                 });
             }
             else {
                 $('#groups').empty();

                 $('#groups').append($('<option>', {
                     value: '',
                     text: "اختر",
                     selected: true
                 }));
             }

         });
     });


 </script>