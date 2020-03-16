
<table id="table-data" class="table table-hover dataTable ">
        <thead class="thead-dark">
    <tr>
        <th>code</th>
        <th>العنوان</th>
        <th>المستوي</th>
        <th>اختبر</th>
        <th>شير</th>
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
                "url": "{{route('questionBanks.studentAjax')}}?isExam={{$isExam}}",
                "type": "GET",
            },
            "columns": [
               {"data": "code"},
               {"data": "title"},
               {"data": "level", name:"levels.name"},

                {"data": "test_now", orderable: false, searchable: false},
                {"data": "share", orderable: false, searchable: false}
            ],
            "order": [
                [0, "desc"]
            ],
            //"oLanguage": {"sUrl": config.url + '/datatable-lang-' + "ar" + '.json'}

        });
    });
</script>