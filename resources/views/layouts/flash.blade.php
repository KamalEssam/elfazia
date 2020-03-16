@if( session("flash") != null)
    <div class="alert alert-success ">
        <button type="button"
                class="close"
                data-dismiss="alert"
                aria-hidden="true"
        >&times;</button>
        {!!  session("flash")!!}

    </div>
    @php request()->session()->forget("flash") @endphp
    @endif
