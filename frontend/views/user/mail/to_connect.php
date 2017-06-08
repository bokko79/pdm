<?php $this->beginContent('@frontend/views/user/mail/layouts/html.php', ['email'=>$email]); ?>
 
<tr> 
    <td style="padding:24px 24px 16px"> 
        <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
            Poštovani kolega <?= $model->partner->engineer->name ?>,
        </p>
        <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
            Preduzeće <b><?= $model->practice->name ?></b> uputilo Vam je poziv da postanete partner tog preduzeća i na taj način proširite svoju poslovno-stručnu mrežu.  
        </p>

        <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
            <a href="http://masterplan.rs/practicePartners/confirm?id=<?= $model->id ?>" class="btn btn-default">Klikom na ovaj link</a>, potvrđujete partnerstvo sa preduzećem <?= $model->practice->name ?>.
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
            Masterplan je web stranica za upravljanje arhitektonsko-građevinskim projektima i projektnom dokumentacijom, arhitekonski konsalting i baza podataka projekata, inženjera, građevinskih preduzeća i nekretnina.
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
<?php $this->endContent(); // HTML ?>