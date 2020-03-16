
<table id="table-data" class="table table-hover dataTable ">
        <thead class="thead-dark">
    <tr>
        <th>#</th>
        <th>Question Id</th>
        <th>Student Id</th>
        <th>Option Id</th>
        <th>Answer</th>
        <th>Test Id</th>
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
                "url": "{{route('questionAnswers.ajax')}}",
                "type": "GET",
            },
            "columns": [
                {"data": "id"},
               {"data": "question_id"},
               {"data": "student_id"},
               {"data": "option_id"},
               {"data": "answer"},
               {"data": "test_id"},

                {"data": "options", orderable: false, searchable: false}
            ],
            "order": [
                [0, "asc"]
            ],
            //"oLanguage": {"sUrl": config.url + '/datatable-lang-' + "ar" + '.json'}

        });
    });
</script>