
<table id="table-data" class="table table-hover dataTable ">
        <thead class="thead-dark">
    <tr>
        <th>#</th>
        <th>العنوان</th>
        <th>المستوي</th>
        <th>الأسئلة</th>
        <th>شير</th>
        <th>طباعة</th>
        <th>#</th>
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
                "url": "{{route('questionBanks.ajax')}}",
                "type": "GET",
            },
            "columns": [
                {"data": "id"},
               {"data": "title"},
               {"data": "level", name:"levels.name"},

                {"data": "questions", orderable: false, searchable: false},
                {"data": "share", orderable: false, searchable: false},
                {"data": "print", orderable: false, searchable: false},
                {"data": "options", orderable: false, searchable: false}
            ],
            "order": [
                [0, "desc"]
            ],
            //"oLanguage": {"sUrl": config.url + '/datatable-lang-' + "ar" + '.json'}

        });
    });
</script>