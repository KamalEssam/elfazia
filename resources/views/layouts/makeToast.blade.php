<script>
    function makeToast(  body , type) {
        if(type === 1)
        {
            type = "success";
        }
        else if(type === 2)
        {
            type = "info";
        }
        else if(type === 0)
        {
            type = "error";
        }
        $(document).ready(function() {
            $.toast({
                heading: body,
                text: "",
                position: 'bottom-left',
                loaderBg: '#ff6849',
                icon: type,
                hideAfter: 3500,
                stack: 6
            })
        });
    }
</script>



@php
    //get toast
    if(request()->session()->get("toast") == null)
    {
        $toast = true;
        request()->session()->put("toast",1);
    }
    else
    {
    $toast = false;
    }
    //

@endphp
@if($toast == true)
    <script type="text/javascript">
        makeToast("welcome Admin",2);
    </script>
@endif

