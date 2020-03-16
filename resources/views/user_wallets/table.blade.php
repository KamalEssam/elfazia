
<table id="table-data" class="display nowrap dataTable" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>#</th>
        <th>Message</th>
        <th>Cost</th>
        <th>User Id</th>
        <th>Action</th>
    </tr>
    </thead>

       <tbody>
        {{--@foreach($userWallets as $userWallet)--}}
            {{--<tr>--}}
                {{--<td><div class="checkbox checkbox-danger">--}}
                        {{--<input id="{!! $userWallet->id !!}" type="checkbox" name="ids[]" value="{!! $userWallet->id !!}">--}}
                        {{--<label for="{!! $userWallet->id !!}">  </label>--}}
                    {{--</div></td>--}}

                {{--
                <td>{!! $userWallet->message !!}</td>
            <td>{!! $userWallet->cost !!}</td>
            <td>{!! $userWallet->user_id !!}</td>

                --}}
                {{--<td>--}}
                    {{--<div class='btn-group'>--}}
                        {{--<a href="{!! route('userWallets.show', [$userWallet->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-eye"></i></a>--}}
                        {{--<a href="{!! route('userWallets.edit', [$userWallet->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-edit"></i></a>--}}
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
                "url": "{{route('userWallets.ajax')}}",
                "type": "GET",
            },
            "columns": [
                {"data": "id"},
               {"data": "message"},
               {"data": "cost"},
               {"data": "user_id"},

                {"data": "options", orderable: false, searchable: false}
            ],
            "order": [
                [0, "asc"]
            ],
            //"oLanguage": {"sUrl": config.url + '/datatable-lang-' + "ar" + '.json'}

        });
    });
</script>