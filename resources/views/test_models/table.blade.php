
<table id="table-data" class="display nowrap dataTable" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Name</th>
        <th>Title</th>
        <th>Title</th>
        <th>Action</th>
    </tr>
    </thead>

       <tbody>
        {{--@foreach($testModels as $testModel)--}}
            {{--<tr>--}}
                {{--<td><div class="checkbox checkbox-danger">--}}
                        {{--<input id="{!! $testModel->id !!}" type="checkbox" name="ids[]" value="{!! $testModel->id !!}">--}}
                        {{--<label for="{!! $testModel->id !!}">  </label>--}}
                    {{--</div></td>--}}

                {{--
                <td>{!! $testModel->name !!}</td>
            <td>{!! $testModel->name !!}</td>
            <td>{!! $testModel->title !!}</td>
            <td>{!! $testModel->title !!}</td>

                --}}
                {{--<td>--}}
                    {{--<div class='btn-group'>--}}
                        {{--<a href="{!! route('testModels.show', [$testModel->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-eye"></i></a>--}}
                        {{--<a href="{!! route('testModels.edit', [$testModel->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-edit"></i></a>--}}
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
                "url": "{{route('testModels.ajax')}}",
                "type": "GET",
            },
            "columns": [
                {"data": "id"},
               {"data": "name"},
               {"data": "name"},
               {"data": "title"},
               {"data": "title"},

                {"data": "options", orderable: false, searchable: false}
            ],
            "order": [
                [0, "asc"]
            ],
            //"oLanguage": {"sUrl": config.url + '/datatable-lang-' + "ar" + '.json'}

        });
    });
</script>