<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
$user = Yii::$app->user->identity;
$model = Yii::$app->user->engineer!=null ? Yii::$app->user->engineer : $user;

$formatter = \Yii::$app->formatter;
?>            
                      
    <ul class="sidebar switch-only">
        <li class="<?= (isset($this->params['page_title']) and $this->params['page_title']=='Projekat') ? 'active' : null ?>">            
            <table>
                <tr>
                    <td class="main-switch-menu"><a href="/user/security/projects"><i class="fa fa-home fa-2x"></i><div style="font-size:9px;">Projekti</div></a></td>                    
                </tr>
            </table>
        </li>
        <li class="<?= (isset($this->params['page_title']) and $this->params['page_title']=='Profil') ? 'active' : null ?>">            
            <table>
                <tr>
                    <td class="main-switch-menu"><a href="/home"><i class="fa fa-user fa-2x"></i><div style="font-size:9px;">Profil</div></a></td>                    
                </tr>
            </table>
        </li>
        
        <li class="<?= (isset($this->params['page_title']) and $this->params['page_title']=='Inženjer') ? 'active' : null ?>">            
            <table>
                <tr>
                    <td class="main-switch-menu"><a href="/engineers/update/<?= Yii::$app->user->id ?>"><i class="fa fa-graduation-cap fa-2x"></i><div style="font-size:9px;">Inženjer</div></a></td>                    
                </tr>
            </table>
        </li>

        <li class="<?= (isset($this->params['page_title']) and $this->params['page_title']=='Firma') ? 'active' : null ?>">            
            <table>
                <tr>
                    <td class="main-switch-menu"><a href="/user/settings/practice-setup"><i class="fa fa-building fa-2x"></i><div style="font-size:9px;">Firma</div></a></td>                    
                </tr>
            </table>
        </li>

        
        <?php /* <li class="<?= (isset($this->params['page_title']) and $this->params['page_title']=='Nekretnine') ? 'active' : null ?>">            
            <table>
                <tr>
                    <td class="main-switch-menu"><a href="/"><i class="fa fa-home fa-2x"></i><div style="font-size:9px;">Nekretnine</div></a></td>                   
                </tr>
            </table>
        </li>
        <li class="<?= (isset($this->params['page_title']) and $this->params['page_title']=='Članci') ? 'active' : null ?>">
            <table>
                <tr>
                    <td class="main-switch-menu"><a href="/"><i class="fa fa-font fa-2x"></i><div style="font-size:9px;">Članci</div></a></td>                    
                </tr>
            </table>
        </li>
    */ ?>
    </ul>    
