
<table id="table-data" class="table table-hover dataTable ">
        <thead class="thead-dark">
    <tr>
        <th>#</th>
        <th>Title</th>
        <th>Question Id</th>
        <th>Is True</th>
        <th>Ordered</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>

    </tbody>
</table>



<script>
    $( document ).ready(function() {
        datatable = $('.dataTable').dataTable({
            //"processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{route('questionOptions.ajax')}}",
                "type": "GET",
            },
            "columns": [
                {"data": "id"},
               {"data": "title"},
               {"data": "question_id"},
               {"data": "is_true"},
               {"data": "ordered"},

                {"data": "options", orderable: false, searchable: false}
            ],
            "order": [
                [0, "asc"]
            ],
            //"oLanguage": {"sUrl": config.url + '/datatable-lang-' + "ar" + '.json'}

        });
    });
</script>