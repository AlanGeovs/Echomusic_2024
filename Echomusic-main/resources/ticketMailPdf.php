<?php
$ticketMail = '
      <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet" type="text/css">

    <style>
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
            padding:0px;
        }
        table{
           width: 600px;
           table-layout: fixed;
           overflow-wrap: break-word;
           text-align: center;
           border-spacing: 0px;
           font-family: "Noto Sans", sans-serif;
            border-collapse: collapse !important;
        }
        .border-gris{
            border: 0.5px solid #c9c9c9;
            border-top-width: 0px;
            border-bottom-width: 0px;
        }
        .border-gris-bottom{
            border: 0.5px solid #c9c9c9;
            border-top-width: 0px;
            border-bottom-width: 0.5px;
        }
        #e-ticket{
            text-align:center;
        }
        #nombreBanda{
            background: #404040;
            border: 0.5px solid #404040;
            color: white;
            font-weight: bold;
            padding: 0.5rem 0;
            font-size: 40px;
        }
        #filaNaranja{
            background: #FF6600;
            border: 0.5px solid #FF6600;
            color:white;
            font-weight: bold;
            padding: 0.25rem 0;
            text-align:center;

        }
        #subFilaNaranja{
            background: #FF6600;
            border: 0.5px solid #FF6600;
            color:white;
            font-weight: bold;
            padding: 0.25rem 0;
            width:200px;
            text-align:left;
        }
        #filaTextoGris{
            color:#424242;
            font-weight: bold;
            padding: 0.25rem 0;
            text-align:center;
        }
        #subFilaGris{
            color:#424242;
            font-weight: bold;
            padding: 0.25rem 0;
            width:200px;
            text-align:left;
        }
        #qr-imgTicket{
            margin: 1rem auto;
        }
        #textOrder{
            color:#424242;
            font-weight: bold;
            padding:1rem 0;
            margin: 1rem 0;
        }
        #textTerminos{
            color:#424242;
            font-size:10px;
            width: 600px;
        }
    </style>
    <table style="width: 600px;margin:0 auto;">
    <tr>
        <td>
            <table style="max-width: 600px;width: 600px;margin-bottom:1rem;" border="0" cellpadding="0" cellspacing="0" >
                <tr>
                    <td id="e-ticket"><img id="" style="width:90px;" src="https://echomusic.cl/images/E-TICKET.png" /></td>
                    <td><img style="vertical-align: top" src="https://echomusic.cl/images/LOGO-TICKET.png" />
                    <BR>';

$ticketMail1 = '    <BR>
                    <p id="textOrder">NÚMERO DE ORDEN:';

$ticketMail2 = '    </p>
                    <BR>
                    </td>
                    <td id="e-ticket"><img id="" style="width:90px;" src="https://echomusic.cl/images/E-TICKET-2.png" /></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td id=" ">
            <table style="max-width: 600px;width: 600px;" border="0" cellpadding="0" cellspacing="0" >
                <tr id="nombreBanda">
                    <td id="nombreBanda">';

$ticketMail3 = '    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td >
            <table style="max-width: 600px;width: 600px;" border="0" cellpadding="0" cellspacing="0" >
                <tr id="filaTextoGris">
                    <td id="filaTextoGris" align="center" class="border-gris">';

$ticketMail4 = '    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td id=" ">
            <table style="max-width: 600px;width: 600px;" border="0" cellpadding="0" cellspacing="0" >
                <tr id="filaNaranja">
                    <td id="subFilaNaranja" align="left" style="padding-left:5px; width: 200px;">
                        CATEGORÍA
                    </td>
                    <td id="subFilaNaranja" align="left"  style="padding-left:5px;width: 200px;">
                      Nº Entrada
                    </td>
                    <td id="subFilaNaranja" align="left" style="padding-left:5px;width: 200px;">

                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td id=" ">
            <table style="max-width: 600px;width: 600px;" class="border-gris-bottom" border="0" cellpadding="0" cellspacing="0" >
                <tr id="filaTextoGris">
                    <td id="subFilaGris" align="left" style="padding-left:5px; width: 200px;">';

$ticketMail4_5 = '  </td>
                    <td id="subFilaGris" align="left" style="padding-left:5px;width: 200px;">';

$ticketMail5 = '    </td>
                    <td id="subFilaGris" align="left" style="padding-left:5px;width: 200px;">';

$ticketMail6 = '    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td id="">
         <br>
        </td>
    </tr>
    <tr id=" ">
        <td id=" ">
            <table style="max-width: 600px;width: 600px;" border="0" cellpadding="0" cellspacing="0" >
                <tr id="filaNaranja">
                    <td id="filaNaranja" align="center">';

$ticketMail7 = '    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td >
            <table style="max-width: 600px;width: 600px;"  class="border-gris" border="0" cellpadding="0" cellspacing="0" >
                <tr id="filaTextoGris">
                    <td id="filaTextoGris" align="center" >';

$ticketMail8 = '    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td >
            <table style="max-width: 600px;width: 600px;" class="border-gris-bottom" border="0" cellpadding="0" cellspacing="0" >
                <tr id="filaTextoGris" class="border-gris-bottom">
                    <td id="filaTextoGris">';
$ticketMail9 = '    </td>
                    <td id="filaTextoGris">';
$ticketMail10 = '    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr width="100%" style="max-width: 600px;">
        <td><br>
        </td>
    </tr>
    <tr>
        <td>
            <table style="max-width: 600px;width: 600px;" border="0" cellpadding="0" cellspacing="0" >
                <tr id="filaNaranja">
                    <td id="filaNaranja">
                        IMPORTANTE
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table style="max-width: 600px;width: 600px;text-align: justify;" border="0" cellpadding="0" cellspacing="0" >
                <tr class="border-gris-bottom">
                    <td id="textTerminos">
Para hacer válido este e- ticket, debes mostrar el código QR en el acceso del evento. Para ello, puedes imprimirlo o mostrarlo directamente de tu teléfono. El Organizador es el único y exclusivo responsable de la producción y organización del Evento, por lo que EchoMusic no asume responsabilidad a este respecto. Es el organizador del evento el responsable de avisar en caso de cancelación del evento. Al adquirir este e-ticket usted acepta ser revisado previo ingreso al recinto del evento, si ello es requerido, esto es para evitar su acceso con bebidas alcohólicas, drogas, armas, grabadoras, cámaras de cualquier tipo o cualquier otro artículo no autorizado, y está consciente que ello puede ser una condición para su ingreso al recinto, por lo que se le podrá impedir o podrá ser desalojado del recinto, en caso de portar cualquiera de los objetos antes indicados o si su conducta es ofensiva o induce al desorden, en cualquiera de estos casos, no tendrá derecho a reembolso de ningún tipo. El propietario de este e-ticket está obligado a cumplir con las normas y exigencias del recinto de presentación

                    </td>
                </tr>
            </table>
        </td>
    </tr>
    </table>
';

?>
