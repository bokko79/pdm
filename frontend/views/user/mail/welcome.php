<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;

/**
 * @var dektrium\user\Module $module
 * @var dektrium\user\models\User $user
 * @var dektrium\user\models\Token $token
 * @var bool $showPassword
 */
?>
<?php $this->beginContent('@frontend/views/user/mail/layouts/html.php', ['email'=>$email]); ?>
 
<tr> 
    <td style="padding:24px 24px 16px"> 
        <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
            Poštovani,
        </p>
        <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
            Dobrodošli na <?= Yii::$app->name ?> i hvala na registraciji.
        </p>

        <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
            Registracijom na <a href="http://masterplan.rs/">masterplan.rs</a> priključujete se širućoj poslovnoj i stručnoj mreži projektanata i imate odličnu šansu da unapredite svoje poslovanje i poslovnu mrežu.
        </p>
    </td> 
</tr> 
        
<tr> 
    <td> 
        <hr style="background-color:#d9d9d9;margin:0;color:#d9d9d9;border-color:#d9d9d9;border-width:0;border-style:solid;height:1px">
    </td> 
</tr>
<tr> 
    <td style="padding:24px 24px 16px">
        <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
            Masterplan je web stranica za upravljanje arhitektonsko-građevinskim projektima i projektnom dokumentacijom, arhitektonski konsalting i baza podataka arhitektonsko-građevinskih projekata, inženjera, građevinskih preduzeća i nekretnina.
        </p>

        <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
            Za više informacija o masterplan mreži, posetite <a href="http://masterplan.rs/">zvaničnu stranicu</a>.
        </p>

        <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
            U nadi da ćemo ostvariti zajedničke poslovne i stručne uspehe, s poštovanjem<br>
            Bojan Grozdanić, dipl. ing. arh.<br>
            Masterplan ARC d.o.o.
        </p>
    </td> 
</tr>                                               
<tr> 
    <td> 
        <hr style="background-color:#d9d9d9;margin:0;color:#d9d9d9;border-color:#d9d9d9;border-width:0;border-style:solid;height:1px">
    </td> 
</tr>
<tr> 
    <td style="padding:24px 24px 16px">
        <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
            Ukoliko se niste Vi (ili neko u Vaše ime) registrovali na masterplan, dobili ste ovaj mail greškom i možete ga ignorisati.
        </p>
    </td> 
</tr>                                         
<?php $this->endContent(); // HTML ?>


