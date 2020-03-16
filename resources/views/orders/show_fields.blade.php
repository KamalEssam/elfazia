

@php /** @var $order \App\Models\Order */ @endphp

<div id="printableArea" class="printable">

<div class="col-md-12">
    <img  src="{!! url("public/uploads/logo.png")!!}"  class=" col-md-offset-5" >
</div>

<div class="col-md-12">
    <h2 class="col-md-offset-5" style="color: #3b5998">{{$order->uniqueID}}</h2>
</div>


<div>
    <h4 class="text-right" style="color: #3b5998"> المرسل</h4>
</div>
<table id="table-data" class="display nowrap dataTable table-hover" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>#</th>
        <th>اسم الشارع</th>
        <th>رقم المبني</th>
        <th>من المنطقة</th>
        <th>العنوان بالكامل</th>
    </tr>
    </thead>

    <tbody>
    <tr class="">
        <td>{{$order->uniqueID}}</td>
        <td>{{$order->from_street}}</td>
        <td>{{$order->from_building}}</td>
        <td>{{$order->fromCity->name_ar}}</td>
        <td>{!! \Helper\Common\__address($order->from_lat,$order->from_lng) !!}</td>
    </tr>
    </tbody>
</table>



<div>
    <h4 class="text-right" style="color: #3b5998"> المرسل اليه</h4>
</div>
<table id="table-data" class="display nowrap dataTable table-hover" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>#</th>
        <th>اسم المرسل اليه</th>
        <th>اسم الشارع</th>
        <th>رقم المبني</th>
        <th> المنطقة</th>
        <th>العنوان بالكامل</th>
    </tr>
    </thead>

    <tbody>
    <tr class="">
        <td>{{$order->uniqueID}}</td>
        <td> @if($order->toClient != null)
                <p>{!! $order->toClient->name !!}</p>
            @endif</td>
        <td>{{$order->to_street}}</td>
        <td>{{$order->to_building}}</td>
        <td>{{$order->toCity->name_ar}}</td>
        <td>{!! \Helper\Common\__address($order->to_lat,$order->to_lng) !!}</td>
    </tr>
    </tbody>
</table>



<div>
    <h4 class="text-right" style="color: #3b5998"> المندوب</h4>
</div>
<table id="table-data" class="display nowrap dataTable table-hover" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>#</th>
        <th>اسم المندوب</th>
        <th>رقم هاتف المندوب</th>
    </tr>
    </thead>

    <tbody>
    <tr class="">
        <td>{{$order->uniqueID}}</td>
        <td> @if($order->delivery != null)
                <p>{!! $order->delivery->name !!}</p>
            @endif</td>
        <td> @if($order->delivery != null)
                <p>{!! $order->delivery->mobile !!}</p>
            @endif</td>

    </tr>
    </tbody>
</table>


<div>
    <h4 class="text-right" style="color: #3b5998"> الشحنة</h4>
</div>
<table id="table-data" class="display nowrap dataTable table-hover" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>#</th>
        <th>نوع الشحنة</th>
        <th>حالة الشحنة</th>
        <th>العدد</th>
        <th>الوزن</th>
        <th>السعر</th>
        <th>تاريخ التوصيل</th>
    </tr>
    </thead>

    <tbody>
    <tr class="">
        <td>{{$order->uniqueID}}</td>
        <td> {!! \App\Models\Order::$shippmentTypeText[$order->shippment_type] !!}</td>
        <td>{!! \Helper\Common\__lang(\App\Models\Order::$statusesText[$order->status]) !!}</td>
        <td>{{$order->number_of_piece}}</td>
        <td>{{$order->number_of_kilo}}</td>
        <td>{{$order->price}}</td>
        <td>{{$order->estimate_delivery_date}}</td>
    </tr>
    </tbody>
</table>
</div>

<a href="{!! route('orders.index') !!}" class="btn btn-default">رجوع</a>
<a href="#" id="btnPrint" class="btn btn-info" onclick="">طباعة</a>

<script>
    $(document).on("click", "#btnPrint", function(e) {
        e.preventDefault();
        e.stopPropagation();
        $("#printableArea").printThis({
            debug: false, // show the iframe for debugging
            importCSS: true, // import page CSS
            importStyle: true, // import style tags
            printContainer: true, // grab outer container as well as the contents of the selector
            loadCSS: "/Content/bootstrap.min.css", // path to additional css file - us an array [] for multiple
            pageTitle: "", // add title to print page
            removeInline: false, // remove all inline styles from print elements
            printDelay: 333, // variable print delay; depending on complexity a higher value may be necessary
            header: null, // prefix to html
            formValues: true // preserve input/form values
        });

    });

    function PrintElem(elem)
    {
        var mywindow = window.open('', 'PRINT', 'height=400,width=600');
        var url = "";
        mywindow.document.write('<html><head> <link href='+url+'> <title>' + document.title  + '</title>');
        mywindow.document.write('</head><body >');
        mywindow.document.write('<h1>' + document.title  + '</h1>');
        mywindow.document.write(document.getElementById(elem).innerHTML);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10*/

        mywindow.print();
        mywindow.close();

        return true;
    }

</script>

