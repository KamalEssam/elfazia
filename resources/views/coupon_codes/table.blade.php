
<table id="table-data" class="display nowrap dataTable" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>#</th>
        <th>الكود</th>
        <th>تاريخ انتهاء الصلاحية</th>
        <th>نسبة الخصم</th>
        <th>العمليات</th>
    </tr>
    </thead>

       <tbody>
        {{--@foreach($couponCodes as $couponCode)--}}
            {{--<tr>--}}
                {{--<td><div class="checkbox checkbox-danger">--}}
                        {{--<input id="{!! $couponCode->id !!}" type="checkbox" name="ids[]" value="{!! $couponCode->id !!}">--}}
                        {{--<label for="{!! $couponCode->id !!}">  </label>--}}
                    {{--</div></td>--}}

                {{--
                <td>{!! $couponCode->code !!}</td>
            <td>{!! $couponCode->expire_date !!}</td>
            <td>{!! $couponCode->discount !!}</td>

                --}}
                {{--<td>--}}
                    {{--<div class='btn-group'>--}}
                        {{--<a href="{!! route('couponCodes.show', [$couponCode->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-eye"></i></a>--}}
                        {{--<a href="{!! route('couponCodes.edit', [$couponCode->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-edit"></i></a>--}}
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
                "url": "{{route('couponCodes.ajax')}}",
                "type": "GET",
            },
            "columns": [
                {"data": "id"},
               {"data": "code"},
               {"data": "expire_date"},
               {"data": "discount"},

                {"data": "options", orderable: false, searchable: false}
            ],
            "order": [
                [0, "asc"]
            ],
            //"oLanguage": {"sUrl": config.url + '/datatable-lang-' + "ar" + '.json'}

        });
    });
</script>