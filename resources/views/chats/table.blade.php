
<table id="table-data" class="display nowrap dataTable" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>#</th>
        <th>Form</th>
        <th>To</th>
        <th>Message</th>
        <th>Is Read</th>
        <th>Action</th>
    </tr>
    </thead>

       <tbody>
        {{--@foreach($chats as $chat)--}}
            {{--<tr>--}}
                {{--<td><div class="checkbox checkbox-danger">--}}
                        {{--<input id="{!! $chat->id !!}" type="checkbox" name="ids[]" value="{!! $chat->id !!}">--}}
                        {{--<label for="{!! $chat->id !!}">  </label>--}}
                    {{--</div></td>--}}

                {{--
                <td>{!! $chat->form !!}</td>
            <td>{!! $chat->to !!}</td>
            <td>{!! $chat->message !!}</td>
            <td>{!! $chat->is_read !!}</td>

                --}}
                {{--<td>--}}
                    {{--<div class='btn-group'>--}}
                        {{--<a href="{!! route('chats.show', [$chat->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-eye"></i></a>--}}
                        {{--<a href="{!! route('chats.edit', [$chat->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-edit"></i></a>--}}
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
                "url": "{{route('chats.ajax')}}",
                "type": "GET",
            },
            "columns": [
                {"data": "id"},
               {"data": "form"},
               {"data": "to"},
               {"data": "message"},
               {"data": "is_read"},

                {"data": "options", orderable: false, searchable: false}
            ],
            "order": [
                [0, "asc"]
            ],
            //"oLanguage": {"sUrl": config.url + '/datatable-lang-' + "ar" + '.json'}

        });
    });
</script>