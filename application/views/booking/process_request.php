<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<body>
    <?php $this->load->view('templates/'.$topmenu); ?>

    <section id="section-body">
        <div class="container">

            <?php if($order_no != 0){ ?>
                <div class="membership-page-top">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            <div class="membership-page-title">
                                <h1 class="page-title">Confirmation d'achat # <?=$order_no;?></h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="membership-content-area">
                    <div class="membership-done-block white-block">
                        <div class="done-block-inner">
                            <div class="done-icon"><i class="fa fa-check"></i></div>
                            <h2> Merci pour Votre Achat! </h2>
                            <p><?=$respnsemessage?> </p>
                            <a href="<?=site_url('/dashboard');?>" class="btn btn-primary btn-long"> Voir mon Tableau de Bord </a>
                        </div>
                    </div>
                </div>
            <?php } else{ ?>

                <div class="membership-page-top">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            <div class="membership-page-title">
                                <h1 class="page-title"><p><?=$respnsemessage?> </p></h1>
                            </div>
                        </div>
                    </div>
                </div>


            <?php } ?>
        </div>
    </section>
