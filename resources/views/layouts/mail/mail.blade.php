<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="text/html; charset=UTF-8" http-equiv="content-type">

        <title>RAMS</title>

        <style type="text/css">
            body.makluman { margin:0; padding:0; }
            p.makluman2 { text-align: left; }
            table.makluman3 { border: 1px solid #ccc; border-collapse: collapse; }
            td.makluman4 { background-color: #d1d1d1; font-weight: bold; padding-left: 20px; }
            td.makluman5a { padding-left: 20px; }
            td.makluman5b { background-color: #f1f1f1; padding-left: 20px; }
        </style>
    </head>
    <body class="makluman">
        <table cellspacing="0" cellpadding="10" style="color:#666;font:13px Arial;line-height:1.4em;width:100%;">
            <tbody>
                <tr>
                    <td style="color:#ff9c00;font-size:22px;border-bottom: 2px solid #ff9c00;">RAMS</td>
                </tr>
                <tr>
                    <td style="color:#777;font-size:16px;padding-top:5px;"><?php if(isset($data['description'])){ echo $data['description']; } ?></td>
                </tr>
                <tr>
                    <td>@yield('content')</td>
                </tr>
                <tr>
                    <td style="padding:15px 20px;text-align:right;padding-top:5px;border-top:solid 1px #dfdfdf"></td>
                </tr>
            </tbody>
        </table>
    </body>
</html>