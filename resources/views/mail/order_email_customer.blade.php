<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
    xmlns:o="urn:schemas-microsoft-com:office:office">

    <head>
        <meta charset="utf-8"> <!-- utf-8 works for most cases -->
        <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldn't be necessary -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Use the latest (edge) version of IE rendering engine -->
        <meta name="x-apple-disable-message-reformatting"> <!-- Disable auto-scale in iOS 10 Mail entirely -->
        <title>Thư xác nhận đặt hàng thành công</title>
        <!-- The title tag shows in email notifications, like Android 4.4. -->

        <link href="https://fonts.googleapis.com/css?family=Work+Sans:200,300,400,500,600,700" rel="stylesheet">

        <!-- CSS Reset : BEGIN -->
        <style>
            /* What it does: Remove spaces around the email design added by some email clients. */
            /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
            html,
            body {
                margin: 0 auto !important;
                padding: 0 !important;
                height: 100% !important;
                width: 100% !important;
                background: #f8f6f4;
            }

            /* What it does: Stops email clients resizing small text. */
            * {
                text-size-adjust: 100%;
                -ms-text-size-adjust: 100%;
                -webkit-text-size-adjust: 100%;
            }

            /* What it does: Centers email on Android 4.4 */
            div[style*="margin: 16px 0"] {
                margin: 0 !important;
            }

            /* What it does: Stops Outlook from adding extra spacing to tables. */
            table,
            td {
                mso-table-lspace: 0pt !important;
                mso-table-rspace: 0pt !important;
            }

            /* What it does: Fixes webkit padding issue. */
            table {
                border-spacing: 0 !important;
                border-collapse: collapse !important;
                table-layout: fixed !important;
                margin: 0 auto !important;
            }

            /* What it does: Uses a better rendering method when resizing images in IE. */
            img {
                -ms-interpolation-mode: bicubic;
            }

            /* What it does: Prevents Windows 10 Mail from underlining links despite inline CSS. Styles for underlined links should be inline. */
            a {
                text-decoration: none;
            }

            /* What it does: A work-around for email clients meddling in triggered links. */
            *[x-apple-data-detectors],
            /* iOS */
            .unstyle-auto-detected-links *,
            .aBn {
                border-bottom: 0 !important;
                cursor: default !important;
                color: inherit !important;
                text-decoration: none !important;
                font-size: inherit !important;
                font-family: inherit !important;
                font-weight: inherit !important;
                line-height: inherit !important;
            }

            /* What it does: Prevents Gmail from displaying a download button on large, non-linked images. */
            .a6S {
                display: none !important;
                opacity: 0.01 !important;
            }

            /* What it does: Prevents Gmail from changing the text color in conversation threads. */
            .im {
                color: inherit !important;
            }

            /* If the above doesn't work, add a .g-img class to any image in question. */
            img.g-img+div {
                display: none !important;
            }

            /* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89  */
            /* Create one of these media queries for each additional viewport size you'd like to fix */

            /* iPhone 4, 4S, 5, 5S, 5C, and 5SE */
            @media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
                u~div .email-container {
                    min-width: 320px !important;
                }
            }

            /* iPhone 6, 6S, 7, 8, and X */
            @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
                u~div .email-container {
                    min-width: 375px !important;
                }
            }

            /* iPhone 6+, 7+, and 8+ */
            @media only screen and (min-device-width: 414px) {
                u~div .email-container {
                    min-width: 414px !important;
                }
            }
        </style>

        <!-- CSS Reset : END -->

        <!-- Progressive Enhancements : BEGIN -->
        <style>
            .primary {
                background: #daa14c;
            }

            .bg_white {
                background: #ffffff;
            }

            .bg_light {
                background: #f7fafa;
            }

            .bg_black {
                background: #000000;
            }

            .bg_dark {
                background: rgba(0, 0, 0, .8);
            }

            .email-section {
                padding: 2.5em;
            }

            /*BUTTON*/
            .btn {
                padding: 10px 15px;
                display: inline-block;
            }

            .btn.btn-primary {
                border-radius: 5px;
                background: #daa14c;
                color: #ffffff;
            }

            .btn.btn-white {
                border-radius: 5px;
                background: #ffffff;
                color: #000000;
            }

            .btn.btn-white-outline {
                border-radius: 5px;
                background: transparent;
                border: 1px solid #fff;
                color: #fff;
            }

            .btn.btn-black-outline {
                border-radius: 0px;
                background: transparent;
                border: 2px solid #000;
                color: #000;
                font-weight: 700;
            }

            .btn-custom {
                color: rgba(0, 0, 0, .3);
                text-decoration: underline;
            }

            h1,
            h2,
            h3,
            h4,
            h5,
            h6 {
                font-family: 'Work Sans', sans-serif;
                color: #000000;
                margin-top: 0;
                font-weight: 400;
            }

            body {
                font-family: 'Work Sans', sans-serif;
                font-weight: 400;
                font-size: 15px;
                line-height: 1.8;
                color: rgba(0, 0, 0, .4);
            }

            a {
                color: #daa14c;
            }

            table {}

            /*LOGO*/

            .logo h1 {
                margin: 0;
            }

            .logo h1 a {
                color: #daa14c;
                font-size: 24px;
                font-weight: 700;
                font-family: 'Work Sans', sans-serif;
            }

            /*HERO*/
            .hero {
                position: relative;
                z-index: 0;
            }

            .hero .text {
                color: rgba(0, 0, 0, .3);
            }

            .hero .text h2 {
                color: #000;
                font-size: 34px;
                margin-bottom: 15px;
                font-weight: 300;
                line-height: 1.2;
            }

            .hero .text h3 {
                font-size: 24px;
                font-weight: 200;
            }

            .hero .text h2 span {
                font-weight: 600;
                color: #000;
            }


            /*PRODUCT*/
            .product-entry {
                display: flex;
                align-items: center;
                gap: 10px;
                position: relative;
                float: left;
                padding-top: 20px;
            }

            .product-entry .text {
                width: calc(100% - 125px);
                padding-left: 20px;
            }

            .product-entry .text h3 {
                margin-bottom: 0;
                padding-bottom: 0;
            }

            .product-entry .text p {
                margin-top: 0;
            }

            .product-entry img,
            .product-entry .text {
                float: left;
            }

            ul.social {
                padding: 0;
            }

            ul.social li {
                display: inline-block;
                margin-right: 10px;
            }

            /*FOOTER*/

            .footer {
                border-top: 1px solid rgba(0, 0, 0, .05);
                color: rgba(0, 0, 0, .5);
            }

            .footer .heading {
                color: #000;
                font-size: 20px;
            }

            .footer ul {
                margin: 0;
                padding: 0;
            }

            .footer ul li {
                list-style: none;
                margin-bottom: 10px;
            }

            .footer ul li a {
                color: rgba(0, 0, 0, 1);
            }


            @media screen and (max-width: 500px) {}
        </style>


    </head>

    <body style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #f8f6f4;">
        <center style="width: 100%; background-color: #f8f6f4;">
            <div style="max-width: 600px; margin: 0 auto;padding: 100px 0;" class="email-container">
                <!-- Logo and Header -->
                <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%"
                    style="margin: auto;">
                    <tr>
                        <td valign="top" class="bg_white" style="padding: 1em 2.5em 0 2.5em;">
                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td class="logo" style="text-align: left;">
                                        <h1><a href="#">Jewelry Store</a></h1>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- Hero Section -->
                    <tr>
                        <td valign="middle" class="hero bg_white" style="padding: 2em 0;">
                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td style="padding: 0 2.5em; text-align: left;">
                                        <div class="text">
                                            <h2>{{ $order->user->name }} has placed an order</h2>
                                            <h3>Order Details</h3>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- Order Items -->
                    <tr>
                        <td valign="top" class="bg_white" style="padding: 0 2.5em;">
                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr
                                    style="border-bottom: 1px solid rgba(0,0,0,.05);border-top: 1px solid rgba(0,0,0,.05); padding:1em 0">
                                    <th width="60%"
                                        style="text-align:center; padding: 0 2.5em; color: #000; font-size: 20px">Item
                                    </th>
                                    <th width="40%"
                                        style="text-align:center; padding: 0 2.5em; color: #000;font-size: 20px">
                                        Quantity
                                    </th>
                                    <th width="20%"
                                        style="text-align:center; padding: 0 2.5em; color: #000;font-size: 20px">Price
                                    </th>
                                </tr>
                                @php $totalPrice = 0; @endphp
                                @foreach ($order->orderItems as $item)
                                    @php $totalPrice += $item->price * $item->quantity; @endphp
                                    <tr style="border-bottom: 1px solid rgba(0,0,0,.05);">
                                        <td valign="middle" style="text-align:left; padding: 1em 2.5em;">
                                            <div class="product-entry">
                                                <h3 style="color:#000000;font-size: 15px">{{ $item->name }}</h3>
                                            </div>
                                        </td>
                                        <td valign="middle" style="text-align:center; padding: 1em 2.5em;">
                                            <span style="color: #000;font-size: 15px">{{ $item->quantity }}</span>
                                        </td>
                                        <td valign="middle" style="text-align:center; padding: 1em 2.5em;">
                                            <span
                                                style="color: #000;font-size: 15px">${{ number_format($item->price * $item->quantity, 2, '.', ',') }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                                <!-- Total Price -->
                                <tr>
                                    <td colspan="12" valign="middle" style="text-align:right; padding: 1em 2em;">
                                        <p style="color: #000; font-size:20px">Total:
                                            ${{ number_format($totalPrice, 2, '.', ',') }}
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- End BODY -->
                </table>
            </div>
        </center>
    </body>

</html>
