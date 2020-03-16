var stadium_id = 0;

$(document).on('click','#itemAdd', function (e) {
    stadium_id  = $(this).data("id");
});


$( document ).ready(function() {

    $('#region_id').on('change', function (e) {


        var region_id = e.target.value;
        if (region_id > 0) {
            $.get(appUrl + '/districts/ajax/' + region_id, function (data) {

                $('#district_id').empty();


                if (data.length !== 0) {
                    $.each(data, function (index, subCatObj) {

                        $('#district_id').append($('<option>', {
                            value: subCatObj.id,
                            text: subCatObj.title_ar
                        }));

                    });

                }

            });
        }
        else {
            $('#district_id').empty();

            $('#district_id').append($('<option>', {
                value: '',
                text: "اختر",
                selected: true
            }));
        }

    });

    datatable = $('.dataTable').dataTable({
            //"processing": true,
            "serverSide": true,
            "ajax": {
                "url": appUrl+"/stadium" + "/data/1",
            "type": "GET",
        },
        "columns": [
        {"data": "id","name":"stadiums.id"},
        {"data": "member_expire"},
        {"data": "title_ar","name":"stadiums.title_ar"},
        {"data": "location",searchable:false,orderable:false},
        {"data": "address","name":"districts.title_ar"},
        {"data": "username","name":"users.username"},
        {"data": "email","name":"users.email"},
        {"data": "mobile","name":"users.mobile"},
        {"data": "image",searchable:false,orderable:false},
        {"data": "active",searchable:false,orderable:false},
        {"data": "sendNotification",searchable:false,orderable:false},
        {"data": "branches",searchable:false,orderable:false},
        {"data": "ads",searchable:false,orderable:false},
        {"data": "comments",searchable:false,orderable:false},
        {"data": "options", orderable: false, searchable: false}
    ],
        "order": [
        [0, "desc"]
    ],
    //"oLanguage": {"sUrl": config.url + '/datatable-lang-' + "ar" + '.json'}

});

});




$(document).on('click','#submitNotification', function (e) {

    var body = $("#body").val();
    $.get(appUrl+'/notifications/stadiumNotification/store'+"/"+stadium_id+"?body="+body, function (data) {
        if (data.length !== 0)
        {
            if(data.success)
            {
                makeToast(data.message,1);
                $("#body").val("");
                $("#buttonClosed").click();
            }
            else
            {
                makeToast(data.message,0);
            }


        }

    });


});
function changeActive(e) {
    var stadium_id = $(e).data("id");
    $.get(appUrl+'/stadium/active'+"/"+stadium_id+"?type=1", function (data) {
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
