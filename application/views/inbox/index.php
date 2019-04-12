<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<body>
<?php $this->load->view('dashboard/dashboard-header'); ?>


<!--start section page body-->
<section id="section-body">

    <div class="container">

        <div class="user-dashboard-full">
            <?php $this->load->view('dashboard/dashboard-sidebar'); ?>

            <div class="profile-area-content" style="background-color: ">
                <div class="profile-top">
                    <h2 class="title"><?=$this->lang->line('mailbox');?>
                        <?php //if($balance[0]->balance == 0 && $_SESSION['logged_in']['user_type'] =='Agent'){ ?>

                           <!-- <label class="btn btn-sm label label-danger">Locked </label> -->
                        <?php //} ?>
                    </h2>
                </div>


                <?php //if($balance[0]->balance == 0 && $_SESSION['logged_in']['user_type'] =='Agent'){ ?>

                   <!-- <div class="article-detail text-center">
                        <h1><?=$this->lang->line('locked_text');?></h1>
                        <!--<p><?=$this->lang->line('locked_text_recharge');?></p>

                        <!--<a href="#" data-toggle="modal" data-target="#pop-method" class="btn btn-primary btn-md"><?=$this->lang->line('add_credit_btn');?></a>

                    </div>
                    -->

                <?php// } else{ ?>


                    <div class="portlet light">
                        <div class="portlet-body">
                            <div class="row inbox">
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <ul class="inbox-nav margin-bottom-10">
                                        <li class="inbox active">
                                            <a href="javascript:;" class="btn" data-title=" <?=$this->lang->line('message');?>">
                                                <?=$this->lang->line('message');?> (<?=$messages_count; ?>) </a>
                                            <b></b>
                                        </li>

                                        <li class="applications">
                                            <a class="btn" href="javascript:;" data-title="<?=$this->lang->line('request_received');?>">
                                                <?=$this->lang->line('request_received');?>  (<?= $ApplicationCount; ?>) </a>
                                            <b></b>
                                        </li>
                                        <li class="appointments">
                                            <a class="btn" href="javascript:;" data-title=" <?=$this->lang->line('appointments');?>">
                                                <?=$this->lang->line('appointments');?> (<?= $AppointmentCount; ?>)</a>
                                            <b></b>
                                        </li>
                                        <li class="sent">
                                            <a class="btn" href="javascript:;" data-title="<?=$this->lang->line('sent');?>">
                                                <?=$this->lang->line('sent');?> </a>
                                            <b></b>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-9 col-sm-12 col-xs-12">
                                    <div class="my-property">
                                        <div class="inbox-header"><h3 class="pull-left"><?=$this->lang->line('my_mailbox');?></h3></div>
                                        <div class="inbox-loading"><?=$this->lang->line('loading');?>...</div>
                                        <div class="inbox-content"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php //} ?>


            </div>
        </div>
    </div>
</section>
<div class="clearfix"></div>
<div class="modal fade" id="pop-method" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content host-modal">
            <div class="modal-header host-modal-header">
                <h4 class="modal-title">Add Credit</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>
            <div class="modal-body host-modal-body">
                <div class="container-fluid">

                    <div class="membership-content" style="padding:0px;">

                        <form id="payment_form" name="payment_form" action="<?=site_url('packages/confirm_payment');?>" method="post">

                            <div id="paymentErrors" class="paymentErrors"></div>
                            <div class="info-title">
                                <h2 class="info-title-left"> Add Credit</h2>
                            </div>
                            <div class="info-detail" style="margin-bottom: 0px;">
                                <div class="row">
                                    <div id="stripe_box">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="address">Amount*</label>
                                                <input type="number" required id="name" name="amount" class="form-control" placeholder="Enter Amount" >
                                            </div>
                                        </div>
                                    </div>

                                    <!--<div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="phone"> Message * </label>
                                            <textarea class="form-control" rows="6" name="message" placeholder="Write Your Thoughts"></textarea>
                                        </div>
                                    </div>-->
                                </div>
                            </div>
                            <input type="hidden" name="package" value="<?= $packages->name ?>" />


                            <button type="submit" id="place_order" class="btn btn-success btn-submit"> Buy </button>
                        </form>
                    </div>


                </div>
            </div>
            <!--<div class="modal-footer host-modal-footer">
                <button onclick="" class="btn btn-primary">SUBMIT</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>-->
        </div>
    </div>
</div>
<div class="page-container">
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-head">
                <div class="page-title">
                    <h1></h1>
                </div>
            </div>
        </div>
    </div>
</div>
