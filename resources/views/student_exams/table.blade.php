
<table id="table-data" class="table table-hover dataTable ">
        <thead class="thead-dark">
    <tr>
        <th>#</th>
        <th>Student Id</th>
        <th>Exam Id</th>
        <th>Grade</th>
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
                "url": "{{route('studentExams.ajax')}}",
                "type": "GET",
            },
            "columns": [
                {"data": "id"},
               {"data": "student_id"},
               {"data": "exam_id"},
               {"data": "grade"},

                {"data": "options", orderable: false, searchable: false}
            ],
            "order": [
                [0, "asc"]
            ],
            //"oLanguage": {"sUrl": config.url + '/datatable-lang-' + "ar" + '.json'}

        });
    });
</script>