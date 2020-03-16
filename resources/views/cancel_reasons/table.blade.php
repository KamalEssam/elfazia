
<table id="table-data" class="display nowrap dataTable" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>#</th>
        <th>الاسم عربي</th>
        <th>العمليات</th>
    </tr>
    </thead>

       <tbody>
        {{--@foreach($cancelReasons as $cancelReason)--}}
            {{--<tr>--}}
                {{--<td><div class="checkbox checkbox-danger">--}}
                        {{--<input id="{!! $cancelReason->id !!}" type="checkbox" name="ids[]" value="{!! $cancelReason->id !!}">--}}
                        {{--<label for="{!! $cancelReason->id !!}">  </label>--}}
                    {{--</div></td>--}}

                {{--
                <td>{!! $cancelReason->name_ar !!}</td>
            <td>{!! $cancelReason->name_en !!}</td>

                --}}
                {{--<td>--}}
                    {{--<div class='btn-group'>--}}
                        {{--<a href="{!! route('cancelReasons.show', [$cancelReason->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-eye"></i></a>--}}
                        {{--<a href="{!! route('cancelReasons.edit', [$cancelReason->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-edit"></i></a>--}}
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
                "url": "{{route('cancelReasons.ajax')}}",
                "type": "GET",
            },
            "columns": [
                {"data": "id"},
               {"data": "name_ar"},

                {"data": "options", orderable: false, searchable: false}
            ],
            "order": [
                [0, "asc"]
            ],
            //"oLanguage": {"sUrl": config.url + '/datatable-lang-' + "ar" + '.json'}

        });
    });
</script>