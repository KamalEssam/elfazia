
function deleteRecord(modelName,datatable) {
    var ids = [];
    $("input[name='ids[]']:checked:enabled").each(function() {
        ids.push($(this).val());
    });
    $.get(appUrl+"/"+modelName+"/delete/records",{ids:ids}, function (data) {
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