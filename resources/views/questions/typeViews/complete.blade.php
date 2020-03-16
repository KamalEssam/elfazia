
<div id="completeDiv" style="display: none;">
    <!-- Title Field -->
    <div class="row" id="">
        <div class="col-md-12 form-group mb-3">
            <label for="title">نص السؤال</label>
            <input style="display: block;" id="completeTitleInput" name="completeTitleInput" type="text" class="form-control">
        </div>
    </div>

    <!-- Num Of Options Field -->
    <div class="row">
        <div class="col-md-12 form-group mb-3">
            <label for="title">عدد الكلمات</label>
            <select name="num_of_words" id="num_of_words" class="form-control">
                <option value="">اختار</option>
                @for($i = 1; $i < 6; $i++)
                    <option value="{{$i}}">{{$i}}</option>
                @endfor
            </select>
        </div>
    </div>

    <div id="wordsInput">


    </div>

</div>


<script>
    $( document ).ready(function() {

        $('#num_of_words').on('change', function (e) {


            var number = e.target.value;

            @php $counter = 0; @endphp

            $("#wordsInput").html("");

            for (i = 0; i < number; i++) {

                var input = '{!! Form::text("titleWords[]", null, ['class' => 'form-control', 'placeholder' => "[word1,word2]"]) !!}';
                var optionDiv = "<div class='row'>\n" +
                    "    <div class='col-md-12 form-group mb-3'>\n" +
                    "        <label >الجملة</label>\n" +
                    "           "+ input+
                    "       </div>" +
                "</div>";

                $("#wordsInput").append(optionDiv);
            }

        });


    });
</script>