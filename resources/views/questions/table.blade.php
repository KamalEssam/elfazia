
<table id="table-data" class="table table-hover dataTable ">
        <thead class="thead-dark">
    <tr>
        <th>#</th>
        <th>نص السؤال</th>
        <th>الملاحظات</th>
        <th>نوع السؤال</th>
        <th>قوة السؤال</th>
        <th>الدرجة</th>
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
                "url": "{{route('questions.ajax')}}?bank_id={{$bank_id}}",
                "type": "GET",
            },
            "columns": [
                {"data": "id"},
               {"data": "title"},
               {"data": "note"},
               {"data": "question_type",},
               {"data": "question_power"},
               {"data": "grade"},
                {"data": "options", orderable: false, searchable: false}
            ],
            "order": [
                [0, "desc"]
            ],
            //"oLanguage": {"sUrl": config.url + '/datatable-lang-' + "ar" + '.json'}

        });
    });
</script>