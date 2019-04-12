<?php defined( 'BASEPATH') OR exit( 'No direct script access allowed'); ?>
<?php
$this->load->view('templates/header');
$footer_data['custom_js'] = '';
?>
    <body>
<?php $this->load->view('templates/'.$topmenu); ?>
<?php $this->load->view('templates/quick_searchform'); ?>


    <div class="header-media">
        <div class="banner-parallax apply-parallax" style="height:380px;">
            <div class="banner-bg-wrap">
                <div class="banner-inner" style="background-image:url(<?=base_url()?>assets/img/02_splash_page.jpg);">
                    <div class="banner-caption">
                        <h1>Créer votre Dossier de location/achat</h1>
                        <!--<h2>you'll then be ready to one-click apply to millions of apartments</h2>-->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section id="section-body">
        <div class="container">
            <div class="page-title breadcrumb-top">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-left">
                            <h2>Dossier Immobilier</h2>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb"><li><a href=""><i class="fa fa-home"></i></a></li><li class="active">Application</li></ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="page-main">
                        <div class="article-detail">
                            <p><strong>Notifications</strong></p>
                            <hr>
                            <p class="text-center">Les notifications des agents immobiliers sera visible ici. Pour le moment vous pouvez toujours voir d’autres
                                appartements sur Neighborty
                                <br/>
                                <a href="<?=site_url('rent');?>">Rechercher un bien sur Neighborty</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:15px;">
                    <div class="page-main">
                        <div class="article-detail">
                            <p><strong>Dossier de location</strong> <span id="whole_form_weight" class="pull-right" style="color:#ff6e00;"></span></p>
                            <hr>
                            <p class="text-center"><a href="#" data-toggle="modal" data-target="#pop-apply" class="btn btn-primary">Modifier</a></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

<?php $this->load->view('includes/apply_model'); ?>

<?php $this->load->view('templates/footer', $footer_data); ?>