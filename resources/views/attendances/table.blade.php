
<table id="table-data" class="display nowrap dataTable" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>#</th>
        <th>المندوب</th>
        <th>حاضر</th>
        <th>اليوم </th>
        <th>وقت الحضور </th>
        <th>وقت الانصراف</th>
    </tr>
    </thead>

       <tbody>
        {{--@foreach($attendances as $attendance)--}}
            {{--<tr>--}}
                {{--<td><div class="checkbox checkbox-danger">--}}
                        {{--<input id="{!! $attendance->id !!}" type="checkbox" name="ids[]" value="{!! $attendance->id !!}">--}}
                        {{--<label for="{!! $attendance->id !!}">  </label>--}}
                    {{--</div></td>--}}

                {{--
                <td>{!! $attendance->attend !!}</td>
            <td>{!! $attendance->attend_date !!}</td>
            <td>{!! $attendance->time_attend !!}</td>
            <td>{!! $attendance->time_out !!}</td>

                --}}
                {{--<td>--}}
                    {{--<div class='btn-group'>--}}
                        {{--<a href="{!! route('attendances.show', [$attendance->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-eye"></i></a>--}}
                        {{--<a href="{!! route('attendances.edit', [$attendance->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-edit"></i></a>--}}
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
                "url": "{{route('attendances.ajax')}}?attendanceDate={{request("attendanceDate")}}",
                "type": "GET",
            },
            "columns": [
                {"data": "id"},
               {"data": "delivery",name:"users.name"},
               {"data": "attend"},
               {"data": "attend_date"},
               {"data": "time_attend"},
               {"data": "time_out"}

            ],
            "order": [
                [0, "asc"]
            ],
            //"oLanguage": {"sUrl": config.url + '/datatable-lang-' + "ar" + '.json'}

        });
    });
</script>