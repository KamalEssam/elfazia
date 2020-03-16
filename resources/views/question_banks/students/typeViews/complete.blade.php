


<div id="completeDiv" style="display: block">
    <!-- Title Field -->
    <div class="row" id="">
        <div class="col-md-12 form-group mb-3">
            <label for="title">نص السؤال</label>
            <input disabled style="display: block;"  value="{{$questions->title}}" type="text" class="form-control">
        </div>
    </div>

    <div id="completeInput">

        @for($i = 1; $i<= $questions->options->count(); $i++)
            <div class="row" id="">
                <div class="col-md-12 form-group mb-3">
                    <label for="title">جملة {{$i}}</label>
                    <input type="text" name="complete[]" placeholder="word" class="form-control">
                </div>
            </div>
        @endfor

    </div>

</div>
