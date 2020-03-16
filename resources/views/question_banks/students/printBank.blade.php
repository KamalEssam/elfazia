
@extends('layouts.app')

@section('content')

    <div class="main-content-wrap sidenav-open d-flex flex-column">
        <div class="main-content">
            <div class="breadcrumb">
                <h1>Question Banks</h1>

            </div>

            <div class="separator-breadcrumb border-top"></div>


<div class="row">
    <div class="col-md-1"></div>

            <div class="card mb-5 col-md-10">
                   <div class="card-body" id="card-body">
                       @include('flash::message')

                       <div class="d-flex flex-column">
                       @include('adminlte-templates::common.errors')

                           @php $showBtns = false;
                                $counter = 0;
                           @endphp
                           @foreach($questionsArray as $questions)
                               @if($counter+1 == count($questionsArray))
                                   @php $showBtns = true; @endphp
                                   @endif
                       @include('question_banks.students.fieldsPrint')
                                   @php $counter++; @endphp
                               @endforeach

                           <input type="button" value="print" onclick="downloadPDF();" />

                       </div>
                  </div>

            </div>
        </div>


        </div>

    <!-- ============ Body content End ============= -->
        <script src="https://docraptor.com/docraptor-1.0.0.js"></script>
        <script>
            var downloadPDF = function() {
                DocRaptor.createAndDownloadDoc("YOUR_API_KEY_HERE", {
                    test: true, // test documents are free, but watermarked
                    type: "pdf",
                    document_content: document.getElementById('form-body').innerHTML, // use this page's HTML
                    // document_content: "<h1>Hello world!</h1>",               // or supply HTML directly
                    // document_url: "http://example.com/your-page",            // or use a URL
                    // javascript: true,                                        // enable JavaScript processing
                    // prince_options: {
                    //   media: "screen",                                       // use screen styles instead of print styles
                    // }
                })
            }
        </script>
        {{--<script type="text/javascript">--}}
            {{--function pdf() {--}}
                {{--var doc = new jsPDF();--}}
                {{--var elementHTML = $('#form-body').html();--}}
                {{--var specialElementHandlers = {--}}
                    {{--'#elementH': function (element, renderer) {--}}
                        {{--return true;--}}
                    {{--}--}}
                {{--};--}}
                {{--doc.fromHTML(elementHTML, 15, 15, {--}}
                    {{--'width': 170,--}}
                    {{--'elementHandlers': specialElementHandlers--}}
                {{--});--}}

{{--// Save the PDF--}}
                {{--doc.save('sample-document.pdf');--}}

                {{--// var pdf = new jsPDF('p', 'pt', 'a4');--}}
                {{--// pdf.fromHTML(document.getElementById('card-body'),function(dispose) {--}}
                {{--//         headerFooterFormatting(pdf)--}}
                {{--//     });--}}
                {{--//--}}
                {{--// var iframe = document.createElement('iframe');--}}
                {{--// iframe.setAttribute('style','position:absolute;right:0; top:0; bottom:0; height:100%; width:650px; padding:20px;');--}}
                {{--// document.body.appendChild(iframe);--}}
                {{--//--}}
                {{--// iframe.src = pdf.output('datauristring');--}}
                {{--// pdf.save('Test.pdf');--}}

            {{--}--}}
            {{--function PrintDiv() {--}}
                {{--var pdf = new jsPDF('p', 'pt', 'letter');--}}
                {{--pdf.html(document.body, {--}}
                    {{--callback: function (pdf) {--}}
                        {{--var iframe = document.createElement('iframe');--}}
                        {{--iframe.setAttribute('style', 'position:absolute;right:0; top:0; bottom:0; height:100%; width:500px');--}}
                        {{--document.body.appendChild(iframe);--}}
                        {{--iframe.src = pdf.output('datauristring');--}}
                        {{--pdf.save('Test.pdf');--}}
                    {{--}--}}
                {{--});--}}

                {{--// var doc = new jsPDF();--}}
                {{--// var options = {--}}
                {{--//     background: '#fff' //background is transparent if you don't set it, which turns it black for some reason.--}}
                {{--// };--}}
                {{--// doc.addHTML($('#card-body')[0], options, function () {--}}
                {{--//     doc.save('Test.pdf');--}}
                {{--// });--}}
                {{--// // Save the PDF--}}

                {{--var css = '{{url("public/admin")}}';--}}
                {{--// var divToPrint = document.getElementById('card-body');--}}
                {{--// var popupWin = window.open('', '_blank', 'width=300,height=300');--}}
                {{--// popupWin.document.open();--}}
                {{--// popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');--}}
                {{--// popupWin.document.close();--}}
                {{--//--}}
                {{--var data = document.getElementById('form-body').innerHTML;--}}
                {{--var mywindow = window.open('', 'new div', 'height=400,width=600');--}}
                {{--mywindow.document.open();--}}
                {{--mywindow.document.write('<html><head><title></title>');--}}
                {{--mywindow.document.write('<link rel="stylesheet" href='+css+'"/assets/styles/css/themes/lite-purple.min.css" type="text/css" />');--}}
                {{--mywindow.document.write('<style>h1{font-size:20px;color:#76C04E;width:90%;}</style>');--}}
                {{--mywindow.document.write('<style>body{background: #FFFFFF; color: #000000; font: 85% arial, verdana, helvetica, sans-serif; }</style>');--}}

                {{--mywindow.document.write('<style>.res td{font-size: 12px;font-family: open sans, arial; border-top: 1px solid #ddd; width: auto;padding: 4px;} </style>');--}}
                {{--mywindow.document.write('</head><body onload="window.print()">');--}}
                {{--mywindow.document.write(data);--}}
                {{--mywindow.document.write('</body></html>');--}}
                {{--mywindow.document.close();--}}

            {{--}--}}

        {{--</script>--}}



@endsection


