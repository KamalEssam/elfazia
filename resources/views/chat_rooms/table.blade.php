
<table id="table-data" class="display nowrap dataTable" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>#</th>
        <th>From</th>
        <th>To</th>
        <th>Action</th>
    </tr>
    </thead>

       <tbody>
        {{--@foreach($chatRooms as $chatRoom)--}}
            {{--<tr>--}}
                {{--<td><div class="checkbox checkbox-danger">--}}
                        {{--<input id="{!! $chatRoom->id !!}" type="checkbox" name="ids[]" value="{!! $chatRoom->id !!}">--}}
                        {{--<label for="{!! $chatRoom->id !!}">  </label>--}}
                    {{--</div></td>--}}

                {{--
                <td>{!! $chatRoom->from !!}</td>
            <td>{!! $chatRoom->to !!}</td>

                --}}
                {{--<td>--}}
                    {{--<div class='btn-group'>--}}
                        {{--<a href="{!! route('chatRooms.show', [$chatRoom->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-eye"></i></a>--}}
                        {{--<a href="{!! route('chatRooms.edit', [$chatRoom->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-edit"></i></a>--}}
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
                "url": "{{route('chatRooms.ajax')}}",
                "type": "GET",
            },
            "columns": [
                {"data": "id"},
               {"data": "from"},
               {"data": "to"},

                {"data": "options", orderable: false, searchable: false}
            ],
            "order": [
                [0, "asc"]
            ],
            //"oLanguage": {"sUrl": config.url + '/datatable-lang-' + "ar" + '.json'}

        });
    });
</script>