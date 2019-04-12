<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>zoney,pk</title>
    <link rel="shortcut icon" type="image/ico" href="<?=base_url();?>assets/img/favicon.ico" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lora" rel="stylesheet" />
    <style type="text/css">
        *{-webkit-text-size-adjust:none;-webkit-text-resize:100%;text-resize:100%;}
        table{border-spacing: 0;}
        h1, h2, h3, h4, h5, h6{display:block; Margin:0; padding:0;}
        img, a img{border:0; height:auto; outline:none; text-decoration:none;}
        body, #bodyTable, #bodyCell{height:100%; margin:0; padding:0; width:100%;}
        @-ms-viewport{width:device-width;}
        table{mso-table-lspace:0pt; mso-table-rspace:0pt;}
        p, a, li, td, blockquote{mso-line-height-rule:exactly;}
        p, a, li, td, body, table, blockquote{-ms-text-size-adjust:100%; -webkit-text-size-adjust:100%;}
        #outlook a{padding:0;}
        .ReadMsgBody{width:100%;} .ExternalClass{width:100%;}
        .ExternalClass,.ExternalClass div,.ExternalClass font,.ExternalClass p,.ExternalClass span,.ExternalClass td,img{line-height:100%;}
        [style*="Open Sans"] {font-family: 'Open Sans', Helvetica, Arial, sans-serif !important;}
        [style*="Lora"] {font-family: 'Lora', Georgia, Times, serif !important;}
        .wrapperTable{width:100%; max-width:600px; Margin:0 auto;}
        .oneColumn {text-align:center; font-size:0;}
        .imgHero img{ width:600px; height:auto; }
    </style>
    <style type="text/css">
        @media screen and (min-width: 480px) and (max-width: 640px) {
            td[class="imgHero"] img{ width:100% !important;}
        }
    </style>
    <style type="text/css">
        @media screen and (max-width:480px) {
            table[class="wrapperTable"]{width:100% !important; }
            td[class="title"] h2{font-size:26px !important;line-height:34px !important;}
            td[class="imgHero"] img{ width:100% !important;}
        }
    </style>
