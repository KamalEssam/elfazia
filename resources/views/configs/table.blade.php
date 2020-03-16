
<table id="table-data" class="display nowrap dataTable" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>#</th>
        <th>Max Height</th>
        <th>Max Width</th>
        <th>Max Length</th>
        <th>Max Weight</th>
        <th>Dvided Ratio</th>
        <th>Max Hour Ship</th>
        <th>Rules Ar</th>
        <th>Rules En</th>
        <th>About Us Ar</th>
        <th>About Us En</th>
        <th>Action</th>
    </tr>
    </thead>

       <tbody>
        {{--@foreach($configs as $config)--}}
            {{--<tr>--}}
                {{--<td><div class="checkbox checkbox-danger">--}}
                        {{--<input id="{!! $config->id !!}" type="checkbox" name="ids[]" value="{!! $config->id !!}">--}}
                        {{--<label for="{!! $config->id !!}">  </label>--}}
                    {{--</div></td>--}}

                {{--
                <td>{!! $config->max_height !!}</td>
            <td>{!! $config->max_width !!}</td>
            <td>{!! $config->max_length !!}</td>
            <td>{!! $config->max_weight !!}</td>
            <td>{!! $config->dvided_ratio !!}</td>
            <td>{!! $config->max_hour_ship !!}</td>
            <td>{!! $config->rules_ar !!}</td>
            <td>{!! $config->rules_en !!}</td>
            <td>{!! $config->about_us_ar !!}</td>
            <td>{!! $config->about_us_en !!}</td>

                --}}
                {{--<td>--}}
                    {{--<div class='btn-group'>--}}
                        {{--<a href="{!! route('configs.show', [$config->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-eye"></i></a>--}}
                        {{--<a href="{!! route('configs.edit', [$config->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-edit"></i></a>--}}
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
                "url": "{{route('configs.ajax')}}",
                "type": "GET",
            },
            "columns": [
                {"data": "id"},
               {"data": "max_height"},
               {"data": "max_width"},
               {"data": "max_length"},
                 {"data": "max_weight"},
               {"data": "dvided_ratio"},
               {"data": "max_hour_ship"},
               {"data": "rules_ar"},
               {"data": "rules_en"},
               {"data": "about_us_ar"},
               {"data": "about_us_en"},

                {"data": "options", orderable: false, searchable: false}
            ],
            "order": [
                [0, "asc"]
            ],
            //"oLanguage": {"sUrl": config.url + '/datatable-lang-' + "ar" + '.json'}

        });
    });
</script>