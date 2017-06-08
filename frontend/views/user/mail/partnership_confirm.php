<?php $this->beginContent('@frontend/views/user/mail/layouts/html.php', ['email'=>$email]); ?>
 
<tr> 
    <td style="padding:24px 24px 16px"> 
        <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
            <?= $model->partner->name ?> je sada partner preduzeća <b><?= $model->practice->name ?></b>.
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
            Za više informacija o masterplan mreži, posetite <a href="http://masterplan.rs/">zvaničnu stranicu</a>.
        </p>

        <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
            S poštovanjem,<br>
            Tim Masterplan ARC d.o.o.
        </p>
    </td> 
</tr>                                     
<?php $this->endContent(); // HTML ?>