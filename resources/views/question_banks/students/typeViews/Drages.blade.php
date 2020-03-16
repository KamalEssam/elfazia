


<div id="orderDiv" style="display: block">
    <!-- Title Field -->
    <div class="row" id="">
        <div class="col-md-12 form-group mb-3">
            <label for="title">نص السؤال</label>
            <input disabled style="display: block;"  value="{{$questions->title}}" type="text" class="form-control">
        </div>
    </div>

    <div id="ordersInput">
        <div class="row">
            <div class="col-md-6">
                <ul class="list-group" id="sortable">
                    @for($i = 0; $i< $questions->matches->count(); $i++)
                        <li class="list-group-item" id="{{$questions->matches[$i]->id}}">{{$questions->matches[$i]->title}}</li>
                    @endfor
                </ul>
                <input type="hidden" name="titles" id="titleIDs" value="">

            </div>


            <div class="col-md-6">
                <ul class="list-group" id="sortable1">
                    @php /** @var \App\Models\Question $questions **/ @endphp
                @php $matches = $questions->matches()->inRandomOrder()->get(); @endphp
                @for($i = 0; $i< $matches->count(); $i++)
                    <li class="list-group-item" id="{{$matches[$i]->id}}">{{$matches[$i]->answer}}</li>
                @endfor
            </ul>
            <input type="hidden" name="answers" id="answerIDs" value="">

            </div>
        </div>




    </div>

</div>
<script>
    $( function() {
        $( "#sortable" ).sortable();
        $( "#sortable" ).disableSelection();
        $( "#sortable1" ).sortable();
        $( "#sortable1" ).disableSelection();
    } );

</script>

<script>
    function submit(){

        var idsInTitle = $("#sortable").sortable("toArray");
        var idsInAnswer = $("#sortable1").sortable("toArray");
        //-----------------^^^^

        $("#titleIDs").val(idsInTitle);
        $("#answerIDs").val(idsInAnswer);
        $("#testForm").submit();
    }

</script>