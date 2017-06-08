<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'Project Documentation Manager';

/*
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>PDM</h1>

        <p class="lead">Upravljanje građevinskom<br> projektno-tehničkom dokumentacijom.</p>

        <p><?= Html::a(Yii::t('app', 'Projekti'), ['/projects'], ['class' => 'btn btn-lg btn-info']) ?>
            
            <?= Html::a(Yii::t('app', 'Novi projekat'), ['/projects/create'], ['class' => 'btn btn-lg btn-default']) ?>
        </p>
    
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Stručno</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Lako</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Po propisima</h2>

                <p>PDM je izrađen po važećoj stručnoj i pravnoj regulativi i propisima, koji važe na teritoriji Republike Srbije.</p>

                <p><?= Html::a(Yii::t('app', 'Regulativa'), ['/regulations'], ['class' => 'btn btn-default']) ?></p>
            </div>
        </div>

    </div>
</div>
*/ ?>

<div id="undefined-sticky-wrapper" class="sticky-wrapper is-sticky" style="height: 91px;">
    <div class="navbar navbar-custom navbar-fixed-top sticky transparent" role="navigation" style="">
        <div class="container">

            <!-- Navbar-header -->
            <div class="navbar-header">
            <!-- Responsive menu button -->
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <i class="fa fa-bars"></i>
                </button>

            <!-- LOGO -->
                <a class="navbar-brand logo light" href="">
                    <?= Html::img('/images/logo3-white.png', ['style'=>'width:150px;']) ?>
                </a>
                <a class="navbar-brand logo dark" href="" style="display: none">
                    <?= Html::img('/images/logo2-small.png', ['style'=>'width:150px;']) ?>
                </a>

            </div>
            <!-- end navbar-header -->

            <!-- menu -->
            <div class="navbar-collapse collapse" id="navbar-menu">

            <!-- Navbar left -->


            <!-- Navbar right -->
                <ul class="nav navbar-nav navbar-right">
                    <?php /*<li class="">
                        <a href="#home">Home</a>
                    </li>
                    <li class="">
                        <a href="#features">Sadržaji</a>
                    </li>
                    <li class="">
                        <a href="#faq">FAQ</a>
                    </li> */ ?>
                    <?php if(\Yii::$app->user->isGuest): ?>
                    <li>
                        <?= Html::a('Login', ['/user/security/login'], ['class'=>'']); ?>        
                    </li>
                    <li>
                        <?= Html::a('Registracija', ['/user/registration/register'], ['class'=>'']); ?>
                    </li>
                    
                    <?php endif; ?>
                    <li>
                        <?= Html::a('Projekti', ['/projects'], ['class'=>'']); ?>
                    </li>
                    <li>
                        <?= Html::a('Projektanti', ['/practices'], ['class'=>'']); ?>
                    </li>
                </ul>

            </div>
            <!--/Menu -->
        </div>
        <!-- end container -->
    </div>
</div>


<section class="home home-form-left bg-img-1" id="home">
 <div class="bg-overlay"></div>
    <div class="container text-white">
        <div class="row">
            <div class="col-sm-6">
              <img src="images/icons/6_building.png" class="img-responsive fadeIn animated wow animated" data-wow-delay=".2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeIn;">
            </div>
            <div class="col-md-6 col-sm-6">

                <div class="home-wrapper text-white">
                    <h2 class="animated fadeInDown wow text- animated" data-wow-delay=".1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInDown;">
                        Masterplan <span class="text-colored"></span>
                    </h2>
                    <p class="animated fadeInDown wow text-muted animated text-" data-wow-delay=".2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInDown;">
                        masterplan.rs je web stranica za upravljanje arhitektonsko-građevinskim projektima i projektnom dokumentacijom, arhitekonski konsalting i baza podataka projekata, inženjera, građevinskih preduzeća i nekretnina. 
                    </p>
                    <a href="/projects" class="btn btn-info btn-shadow btn-rounded w-lg animated fadeInDown wow animated" data-wow-delay=".4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInDown;">Projekti</a>
                    <div class="clearfix"></div>
                </div><!-- home wrapper -->

            </div> <!-- end col -->


        </div> <!-- end row -->
    </div> <!-- end container -->
