<div id="optionsDiv" style="display: none;">
<!-- Title Field -->
<div class="row" id="optionID">
    <div class="col-md-12 form-group mb-3">
        <label for="title">نص السؤال</label>
        {{--<div id="questionOptionTitle" type="text" class="form-control"> </div>--}}
        {{--<input style="display: none;" id="questionOptionTitleInput" name="optionTitleInput" type="text" class="form-control">--}}

        <textarea class="full-featured" name="optionTitleInput"> </textarea>

    </div>
</div>


<!-- Num Of Options Field -->
{{--<div class="row">--}}
    {{--<div class="col-md-12 form-group mb-3">--}}
        {{--<label for="title">عدد الأختيارات</label>--}}
        {{--<select name="num_of_options" id="num_of_options" class="form-control">--}}
            {{--<option value="">اختار</option>--}}
            {{--@for($i = 1; $i < 6; $i++)--}}
                {{--<option value="{{$i}}">{{$i}}</option>--}}
            {{--@endfor--}}
        {{--</select>--}}
    {{--</div>--}}
{{--</div>--}}

    <div id="optionsInputs">

        @for($i=0; $i<6; $i++)
            <div class="row">

                <div class="col-md-9 form-group mb-3">
                    <label for="title">العنوان</label>
                {{--<div id="questionTitle" class="form-control"> </div>--}}
                {{--<input style="display: none;" id="questionEssayInput" name="essayInput" type="text" class="form-control">--}}
                {{--<textarea class="full-featured" name="essayInput"> </textarea>--}}
                    <textarea class="full-featured" name="option[]"> </textarea>
                 </div>
                 <div class='col-md-3 form-group mb-3' style='margin-top: 30px;'>
                                 <label class='checkbox checkbox-primary'>
                                       <input type='checkbox' name='is_true_option[{{$i}}]'  value='1'>
                                     <span>الأجابة الصحيحة</span>
                                     <span class='checkmark'></span>
                                 </label>
                  </div>
                <div class="col-md-8 input-group mb-3">
                       <div class="custom-file">
                           <input name="files[]" type="file" class="custom-file-input" id="inputGroupFile02">
                           <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02"></label>
                       </div>
                    <div class="input-group-append">
                        <span class="input-group-text" id="inputGroupFileAddon02">Upload</span>
                    </div>
                </div>

            </div>

        @endfor


    </div>

</div>



{{--<script>--}}
    {{--$( document ).ready(function() {--}}

        {{--$('#num_of_options').on('change', function (e) {--}}


            {{--var number = e.target.value;--}}

                    {{--@php $counter = 0; @endphp--}}

                    {{--$("#optionsInputs").html("");--}}
                    {{--var i = 0;--}}
            {{--for (i = 0; i < number; i++) {--}}
                {{--var name = "option[]";--}}
                {{--var input = "<input type='text' name ="+name+" class='form-control'>";--}}
                {{--var optionDiv = "<div class='row'>\n" +--}}
                    {{--"    <div class='col-md-9 form-group mb-3'>\n" +--}}
                    {{--"        <label >الأسم</label>\n" +--}}
                    {{--"           "+ input+--}}
                    {{--"       </div>" +--}}
                    {{--" <div class='col-md-3 form-group mb-3' style='margin-top: 30px;'>\n" +--}}
                    {{--"             <label class='checkbox checkbox-primary'>\n" +--}}
                    {{--"                 <input type='checkbox' name='is_true_option["+i+"]'  value='1' \n" +--}}
                    {{--"                 <span>الأجابة الصحيحة</span>\n" +--}}
                    {{--"                 <span class='checkmark'></span>\n" +--}}
                    {{--"             </label>\n" +--}}
                    {{--"         </div>"+--}}
                {{--'<div class="col-md-8 input-group mb-3">\n' +--}}
                {{--'    <div class="custom-file">\n' +--}}
                {{--'          <input name="files[]" type="file" class="custom-file-input" id="inputGroupFile02">\n' +--}}
                {{--'          <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02"></label>\n' +--}}
                {{--'            </div>\n' +--}}
                {{--'       <div class="input-group-append">\n' +--}}
                {{--'                  <span class="input-group-text" id="inputGroupFileAddon02">Upload</span>\n' +--}}
                {{--'         </div>\n' +--}}
                {{--'     </div>'--}}
                {{--"</div>";--}}

                        {{--$("#optionsInputs").append(optionDiv);--}}


                        {{--@php $counter++; @endphp--}}

            {{--}--}}

        {{--});--}}


    {{--});--}}
{{--</script>--}}