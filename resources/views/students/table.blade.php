
<table id="table-data" class="table table-hover dataTable ">
        <thead class="thead-dark">
    <tr>
        <th>#</th>
        <th>الأسم</th>
        <th>الهاتف</th>
        <th>تصحيح</th>
        <th>تصحيح</th>
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
                "url": "{{route('students.ajax')}}",
                "type": "GET",
            },
            "columns": [
                {"data": "id"},
               {"data": "name"},
               {"data": "mobile"},
               {"data": "questions_bank"},
               {"data": "exams"},
                {"data": "options", orderable: false, searchable: false}
            ],
            "order": [
                [0, "desc"]
            ],
            //"oLanguage": {"sUrl": config.url + '/datatable-lang-' + "ar" + '.json'}

        });
    });
</script>