</section>

  
<section class="section" id="features">
    <div class="container">

      <div class="row">
        <div class="col-sm-12 text-center">
          <div class="title-box">
            <p class="title-alt">masterplan.rs</p>
            <h3 class="fadeIn animated wow animated" data-wow-delay=".1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;">Predstavljamo glavne usluge</h3>
            <div class="border"></div>
          </div>
        </div> 
      </div> <!-- end row -->

      <div class="row text-center">
        <div class="col-sm-4">
          <div class="service-item animated fadeInDown wow animated" data-wow-delay=".1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInDown;">
            <i class="fa fa-star fa-3x"></i>
            <div class="service-detail">
              <h4>Arhitektonski projekti</h4>
              <p>Online mesto na kojem svakodnevno možete pratiti i informisati se o arhitektonsko-građevinskim projektima i građenju u Republici Srbiji.</p>
            </div> <!-- /service-detail -->
          </div> <!-- /service-item -->
        </div> <!-- /col -->

        <div class="col-sm-4">
          <div class="service-item animated fadeInDown wow animated" data-wow-delay=".3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInDown;">
            <i class="fa fa-book fa-3x"></i>
            <div class="service-detail">
              <h4>Blog</h4>
              <p>Razgovaramo o lepim stvarima, ali i aktuelnim problemima u oblasti građevinarstva, stanovanja i korišćenja građene sredine uopšte.</p>
            </div> <!-- /service-detail -->
          </div> <!-- /service-item -->
        </div> <!-- /col -->

        <div class="col-sm-4">
          <div class="service-item animated fadeInDown wow animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInDown;">
            <i class="fa fa-user-circle fa-3x"></i>
            <div class="service-detail">
              <h4>Projektanti</h4>
              <p>Online portfolio stručnjaka, inženjera i saradnika, fizičkih i pravnih lica. Pratimo njihov stvaralački i profesionalni rad doprinos.</p>
            </div> <!-- /service-detail -->
          </div> <!-- /service-item -->
        </div> <!-- /col -->       
      </div> <!--end row -->


      <div class="row text-center">
        <div class="col-sm-4">
          <div class="service-item animated fadeInDown wow animated" data-wow-delay=".1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInDown;">
            <i class="fa fa-bullhorn fa-3x"></i>
            <div class="service-detail">
              <h4>Pitajte stručnjake</h4>
              <p>Gradite, adaptirate ili možda rekonstruišete objekat? Imate želju ili ideju, ali ne znate kako i koliko? Svima nam ponekad treba pomoć nekoga ko zna, može i hoće da pomogne. Ovo je pravo mesto</p>
            </div> <!-- /service-detail -->
          </div> <!-- /service-item -->
        </div> <!-- /col -->

        <div class="col-sm-4">
          <div class="service-item animated fadeInDown wow animated" data-wow-delay=".3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInDown;">
            <i class="fa fa-shield fa-3x"></i>
            <div class="service-detail">
              <h4>Nekretnine</h4>
              <p>Prodaja i iznajmljivanje stambenih, poslovnih i drugih nekretnina u okviru novoizgrađenih ili rekonstruisanih objekata.</p>
            </div> <!-- /service-detail -->
          </div> <!-- /service-item -->
        </div> <!-- /col -->

        <div class="col-sm-4">
          <div class="service-item animated fadeInDown wow animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInDown;">
            <i class="fa fa-gavel fa-3x"></i>
            <div class="service-detail">
              <h4>Zakonska regulativa</h4>
              <p>Informišite se na jednom mestu o važećoj pravnoj zakonskoj i stručnoj regulativi u oblasti projektovanja, građevine, stanovanja, imovinsko-pravnih odnosa i sl.</p>
            </div> <!-- /service-detail -->
          </div> <!-- /service-item -->
        </div> <!-- /col -->       
      </div> <!--end row -->


    </div> <!-- end container -->
  </section>
<?php if(\Yii::$app->user->isGuest): ?>

<section class="section bg-dark" id="features">
    <div class="container text-white">

      <div class="row">
        <div class="col-sm-6">
          <div class="feature-detail">

            <div class="title-box">
              <p class="title-alt">UPGD</p>
              <h3 class="fadeIn animated wow animated" data-wow-delay=".1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;">Jednostavno i brzo do projektne dokumentacije</h3>
              <div class="border"></div>
            </div>

            <ul class="zmdi-hc-ul">
              <li class="fadeIn animated wow animated" data-wow-delay=".1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;"><i class="zmdi-hc-li zmdi zmdi-caret-right-circle text-colored"></i><span class="text-muted">Upravljanje projektima i dokumentacijom</span></li>

              <li class="fadeIn animated wow animated" data-wow-delay=".2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeIn;"><i class="zmdi-hc-li zmdi zmdi-caret-right-circle text-colored"></i><span class="text-muted">Prezentacija projekata</span></li>

              <li class="fadeIn animated wow animated" data-wow-delay=".3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeIn;"><i class="zmdi-hc-li zmdi zmdi-caret-right-circle text-colored"></i><span class="text-muted">Prezentacija stručnog i poslovnog portfolia</span></li>

              <li class="fadeIn animated wow animated" data-wow-delay=".4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeIn;"><i class="zmdi-hc-li zmdi zmdi-caret-right-circle text-colored"></i><span class="text-muted">Predmer i predračun radova</span></li>

              <li class="fadeIn animated wow animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeIn;"><i class="zmdi-hc-li zmdi zmdi-caret-right-circle text-colored"></i><span class="text-muted">Mreža stručnih saradnika i konsultanata</span></li>

            </ul>

            <a href="/user/security/login" class="btn btn-info btn-shadow btn-rounded w-lg animated fadeInDown wow animated" data-wow-delay=".4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInDown;">Prijavi se odmah!</a>
          </div>
        </div>

        <div class="col-sm-6">
          <img src="images/icons/visuel2.png" class="img-responsive fadeIn animated wow animated" data-wow-delay=".2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeIn;">
        </div>

      </div>
    </div>
  </section>
