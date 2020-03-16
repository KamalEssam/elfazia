@php /** @var \App\Models\OfferRequest $object */ @endphp
<td class="email-body" width="100%" cellpadding="0" cellspacing="0">
    <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0">
        <!-- Body content -->
        <tr>
            <td class="content-cell">
                <h1 style="text-align: center;font-size: 22px;font-weight: bold;color:#3d8b40"><strong>{{$object->username}}</strong> مرحبا بك </h1>
                <h1 style="text-align: center">لقد طلبت استعادة كلمة السر</h1>
                <p class="align-center">
                    <a href="" class="button button--green align-center" target="_blank">{{$object->remember_token}}</a>
                </p>

                <p>Thanks,
                    <br>The {{config("app.name")}} Team</p>
                <!-- Sub copy -->
                <table class="body-action">
                    <tr style="text-align: center;">
                        <td align="center" style="text-align: center;">
                            <a href="{{url("")}}" style="text-align: center;">
                                <img src="{{url("public/uploads/logo.png")}}" style="width: 100px;height: 100px;">
                            </a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</td>
