<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600,700" rel="stylesheet">
    <title>Contact Us</title>
    <style>
        .inline-table-boarder {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body style="font-family:Arial, sans-serif;margin:0; padding-top: 0; padding-bottom: 0; padding-top: 0; padding-bottom: 0;background-color: #f0f0f0; background-repeat: repeat; width: 100% !important; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased;">
    <table width="600" cellpadding="0" cellspacing="0" border="0" align="center">
        <tr>
            <td style="padding-top: 50px;">
                <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td>
                            <table width="100%" bgcolor="#181b2a" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="100%" style="padding-top: 20px;padding-bottom: 20px;">
                                        <table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td>
                                                    <a href="javascript:;" target="_blank" style="text-decoration:none;display: block;">
                                                        <h1 style="color: white; text-align:center;">{{ env('APP_NAME') }}</h1>
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            <table width="100%" bgcolor="#ffffff" align="center" border="0" cellpadding="0" cellspacing="0" style="padding-left: 25px;padding-right: 25px;border-collapse: initial;">
                                <tr>
                                    <td align="center" style="padding-top: 40px;padding-bottom: 40px;">
                                        <div style="display: block">
                                            <h1 style="font-family: 'Work Sans';font-size:22px;font-weight: 700; color: #000000;margin:0;">Contact Us</h1>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td>
                                                    <div style="display: block">
                                                        <p style="font-family: 'Work Sans';font-size:14px;font-weight: 400;line-height: 20px;color: #292929;margin:0;margin-bottom: 10px;"> Dear <strong>Admin,</strong></p>
                                                        <table style="width:100%" class="inline-table-boarder">
                                                            <tr>
                                                                <th class="inline-table-boarder">Name</th>
                                                                <td class="inline-table-boarder">{{ $mailData['name'] }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th class="inline-table-boarder">Email</th>
                                                                <td class="inline-table-boarder">{{ $mailData['email'] }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th class="inline-table-boarder">Department</th>
                                                                <td class="inline-table-boarder">{{ $mailData['department'] }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th class="inline-table-boarder">Subject</th>
                                                                <td class="inline-table-boarder">{{ $mailData['subject'] }}</td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="100%" style="padding-bottom: 40px;">
                                        <div>
                                            <h3 style="font-family: 'Work Sans';font-size:14px;font-weight:600;line-height: 20px;color: #292929;margin:0;">Regards</h3>
                                            <h3 style="font-family: 'Work Sans';font-size:14px;font-weight:600;line-height: 20px;color: #292929;margin:0;"><strong> {{ $mailData['name'] }}</strong></h3>
                                        </div>
                                    </td>
                                </tr>

                            </table>

                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>