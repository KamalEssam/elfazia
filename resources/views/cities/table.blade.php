
<table id="table-data" class="display nowrap dataTable" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>#</th>
        <th>الاسم</th>
        <th>العمليات</th>
    </tr>
    </thead>

       <tbody>
        {{--@foreach($cities as $city)--}}
            {{--<tr>--}}
                {{--<td><div class="checkbox checkbox-danger">--}}
                        {{--<input id="{!! $city->id !!}" type="checkbox" name="ids[]" value="{!! $city->id !!}">--}}
                        {{--<label for="{!! $city->id !!}">  </label>--}}
                    {{--</div></td>--}}

                {{--
                <td>{!! $city->name_ar !!}</td>
            <td>{!! $city->name_en !!}</td>

                --}}
                {{--<td>--}}
                    {{--<div class='btn-group'>--}}
                        {{--<a href="{!! route('cities.show', [$city->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-eye"></i></a>--}}
                        {{--<a href="{!! route('cities.edit', [$city->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-edit"></i></a>--}}
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
                "url": "{{route('cities.ajax')}}",
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