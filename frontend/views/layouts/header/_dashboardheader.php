<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
$user = Yii::$app->user->identity;
$model = Yii::$app->user->engineer!=null ? Yii::$app->user->engineer : $user;

$formatter = \Yii::$app->formatter;
?>            
                      
    <ul class="sidebar setup collapse" id="navbar-collapse">
        <li class="<?= (isset($this->params['page_title']) and $this->params['page_title']=='Projekat') ? 'active' : null ?>">            
            <table>
                <tr>
                    <td class="main-switch-menu"><a href="/user/security/projects"><i class="fa fa-home fa-2x"></i><div style="font-size:9px;">Projekti</div></a></td>
                    <td class="side-menu"> 
                        <div class="primary-context normal">
                                <div class="head second">
                                
                                    <a href="/"><i class="fa fa-file-o"></i> Projekti inženjera</a>
                                </div>
                                <div class="subhead">Korisnička tabla - početna strana.</div>
                            </div>

                        <?php if($this->params['page_title']=='Projekat'): ?>
                                                        

                        <?php endif; ?>
                    </td>
                </tr>
            </table>
        </li>

        <li class="<?= (isset($this->params['page_title']) and $this->params['page_title']=='Profil') ? 'active' : null ?>">            
            <table>
                <tr>
                    <td class="main-switch-menu"><a href="/home"><i class="fa fa-user fa-2x"></i><div style="font-size:9px;">Profil</div></a></td>
                    <td class="side-menu">                        

                        <div class="primary-context normal">
                            <div class="head second">
                            
                                <a href="/"><i class="fa fa-user"></i> Korisnički profil</a>
                            </div>
                            <div class="subhead">Korisnička tabla - početna strana.</div>
                        </div>                    
                        <?php if($this->params['page_title']=='Profil'): ?>
                            <ul class="nav nav-pills nav-stacked left">
                                <li><a href="/user/settings/account"><i class="fa fa-cog"></i> Podešavanje naloga</a></li>
                            </ul>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
        </li>

        <li class="<?= (isset($this->params['page_title']) and $this->params['page_title']=='Inženjer') ? 'active' : null ?>">            
            <table>
                <tr>
                    <td class="main-switch-menu"><a href="/engineers/update/<?= Yii::$app->user->id ?>"><i class="fa fa-graduation-cap fa-2x"></i><div style="font-size:9px;">Inženjer</div></a></td>
                    <td class="side-menu">                        
                        <div class="primary-context normal">
                                <div class="head second">
                                    <a href="/engineers/<?= Yii::$app->user->id ?>" class=""><?= $model->name ?></a>
                                    <div class="subhead">
                                        <?= (Yii::$app->user->engineer!=null) ? '<div class="fs_10"><i class="fa fa-check"></i> '.$model->expertees->name.'</div>' : '<div class="label label-success fs_11 thin"><i class="fa fa-check"></i> user</div>' ?>
                                    </div>
                                </div>                            
                            </div>   
                            
                        <?php if($this->params['page_title']=='Inženjer'): ?>
                            
                            <?php if(Yii::$app->user->engineer and $practice = $model->practice): ?>
                            <div class="secondary-context cont">
                                
                                <div class="head second">
                                    <div class="subhead hint">
                                        direktor @
                                    </div>    
                                    <?= Html::a($practice->name, Url::to(['/practices/view', 'id'=>$practice->engineer_id]), []) ?>      
                                    <div class="subhead hint">
                                        <?= $practice->location->fullAddress ?>
                                    </div>         
                                </div> 
                            </div>
                            <?php endif; ?>
                            <?php if(Yii::$app->user->engineer and !Yii::$app->user->engineer->practice): ?>
                            <?php $practice = Yii::$app->user->engineer->practiceEngineers[0]->practice; ?>
                            <div class="secondary-context gray cont hidden-md">
                                
                                <div class="head second">
                                    <div class="subhead hint">
                                        zaposleni @
                                    </div>
                                    <div class="subaction">
                                        
                                    </div>
                                    <?= Html::a($practice->name, Url::to(['/practices/view', 'id'=>$practice->engineer_id]), []) ?>      
                                    <div class="subhead hint">
                                        <?= $practice->location->fullAddress ?>
                                    </div>         
                                </div>                                 
                            </div>
                            <?php endif; ?>
                            <hr style="margin: 0 0 10px;" class="hidden-md">

                            <ul class="nav nav-pills nav-stacked left">
                                <li><a href="/engineers/update/<?= Yii::$app->user->id ?>">Podešavanje profila</a></li>
                                <li><a href="/engineer-licences/index?id=<?= Yii::$app->user->id ?>">Licence</a></li>
                                <li><a href="/">Firma</a></li>
                                <li><a href="/user/settings/portfolio-setup">Portfolio</a></li>
                            </ul>
                        <?php endif; ?>                        
                    </td>
                </tr>
            </table>
        </li>

        <li class="<?= (isset($this->params['page_title']) and $this->params['page_title']=='Firma') ? 'active' : null ?>">            
            <table>
                <tr>
                    <td class="main-switch-menu"><a href="/user/settings/practice-setup"><i class="fa fa-building fa-2x"></i><div style="font-size:9px;">Firma</div></a></td>
                    <td class="side-menu">                   
                        

                        <?php if(Yii::$app->user->engineer and $practice = $model->practice): ?>
                        <div class="primary-context normal">
                            
                            <div class="head second"> 
                                <?= Html::a($practice->name, Url::to(['/practices/view', 'id'=>$practice->engineer_id]), ['class'=>'']) ?>      
                                <div class="subhead hint">
                                    <?= $practice->location->fullAddress ?>
                                </div>         
                            </div>                                 
                        </div>
                        <?php endif; ?>
                        
                        <?php if($this->params['page_title']=='Firma'): ?>   

                            
                            <div class="secondary-context cont hidden-md">                             
                                <div class="subhead">
                                    <?= '<div class="fs_10">'.$practice->email.'</div>' ?>
                                    <?= '<div class="fs_10"><i class="fa fa-phone"></i> '.($practice->phone ?: 'Nije unet').'</div>' ?>
                                </div> 
                            </div>
                            <div class="secondary-context cont hidden-md">                             
                                <div class="subhead">
                                    direktor
                                </div>
                                <div class="head second"> 
                                    <?= Html::a($practice->engineer->name, Url::to(['/practices/view', 'id'=>$practice->engineer_id]), []) ?>      
                                    <div class="subhead hint">
                                        <?= $practice->engineer->title ?>
                                    </div>         
                                </div> 
                            </div>

                            <hr style="margin: 0 0 10px;" class="hidden-md">

                            <ul class="nav nav-pills nav-stacked left">
                                <li><a href="/practices/update/<?= Yii::$app->user->id ?>">Podešavanje</a></li>
                                <li><a href="/practice-engineers/index?id=<?= Yii::$app->user->id ?>">Inženjeri</a></li>
                                <li><a href="/clients/index?id=<?= Yii::$app->user->id ?>">Investitori</a></li>
                                <li><a href="/practice-partners/index?id=<?= Yii::$app->user->id ?>">Partneri</a></li>
                                <?php /* <li><a href="/">Portfolio</a></li>
                                <li><a href="/legal-files/index?id=<?= Yii::$app->user->id ?>">Dokumenti</a></li> */ ?>
                            </ul>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
        </li>

        
        <?php /* <li class="<?= (isset($this->params['page_title']) and $this->params['page_title']=='Nekretnine') ? 'active' : null ?>">            
            <table>
                <tr>
                    <td class="main-switch-menu"><a href="/"><i class="fa fa-home fa-2x"></i><div style="font-size:9px;">Nekretnine</div></a></td>
                    <td class="side-menu">                             
                        <?php if($this->params['page_title']=='Nekretnine'): ?>
                            <div class="primary-context normal hidden-md">
                                <div class="head second">
                                
                                    <a href="/"><i class="fa fa-user"></i> Nekretnine inženjera</a>
                                </div>
                                <div class="subhead">Korisnička tabla - početna strana.</div>
                            </div>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
        </li>
        <li class="<?= (isset($this->params['page_title']) and $this->params['page_title']=='Članci') ? 'active' : null ?>">
            <table>
                <tr>
                    <td class="main-switch-menu"><a href="/"><i class="fa fa-font fa-2x"></i><div style="font-size:9px;">Članci</div></a></td>
                    <td class="side-menu">
                        <?php if($this->params['page_title']=='Članci'): ?>
                            <div class="primary-context normal hidden-md">
                                <div class="head second">
                                
                                    <a href="/"><i class="fa fa-user"></i> Članci inženjera</a>
                                </div>
                                <div class="subhead">Korisnička tabla - početna strana.</div>
                            </div> 
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
        </li>
    */ ?>
    </ul>    
