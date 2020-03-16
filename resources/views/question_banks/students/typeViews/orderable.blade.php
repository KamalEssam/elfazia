


<div id="orderDiv" style="display: block">
    <!-- Title Field -->
    <div class="row" id="">
        <div class="col-md-12 form-group mb-3">
            <label for="title">نص السؤال</label>
            <input disabled style="display: block;"  value="{{$questions->title}}" type="text" class="form-control">
        </div>
    </div>

    <div id="ordersInput">

        <ul class="list-group" id="sortable">
            @for($i = 0; $i< $questions->options->count(); $i++)
            <li class="list-group-item" id="{{$questions->options[$i]->id}}">{{$questions->options[$i]->title}}</li>
                @endfor
        </ul>
        <input type="hidden" name="orderIds" id="orderIDs" value="">

    </div>

</div>
<script>
    $( function() {
        $( "#sortable" ).sortable();
        $( "#sortable" ).disableSelection();
    } );

</script>

<script>
    function submit(){
        var idsInOrder = $("#sortable").sortable("toArray");
        //-----------------^^^^
        console.log(idsInOrder);
        $("#orderIDs").val(idsInOrder);
        $("#testForm").submit();
    }

</script>