<?php endif; ?>

<section class="section bg-dark" id="faq">
    <div class="container text-white">

      <div class="row">
        <div class="col-sm-12 text-center">
          <div class="title-box">
            <p class="title-alt">Faq</p>
            <h3 class="fadeIn animated wow animated" data-wow-delay=".1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;">Najčešća pitanja</h3>
            <div class="border"></div>
          </div>
        </div> 
      </div> <!-- end row -->

      <div class="row m-t-30">
        <div class="col-md-5 col-md-offset-1">
          <!-- Question/Answer -->
          <div class="question-q-box">Q.</div>
          <div class="animated fadeInLeft wow animated" data-wow-delay=".1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;">
            <h4 class="question" data-wow-delay=".1s">Šta je UPGD?</h4>
            <p class="answer">UPGD (Upravljač projektno-građevinskom dokumentacijom) je alat u obliku online aplikacije, namenjen projektantima u Republici Srbiji za jednostavno, brzo i efikasno upravljanje građevinskom dokumentacijom.</p>
          </div>

          <!-- Question/Answer -->
          <div class="question-q-box">Q.</div>
          <div class="animated fadeInLeft wow animated" data-wow-delay=".3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInLeft;">
            <h4 class="question">Zašto koristiti UPGD?</h4>
            <p class="answer">UPGD je jednostavan i pouzdan način za kreiranje, ažuriranje i upravljanje projektnom dokumentacijom u okviru građevinarstva. Nema više word ili excel, dokumenata, nema grešaka i vraćanja dokumentacije.</p>
          </div>

          <!-- Question/Answer -->
          <div class="question-q-box">Q.</div>
          <div class="animated fadeInLeft wow animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInLeft;">
            <h4 class="question">Šta sve mogu da generišem pomoću UPGD?</h4>
            <p class="answer">Unosom podataka, za samo par sekundi generišu se kompletne sveske (delovi projektne dokumentacije) za sve vrste građevinskih projekata, ali i predmeri radova, šeme stolarije, komercijalne skice stanova, građevinske table, ugovori, računi i drugi važni dokumenti.</p>
          </div>

        </div>
        <!--/col-md-5 -->

        <div class="col-md-5">
          <!-- Question/Answer -->
          <div class="question-q-box">Q.</div>
          <div class="animated fadeInRight wow animated" data-wow-delay=".2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInRight;">
            <h4 class="question">Da li je bezbedno?</h4>
            <p class="answer">Vi kontrolišete ko ima uvid u vaše projekte i podatke. Baš kao i Vaša e-mail adresa, podaci su zaštićeni, a za pristup nalogu potrebni su Vam korisničko ime i lozinka.</p>
          </div>

          <!-- Question/Answer -->
          <div class="question-q-box">Q.</div>
          <div class="animated fadeInRight wow animated" data-wow-delay=".4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInRight;">
            <h4 class="question">Kada i gde mogu da pristupim svojim podacima i projektima?</h4>
            <p class="answer">Bilo kada i sa bilo kog uređaja, desktop ili prenosnog računara, kao i mobilnih telefona i tablet uređaja. Upravljajte svojim projektima u bilo kom trenutku, čak i sa smart telefona.</p>
          </div>

          <!-- Question/Answer -->
          <div class="question-q-box">Q.</div>
          <div class="animated fadeInRight wow animated" data-wow-delay=".6s" style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInRight;">
            <h4 class="question">Pravna regulativa &amp; Copyright</h4>
            <p class="answer">UPGD prati važeću zakonsku i stručnu regulativu i prema njoj je dizajniran. Koristeći UPGD, više nećete imati potrebe za proučavanjem pravilnika ili regulative za izradu projektne dokumentacije.</p>
          </div>

        </div>
        <!--/col-md-5-->
      </div>

    </div>
  </section>