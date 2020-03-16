
<table id="table-data" class="display nowrap dataTable" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>#</th>
        <th>الأسم</th>
        <th>البريد الالكتروني</th>
        <th>رقم الجوال</th>
        <th>الصورة</th>
        <th>الراتب</th>
        <th> عموله المندوب (جنيه)</th>
        <th>تحصيل المندوب</th>
        <th>التفعيل</th>
        <th>حضور</th>
        <th>انصراف</th>
        <th>الطلبات</th>
        <th>العمليات</th>
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
                "url": "{{url("admin/deliveries")}}" + "/data/table",
                "type": "GET",
            },
            "columns": [
                {"data": "id","name":"users.id"},
                {"data": "name"},
                {"data": "email"},
                {"data": "mobile"},
                {"data": "image"},
                {"data": "delivery_salary"},
                {"data": "delivery_commission"},
                {"data": "delivery_collected"},
                {"data": "active"},
                {"data": "attend"},
                {"data": "attend_out"},
                {"data": "orders"},
                {"data": "options",orderable:false,searchable:false},
                // {"data": "order_numbers"},
                // {"data": "orders", orderable: false, searchable: false}

            ],
            "order": [
                [0, "desc"]
            ],
            //"oLanguage": {"sUrl": config.url + '/datatable-lang-' + "ar" + '.json'}

        });
    });

    function changeActive(e) {
        var record_id = $(e).data("id");
        $.get('{{url("admin/deliveries/active")}}'+"/"+record_id, function (data) {
            if (data.length !== 0)
            {
                if(data.success)
                {
                    makeToast(data.message,1);
                    datatable.api().ajax.reload();

                }
                else
                {
                    makeToast(data.message,0);
                }


            }

        });


    }
    function attend(e) {
        var record_id = $(e).data("id");
        $.get('{{url("admin/deliveries/attend")}}'+"/"+record_id, function (data) {
            if (data.length !== 0)
            {
                if(data.success)
                {
                    makeToast(data.message,1);
                    datatable.api().ajax.reload();

                }
                else
                {
                    makeToast(data.message,0);
                }


            }

        });


    }
    function attendOut(e) {
        var record_id = $(e).data("id");
        $.get('{{url("admin/deliveries/attend/out")}}'+"/"+record_id, function (data) {
            if (data.length !== 0)
            {
                if(data.success)
                {
                    makeToast(data.message,1);
                    datatable.api().ajax.reload();

                }
                else
                {
                    makeToast(data.message,0);
                }


            }

        });


    }
</script>