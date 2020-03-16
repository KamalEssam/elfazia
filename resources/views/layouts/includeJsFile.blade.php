

<script src="{{url("public/admin")}}/plugins/bower_components/bootstrap-rtl-master/dist/js/bootstrap-rtl.min.js"></script>



{{--<script src="{{url("public/admin")}}/assets/js/vendor/datatables.min.js"></script>--}}
{{--<script src="{{url("public/admin")}}/assets/js/datatables.script.js"></script>--}}


<script src="{{url("public/admin")}}/assets/js/es5/echart.options.min.js"></script>
<script src="{{url("public/admin")}}/assets/js/es5/dashboard.v1.script.js"></script>
<script src="{{url("public/admin")}}/assets/js/script.js"></script>
<script src="{{url("public/admin")}}/assets/js/sidebar.large.script.js"></script>
<script src="{{url("public/admin")}}/assets/js/customizer.script.js"></script>
{{--<script src="{{url("public/admin")}}/assets/js/form.basic.script.js"></script>--}}

@include("layouts.dataTable.libs")
<!-- Sparkline chart JavaScript -->
{{--<script src="{{url("public/admin")}}/plugins/bower_components/toast-master/js/jquery.toast.js"></script>--}}

@include("layouts.multiSelect.libsJS")
@include("layouts.makeToast")
{{--@include("layouts.emoji.emojiJS")--}}

{{--@include("layouts.dateTime.createFields")--}}


{{--@include("layouts.map.mapJs")--}}

@yield('scripts')

<script type="text/javascript" src="{{url("public/admin")}}/controls/deleteControl.js"></script>




<script type="text/javascript">
    $(document).ready(function() {
        if(jsPDF && jsPDF.version) {
            $('#dversion').text('Version ' + jsPDF.version);
        }
    });
</script>

<!-- Code editor -->

<script src="{{url("public/admin/assets/pdf")}}/ace.js" type="text/javascript" charset="utf-8"></script>

<script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
<!-- Scripts in development mode -->
<script type="text/javascript" src="{{url("public/admin/assets/pdf")}}/jspdf.debug.js"></script>
<script type="text/javascript" src="{{url("public/admin/assets/pdf")}}/pdfobject.min.js"></script>
<script type="text/javascript" src="{{url("public/admin/assets/pdf")}}/editor.js"></script>
<script type="text/javascript" src="{{url("public/admin/assets/pdf")}}/arabic.js"></script>

