<td class="email-body" width="100%" cellpadding="0" cellspacing="0">
    <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0">
        <!-- Body content -->
        <tr>
            <td class="content-cell">
                <h1 style="text-align: center;font-size: 22px;font-weight: bold;color:#3d8b40"><strong>{{$object->username}}</strong> مرحبا بك </h1>
                <h1 style="text-align: center">رد الأدارة عليك</h1>

                <!-- Action -->
                <table class="body-action" align="center" width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td >
                            <!-- Border based button
                       https://litmus.com/blog/a-guide-to-bulletproof-buttons-in-email-design -->
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td align="center" style="font-weight: bold;font-size:17px;color:#3d8b40">
                                    {{$object->subject}}
                                    </td>
                                </tr>

                                <tr>
                                    <td align="center" style="font-weight: bold;font-size:20px;color:#3d8b40">
                                    {{$object->body}}
                                    </td>
                                </tr>

                            </table>
                        </td>

                    </tr>


                </table>
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
