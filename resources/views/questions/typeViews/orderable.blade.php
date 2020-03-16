
<div id="orderDiv" style="display: none;">
    <!-- Title Field -->
    <div class="row" id="">
        <div class="col-md-12 form-group mb-3">
            <label for="title">نص السؤال</label>
            <input style="display: block;" id="orderableTitleInput" name="orderableTitleInput" type="text" class="form-control">
        </div>
    </div>

    <!-- Num Of Options Field -->
    <div class="row">
        <div class="col-md-12 form-group mb-3">
            <label for="title">عدد الأختيارات</label>
            <select name="num_of_orders" id="num_of_orders" class="form-control">
                <option value="">اختار</option>
                @for($i = 1; $i < 6; $i++)
                    <option value="{{$i}}">{{$i}}</option>
                @endfor
            </select>
        </div>
    </div>

    <div id="ordersInput">


    </div>

</div>


<script>
    $( document ).ready(function() {

        $('#num_of_orders').on('change', function (e) {


            var number = e.target.value;

            @php $counter = 0; @endphp

            $("#ordersInput").html("");

            for (i = 0; i < number; i++) {

                var input = '{!! Form::text("titleOrders[]", null, ['class' => 'form-control']) !!}';
                var inputAnswer = '{!! Form::text("orders[]", null, ['class' => 'form-control']) !!}';
                var optionDiv = "<div class='row'>\n" +
                    "    <div class='col-md-6 form-group mb-3'>\n" +
                    "        <label >الجملة</label>\n" +
                    "           "+ input+
                    "       </div>" +
                    "    <div class='col-md-6 form-group mb-3'>\n" +
                    "        <label >الترتيب</label>\n" +
                    "           "+ inputAnswer+
                    "       </div>" +
                "</div>";

                $("#ordersInput").append(optionDiv);
            }

        });


    });
</script>