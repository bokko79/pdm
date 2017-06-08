<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

/**
 * @var \yii\web\View $this
 * @var yii\mail\BaseMessage $content
 */
?>
<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; margin: 0; padding: 0;">
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <?php $this->head() ?>
</head>
<body bgcolor="#f6f6f6" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; margin: 0; padding: 0;">
    <div style="padding:0;margin:0 auto;width:100%!important;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif">
        <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%" bgcolor="#EDF0F3" style="background-color:#edf0f3;table-layout:fixed"> 
            <tbody> 
                <tr> 
                    <td align="center"> 
                        <center style="width:100%"> 
                            <table border="0" cellspacing="0" cellpadding="0" width="512" bgcolor="#FFFFFF" style="background-color:#ffffff;margin:0 auto;max-width:512px;width:inherit"> 
                                <tbody> 
                                    <tr> 
                                        <td bgcolor="#F6F8FA" style="background-color:#f6f8fa;padding:12px;border-bottom:1px solid #ececec"> 
                                            <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%!important;min-width:100%!important"> 
                                                <tbody> 
                                                    <tr> 
                                                        <td align="left" valign="middle">
                                                            <a href="http://masterplan.rs" style="color:#008cc9;display:inline-block;text-decoration:none" target="_blank"> 
                                                                <img alt="masterplan" border="0" src="http://masterplan.rs/images/logo2-small.png" height="34" width="190" style="outline:none;color:#ffffff;text-decoration:none">
                                                            </a>
                                                        </td>
                                                    </tr> 
                                                </tbody> 
                                            </table>
                                        </td> 
                                    </tr> 
                                    <tr> 
                                        <td> 
                                            <table border="0" cellspacing="0" cellpadding="0" width="100%"> 
                                                <tbody>
                                                    <?php $this->beginBody() ?>
                                                    <?= $content ?>
                                                    <?php $this->endBody() ?>
                                                </tbody> 
                                        </table> 
                                        
                                    </td> 
                                </tr> 
                                <tr> 
                                    <td> 
                                        <table border="0" cellspacing="0" cellpadding="0" width="100%" bgcolor="#EDF0F3" align="center" style="background-color:#edf0f3;padding:0 24px;color:#999999;text-align:center"> 
                                            <tbody> 
                                                <tr>
                                                    <td align="center" style="padding:16px 0 0 0;text-align:center"> 
                                                        <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%"> 
                                                            <tbody> 
                                                                <tr> 
                                                                    <td valign="middle" align="center" style="padding:0 0 16px 0;vertical-align:middle;text-align:center">                                                                      
                                                                        <a href="http://masterplan.rs/projects" style="color:#737373;text-decoration:underline;display:inline-block" target="_blank"> 
                                                                            <span style="color:#737373;font-weight:400;text-decoration:underline;font-size:12px;line-height:1.333">Projekti</span>
                                                                        </a>  |  
                                                                        <a href="http://masterplan.rs/practices" style="color:#737373;text-decoration:underline;display:inline-block" target="_blank"> 
                                                                            <span style="color:#737373;font-weight:400;text-decoration:underline;font-size:12px;line-height:1.333">Projektanti</span>
                                                                        </a>  |  
                                                                        <a href="http://masterplan.rs/" style="color:#737373;text-decoration:underline;display:inline-block" target="_blank"> 
                                                                            <span style="color:#737373;font-weight:400;text-decoration:underline;font-size:12px;line-height:1.333">Info</span>
                                                                        </a>
                                                                    </td> 
                                                                </tr> 
                                                            </tbody> 
                                                        </table>
                                                    </td> 
                                                </tr> 
                                                <tr> 
                                                    <td> 
                                                        <table border="0" cellspacing="0" cellpadding="0" width="100%"> 
                                                            <tbody> 
                                                                <tr> 
                                                                    <td align="center" style="padding:0 0 12px 0;text-align:center"> 
                                                                        <p style="margin:0;color:#737373;font-weight:400;font-size:12px;line-height:1.333">Primili ste masterplan.rs notifikacioni email.</p>
                                                                    </td> 
                                                                </tr> 
                                                                <tr> 
                                                                    <td align="center" style="padding:0 0 12px 0;text-align:center"> 
                                                                        <p style="margin:0;word-wrap:break-word;color:#737373;word-break:break-word;font-weight:400;font-size:12px;line-height:1.333">Ovaj email je poslat na adresu <?= $email ?>.</p>
                                                                    </td> 
                                                                </tr> 
                                                                <tr> 
                                                                    <td align="center" style="padding:0 0 8px 0;text-align:center">
                                                                        <a href="http://masterplan.rs/" style="color:#737373;text-decoration:underline;display:inline-block" target="_blank">
                                                                            <img alt="masterplan" border="0" height="14" src="http://masterplan.rs/images/logo2-small.png" width="80" style="outline:none;color:#ffffff;display:block;text-decoration:none">
                                                                        </a>
                                                                    </td> 
                                                                </tr> 
                                                                <tr> 
                                                                    <td align="center" style="padding:0 0 12px 0;text-align:center"> 
                                                                        <p style="margin:0;color:#737373;font-weight:400;font-size:12px;line-height:1.333">
                                                                            © <?= date('Y') ?> Masterplan ARC društvo sa ograničenom odgovornošću, Kralja Aleksandra br. 14/1, Novi Sad, Novi Sad, Repubika Srbija. Masterplan ARC je registrovano poslovno ime preduzeća Masterplan ARC d.o.o. Novi Sad. Masterplan i Masterplan ARC logo su zaštitni znaci preduzeća Masterplan ARC d.o.o. Novi Sad.
                                                                        </p>
                                                                    </td> 
                                                                </tr> 
                                                            </tbody> 
                                                        </table>
                                                    </td> 
                                                </tr> 
                                            </tbody> 
                                        </table>
                                    </td> 
                                </tr> 
                            </tbody> 
                        </table> 
                    </center>
                </td> 
            </tr> 
        </tbody> 
    </table> 
</div>

</body>
</html>
<?php $this->endPage() ?>
