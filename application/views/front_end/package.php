<?php defined( 'BASEPATH') OR exit( 'No direct script access allowed'); ?>
<body>
<?php $this->load->view('templates/'.$topmenu); ?>
<?php $this->load->view('templates/quick_searchform'); ?>
<style>
    .package-block .package-list li{
        list-style: none;
    }
</style>
<div id="search_results">
    <section id="section-body">
        <div class="container">
            <div class="membership-page-top">
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <div class="membership-page-title">
                            <h1 class="page-title">Sélectionnez votre forfait membre Neighborty</h1>
                            <!--<p class="page-subtitle"> Thank you for joining your Membership </p>-->
                        </div>

                    </div>
                </div>
            </div>

            <div class="membership-content-area">
                <div class="houzez-module package-table-module">
                    <div class="container">
                        <div class="row">
                            <?php foreach($packages as $row):?>

                                <div class="col-md-3 col-sm-6 package_<?=$row->id;?>">
                                    <div class="package-block <?= ($row->highlight == 1 ? 'active': 'none');?>">
                                        <h3 class="package-title"><?=$row->name;?></h3>
                                        <?php if($row->tags != ''){ ?>
                                            <div class="tags"><?=$row->tags;?></div>
                                        <?php } ?>
                                        <h1 class="package-price">
                                            <?php
                                            $num =$row->price;
                                            list($whole, $decimal) = explode('.', $num);
                                            ?>
                                            <?php if (is_numeric($row->price)) { ?>
                                                <span class="price-before">€</span><span class="price-number"><?=$whole;?></span><span class="price-before">.<?=$decimal;?></span>
                                            <?php } else { ?>
                                                <span class="price-before"></span><span class="price-number"><?=$row->price;?></span></span>
                                            <?php }?>
                                        </h1>
                                        <ul class="package-list">
                                            <?=$row->description;?>
                                        </ul>
                                        <div class="package-link">

                                            <?php if ($this->session->userdata('logged_in')) { ?>

                                                <?php if($row->slug == 'basic') { ?>

                                                <a href="javascript:void(0)" class="btn btn-primary btn-lg"><?=$row->button_text;?></a>

                                               <?php } else{ ?>
                                                
                                                   <?php if($row->slug == 'enterprise') { ?>
                                                       <a href="<?= site_url("contact")?>" class="btn btn-primary btn-lg"><?=$row->button_text;?></a>
                                                     <?php } else { ?>
                                                        <a href="<?= site_url("packages/confirm_package/".$row->slug)?>" class="btn btn-primary btn-lg"><?=$row->button_text;?></a>
                                                    <?php     } ?>
                                                <?php     } ?>

                                            <?php } else { ?>
                                                <a href="<?= site_url("login/")?>" class="btn btn-primary btn-lg"><?=$row->button_text;?></a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
