
<table id="table-data" class="display nowrap dataTable" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>#</th>
        <th>الأسم</th>
        <th>البريد الالكتروني</th>
        <th>رقم الجوال</th>
        <th>المحفظة</th>
        <th>التفعيل</th>
        <th>اعادة تهيئة</th>
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
                "url": "{{url("admin/users")}}" + "/data/table",
                "type": "GET",
            },
            "columns": [
                {"data": "id","name":"users.id"},
                {"data": "name"},
                {"data": "email"},
                {"data": "mobile"},
                {"data": "wallet"},
                {"data": "active"},
                {"data": "reset_wallet"},
                {"data": "orders",searchable:false,orderable:false},
                {"data": "options",searchable:false,orderable:false},
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
        $.get('{{url("admin/users/active")}}'+"/"+record_id, function (data) {
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
    function resetWallet(e) {
        var record_id = $(e).data("id");
        $.get('{{url("admin/users/reset/wallet")}}'+"/"+record_id, function (data) {
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