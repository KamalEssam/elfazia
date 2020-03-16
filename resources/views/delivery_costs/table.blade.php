
<table id="table-data" class="display nowrap dataTable" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>#</th>
        <th>من</th>
        <th>الي</th>
        <th>عدد الكيلوهات الاولى بال كجم  </th>
        <th>سعر الكيلوهات الاولي</th>
        <th>سعر كل كيلو</th>
        <th>العمليات</th>
    </tr>
    </thead>

       <tbody>
        {{--@foreach($deliveryCosts as $deliveryCost)--}}
            {{--<tr>--}}
                {{--<td><div class="checkbox checkbox-danger">--}}
                        {{--<input id="{!! $deliveryCost->id !!}" type="checkbox" name="ids[]" value="{!! $deliveryCost->id !!}">--}}
                        {{--<label for="{!! $deliveryCost->id !!}">  </label>--}}
                    {{--</div></td>--}}

                {{--
                <td>{!! $deliveryCost->number_of_first_kilos !!}</td>
            <td>{!! $deliveryCost->price_for_first_kilos !!}</td>
            <td>{!! $deliveryCost->price_per_kilo !!}</td>

                --}}
                {{--<td>--}}
                    {{--<div class='btn-group'>--}}
                        {{--<a href="{!! route('deliveryCosts.show', [$deliveryCost->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-eye"></i></a>--}}
                        {{--<a href="{!! route('deliveryCosts.edit', [$deliveryCost->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-edit"></i></a>--}}
                    {{--</div>--}}
                {{--</td>--}}
            {{--</tr>--}}
        {{--@endforeach--}}
        </tbody>
</table>



<script>
    $( document ).ready(function() {
        datatable = $('.dataTable').dataTable({
            //"processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{route('deliveryCosts.ajax')}}",
                "type": "GET",
            },
            "columns": [
                {"data": "id"},
               {"data": "from_city"},
               {"data": "to_city"},
               {"data": "number_of_first_kilos"},
               {"data": "price_for_first_kilos"},
               {"data": "price_per_kilo"},

                {"data": "options", orderable: false, searchable: false}
            ],
            "order": [
                [0, "asc"]
            ],
            //"oLanguage": {"sUrl": config.url + '/datatable-lang-' + "ar" + '.json'}

        });
    });
</script>