</head>
<body style="background-color:#F9F9F9;">
<center>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout:fixed;background-color:#F9F9F9;" id="bodyTable">
        <tr>
            <td align="center" valign="top" style="padding-right:10px;padding-left:10px;" id="bodyCell">
                <table border="0" cellpadding="0" cellspacing="0" style="max-width:600px;" width="100%" class="wrapperTable">
                    <tr>
                        <td align="center" valign="top">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="logoTable">
                                <tr>
                                    <td align="center" valign="middle" style="padding-top:40px;padding-bottom:40px">
                                        <a href="<?=base_url();?>" target="_blank" style="text-decoration:none;">
                                            <img src="<?=base_url();?>assets/img/email-template/logo.png" alt="" width="180" border="0" style="height:auto; display:block;"/>
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                <!-- Email Body Open // -->
                <table border="0" cellpadding="0" cellspacing="0" style="max-width:600px;" width="100%" class="wrapperTable">
                    <tr>
                        <td align="center" valign="top">
                            <!-- Card Table Open // -->
                            <table border="0" cellpadding="0" cellspacing="0" style="background-color:#FFFFFF;border:1px solid #EEEEEE;" width="100%" class="oneColumn">

                                <!-- Header Border // -->
                                <tr>
                                    <td class="topBorder" height="3" style="background-color:#0287d0;font-size:1px;line-height:3px;">&nbsp;</td>
                                </tr>



                                <tr>
                                    <td align="center" valign="top" style="padding-top:25px;padding-bottom:15px;padding-left:20px;padding-right:20px;" class="title">
                                        <!-- Main Title Text // -->
                                        <h2 class="bigTitle" style="color:#313131; font-family:'Open Sans', Helvetica, Arial, sans-serif; font-size:26px; font-weight:600; font-style:normal; letter-spacing:normal; line-height:34px; text-align:center; padding:0; margin:0;">
                                            Message Received
                                        </h2>
                                    </td>
                                </tr>


                                <tr>
                                    <td align="center" valign="top" style="padding-bottom:40px;padding-left:20px;padding-right:20px;" class="description">
                                        <p class="midText" style="color:#313131; font-family:'Open Sans', Helvetica, Arial, sans-serif; font-size:18px; font-weight:400; line-height:22px; text-align:center; padding:0; margin:0;">
                                            You’ve received a new message from
                                            <!--<a href="#" style="color:#0287d0;font-weight:700;text-decoration:none" target="_blank" class="name"><?/*=($receiver_name);*/?></a>-->
                                            <a href="#" style="color:#0287d0;font-weight:700;text-decoration:none" target="_blank" class="name"><?=$poster_name;?></a>
                                        </p>
                                    </td>
                                </tr>

                                <tr>
                                    <td align="center" valign="top" style="padding-bottom:40px;padding-left:20px;padding-right:20px;" class="description">
                                        <!-- Description  Text// -->
                                        <p class="midText" style="color:#919191; font-family:'Open Sans', Helvetica, Arial, sans-serif; font-size:14px; font-weight:400; line-height:22px; text-align:center; padding:0; margin:0;">
                                            <strong>Message:</strong> <?=($message);?>
                                        </p>
                                    </td>
                                </tr>

                                <tr>
                                    <td align="center" valign="top" style="padding-bottom:40px;padding-left:20px;padding-right:20px;" class="btnCard">
                                        <!-- Button Table // -->
                                        <table align="center" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td align="center" class="postButton" style="background-color:#0287d0;padding-top:10px;padding-bottom:10px;padding-left:25px;padding-right:25px;border-radius:2px">
                                                    <!-- Button Link // -->
                                                    <a href="<?=$url;?>" target="_blank" style="color:#FFFFFF; font-family:'Open Sans', Helvetica, Arial, sans-serif; font-size:12px; font-weight:600; letter-spacing:1px; line-height:20px; text-transform:uppercase; text-decoration:none; display:block;" >
                                                        Login to View Message
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td height="10" style="font-size:1px;line-height:1px;">&nbsp;</td>
                                </tr>

                            </table>
                            <!-- Card Table Close// -->




                                <!-- Space -->
                                <table border="0" cellpadding="0" cellspacing="0" width="100%" class="space">
                                    <tr>
                                        <td height="30" style="font-size:1px;line-height:1px;">&nbsp;</td>
                                    </tr>
                                </table>

                        </td>
                    </tr>
                </table>
                <!-- Email Footer Open // -->
                <table border="0" cellpadding="0" cellspacing="0" style="max-width:600px;" width="100%" class="wrapperTable">
                    <tr>
                        <td align="center" valign="top">
                            <!-- Content Table Open// -->
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="footer">
                                <tr>
                                    <td align="center" valign="top" style="padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px;" class="socialLinks">
                                        <!-- Social Links (Facebook)// -->
                                        <a href="https://www.facebook.com/zoneypk/" target="_blank" style="display:inline-block;" class="facebook">
                                            <img src="<?=base_url();?>assets/img/email-template/facebook.png" alt="" width="40" border="0" style="height:auto;margin:2px" />
                                        </a>
                                        <!-- Social Links (Twitter)// -->
                                        <a href="https://twitter.com/zoneypk" target="_blank" style="display:inline-block;" class="twitter">
                                            <img src="<?=base_url();?>assets/img/email-template/twitter.png" alt="" width="40" border="0" style="height:auto;margin:2px" />
                                        </a>
                                        <!-- Social Links (Twitter)// -->
                                        <a href="https://plus.google.com/u/5/104904576541281508738" target="_blank" style="display:inline-block;" class="google">
                                            <img src="<?=base_url();?>assets/img/email-template/google.png" alt="" width="40" border="0" style="height:auto;margin:2px" />
                                        </a>
                                        <!-- Social Links (Instagram)// -->
                                        <a href="https://www.instagram.com/zoneypk/" target="_blank" style="display:inline-block;" class="instagram">
                                            <img src="<?=base_url();?>assets/img/email-template/instagram.png" alt="" width="40" border="0" style="height:auto;margin:2px" />
                                        </a>
                                        <!-- Social Links (Linkdin)// -->
                                        <a href="https://www.pinterest.com/zoneypk/" target="_blank" style="display:inline-block;" class="pintrest">
                                            <img src="<?=base_url();?>assets/img/email-template/pintrest.png" alt="" width="40" border="0" style="height:auto;margin:2px" />
                                        </a>
                                    </td>
                                </tr>


                                <tr>
                                    <td align="center" valign="top" style="padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px;" class="brandInfo">
                                        <!-- Information of NewsLetter (Privacy Policy)// -->
                                        <p class="smlText" style="color:#181818; font-family:'Open Sans', Helvetica, Arial, sans-serif; font-size:12px; font-weight:400; line-height:18px; text-align:center; margin:0; padding:0;">
                                            <a href="<?=base_url();?>" style="color:#0287d0;text-decoration:none" target="_blank">zoney.pk</a>, | 722, 7th Floor, Siddique Trade Center, Gulberg III, Lahore.
                                            <br /><br />
                                            © zoney 2018 - All rights reserved
                                        </p>
                                    </td>
                                </tr>


                            </table>
                            <!-- Content Table Close// -->
                        </td>
                    </tr>

                    <!-- Space -->
                    <tr>
                        <td height="30" style="font-size:1px;line-height:1px;">&nbsp;</td>
                    </tr>
                </table>
                        </td>
                    </tr>
                </table>
</center>
</body>
</html>