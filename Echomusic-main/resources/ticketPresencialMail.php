<?php
$ticketPremail = "<html><head>
    <title>Verificacion EchoMusic</title>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge' />
    <style type='text/css'>

        /* CLIENT-SPECIFIC STYLES */
        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            -ms-interpolation-mode: bicubic;
        }

        /* RESET STYLES */
        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }

        table {
            border-collapse: collapse !important;
        }

        body {
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
        }

        /* iOS BLUE LINKS */
        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* MOBILE STYLES */
        @media screen and (max-width:600px) {
            h1 {
                font-size: 32px !important;
                line-height: 32px !important;
            }
        }

        /* ANDROID CENTER FIX */
        div[style*='margin: 16px 0;'] {
            margin: 0 !important;
        }
    </style>
</head>

<body style='background-color: #fff; margin: 0 !important; padding: 0 !important;'>
    <!-- HIDDEN PREHEADER TEXT -->
    <div style='display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: 'Lato', Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;'> </div>
<table border='0' cellpadding='0' cellspacing='0' width='100%'>
    <tr>
        <td style='width:50%;'>

    <table border='0' cellpadding='0' cellspacing='0' width='100%'>
        <tr>
            <td  align='center'>
                <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                    <tr>
                        <td align='left' valign='top' style='padding: 40px 10px 40px 10px;'>
                            <img src='https://qa.echomusic.cl/constru/LOGO-ECHO.png' alt='Echomusic' height='150' style='width:60%;'>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td  align='center' style='padding: 0px 10px 0px 10px;'>
                <table border='0' cellpadding='0' cellspacing='0' width='100%' >
                    <tr>
                        <td bgcolor='#ffffff' align='left' valign='top' style='padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;'>
                        RUT: 77.287.293-3<br>
                        Razón Social: EchoMusic SpA.<br>
                        Canadá 253, Providencia, RM.<br>
                        <b>Boleta Electrónica número: </b>";

$ticketPremail2=",</b><br>
                su orden de compra ha finalizado con éxito. Se adjunta su entrada.<br><br>
                <b style='color:#ff6600;'>Resumen de la compra</b><br>
                            <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                                <tr>
                                    <td>";
/*table resumen*/
$ticketPremail3="                   </td>
                                </tr>
                            </table>
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

</html>";

?>
