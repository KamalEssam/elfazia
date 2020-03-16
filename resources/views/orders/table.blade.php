
<table id="table-data" class="display nowrap dataTable" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>#</th>
        <th>المرسل</th>
        <th>المرسل اليه</th>
        <th>نوع الشحنة</th>
        <th>حالة الشحنة</th>
        <th>يوجد استرجاع مبلغ</th>
        <th>قيمة المبلغ</th>
        <th>المندوب</th>
        <th>عدد القطع</th>
        <th>الوزن</th>
        <th>السعر</th>
        <th>تاريخ التوصيل المطلوب</th>
        <th>تاريخ التوصيل المتوقع</th>
        <th>الرسائل</th>
        <th>العمليات</th>
    </tr>
    </thead>

       <tbody>

        </tbody>
</table>



<!-- The Modal -->
<div class="modal fade" id="myModal1">
    <div class="modal-dialog">
        <div class="modal-content" style="margin-top:50%;">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">الرسائل</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">

                    <div class="col-lg-12 col-md-12">
                        <div class="white-box">
                            <h3 class="box-title"></h3>
                            <ul class="chat-list slimscroll"  style="overflow: hidden;" tabindex="5005" id="chatRoom1">

                            </ul>
                            {{--<div class="row">--}}
                                {{--<div class="col-sm-12">--}}
                                    {{--@include("chat_rooms.fields")--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        </div>
                    </div>

                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="singleClose">Close</button>
            </div>

        </div>
    </div>
</div>

<script>
    var loading = false;

    $( document ).ready(function() {
        var user_id = 0 ;
        @if(isset($user_id)) user_id = {{$user_id}}; @endif
        var delivery_id = 0 ;
        @if(isset($delivery_id)) delivery_id = {{$delivery_id}}; @endif
            datatable = $('.dataTable').dataTable({
            //"processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{route('orders.ajax')}}?user_id="+user_id+"&delivery_id="+delivery_id,
                "type": "GET",
            },
            "columns": [
                {"data": "id"},
                {"data": "from_client"},
                {"data": "to_client"},
                {"data": "shippment_type"},
                {"data": "status"},
                {"data": "cash_collected"},
                {"data": "cash_collected_amount"},
                {"data": "delivery"},
                {"data": "number_of_piece"},
                {"data": "number_of_kilo"},
                {"data": "price"},
                {"data": "delivery_date"},
                {"data": "estimate_delivery_date"},
                {"data": "messages"},

                {"data": "options", orderable: false, searchable: false}
            ],
            "order": [
                [0, "desc"]
            ],
            //"oLanguage": {"sUrl": config.url + '/datatable-lang-' + "ar" + '.json'}

        });
    });

    $(document).on('change','.status_id', function (e) {
        delivery_id = this.value;
        id = $(this).data("id");

        $.get('{{url("admin/orders/setDelivery/")}}/'+id+"/"+delivery_id, function (data) {

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




    });


    $(document).on('click','#chatRoom', function (e) {
        $(".chat-list").html("");
        roomId  = $(this).data("id");
        reloadRoom(roomId);

    });

    function reloadRoom(roomId) {
        $.get('{{url("admin/chatRooms/ajax/room")}}/'+roomId, function (data) {
            console.log(data);
            if (data.length !== 0)
            {
                $(".chat-list").html("");
                $.each(data, function (index, obj) {
                    console.log(obj);
                    if(index % 3 === 0 ){
                        $(".chat-list").append('<li class="odd">'
                            +
                            '<div class="chat-image"> <img  src="'+obj.from_user.image+'"> </div>\n' +
                            '                                        <div class="chat-body">\n' +
                            '                                            <div class="chat-text">\n' +
                            '                                                <p> '+obj.message+' </p> <b>'+obj.created_at+'</b> </div>\n' +
                            '                                        </div>' +


                            '</li>');
                    }else{
                        $(".chat-list").append('<li>'
                            +
                            '<div class="chat-image"> <img  src="'+obj.to_user.image+'"> </div>\n' +
                            '                                        <div class="chat-body">\n' +
                            '                                            <div class="chat-text">\n' +
                            '                                                <p> '+obj.message+' </p> <b>'+obj.created_at+'</b> </div>\n' +
                            '                                        </div>' +


                            '</li>');
                    }






                });

                $(".chat-list").scrollTop($(".chat-list")[0].scrollHeight);
            }

            else {
            }

        });
    }

    $(document).on('click','#sendMessage', function (e) {
        if(loading == false){
            loading = true;
            var message = $("#message").val();
            var token = $("input[name=_token]").val();
            $.post('{{url("admin/roomMessages")}}',{message:message,room_id:roomId ,_token:token},  function (data) {

                if (data.length !== 0)
                {
                    loading = false;

                    if(data.success)
                    {
                        obj = data.object;
                        makeToast(data.message,1);
                        $("#message").val("");

                        $(".chat-list").append('<li class="odd">'
                            +
                            '<div class="chat-image"> <img alt="male" src='+obj.userImageFrom+'> </div>\n' +
                            '                                        <div class="chat-body">\n' +
                            '                                            <div class="chat-text">\n' +
                            '                                                <p> '+obj.message+' </p> <b>'+obj.createdAt+'</b> </div>\n' +
                            '                                        </div>' +


                            '</li>');
                        $(".chat-list").scrollTop($(".chat-list")[0].scrollHeight);
                    }
                    else
                    {
                        makeToast(data.message,0);
                    }


                }

            });
        }else{
            makeToast("loading",0);
        }



    });
</script>
