<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<body>
<?php $this->load->view('dashboard/dashboard-header'); ?>
<style>
    .popover{
        max-width:600px;
    }
</style>

<!--start section page body-->
<section id="section-body">
    <div class="container">
        

        <div class="user-dashboard-full">
            <?php $this->load->view('dashboard/dashboard-sidebar'); ?>
            <div class="profile-area-content">
                <div class="profile-top">
                    <div class="profile-top-left">
                        <h2 class="title"><?=$this->lang->line('payment');?></h2>
                    </div>
                </div>

                <div class="my-property-listing">

                    <div class="payment-side-block">
                        <div class="method-select-block" style="margin-bottom:0px;">
                            <div class="method-row">
                                <div class="row">
                                    <div class="col-md-2"><h3 class="side-block-title" style="margin: 5px 0 10px"><?=$this->lang->line('account');?></h3></div>
                                    <?php if($balance->balance != '' || $balance->balance != null) {?>
                                        <div class="col-md-1"><p><?=$balance->balance;?>

                                            </p>

                                        </div>
                                        <div class="col-md-6">
                                            <p><?=$this->lang->line('you_will_be_charged');?>
                                                <span data-toggle="popover" data-placement="top" title="" data-original-title="A prospect is when a person gets your number, email where you are sending a message via Neighborty.You will only be charged for qualified leads.">
                                                 <i class="fa fa-question-circle" aria-hidden="true" style="font-size:20px"></i>
                                               </span>
                                            </p></div>
                                    <?php } else{ ?>
                                        <div class="col-md-2"> </div>
                                        <div class="col-md-4"><p><?=$this->lang->line('no_ppc');?></p>

                                        </div>
                                    <?php } ?>
                                    <div class="col-md-3 text-right"><a href="#" data-toggle="modal" data-target="#pop-method" class="btn btn-primary btn-md"><?=$this->lang->line('add_credit');?></a></div>
                                </div>
                            </div>
                            <div class="method-row" style="display: none">
                                <div class="row">
                                    <div class="col-md-3"><h2 class="side-block-title">Option Premium</h2></div>
                                    <?php //echo '<pre>';print_r($latest);?>
                                    <?php if(count($current) > 0){ ?>
                                        <div class="col-md-2"><p><?=ucfirst($current->name);?></p></div>
                                        <div class="col-md-4"><p>Découvrez nos offres</p></div>
                                    <?php } else{ ?>
                                        <div class="col-md-2"></p></div>
                                        <div class="col-md-4"><p>No package subscribed yet!</p></div>
                                    <?php }?>

                                    <!-- <table class="table table-history table-hover">
                                         <thead>
                                         <tr>
                                             <th>Name</th>
                                             <th>Total</th>
                                             <th>Remining</th>
                                         </tr>
                                         </thead>
                                         <tbody>
                                             <tr>
                                                 <td>List</td>
                                                 <td>10</td>
                                                 <td>5</td>
                                             </tr>
                                         </tbody>
                                     </table>-->

                                    <?php if(count($current) > 0){ ?>

                                        <div class="col-md-3 text-right"><a href="<?=site_url('/packages');?>" class="btn btn-primary btn-md">Change Package</a></div>

                                    <?php } else{ ?>

                                        <div class="col-md-3 text-right"><a href="<?=site_url('/packages');?>" class="btn btn-primary btn-md">Découvrez nos offres</a></div>

                                    <?php } ?>
                                    <!--<a href="#" class="btn btn-primary btn-md">Payment detail</a>-->
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="row">

                        <!--
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="alert alert-success"><p>Thanks you! Your Visa ending in 3366 has been added</p></div>

                            <div class="payment-side-block">
                                <h3 class="side-block-title">Billing Methods <a href="#" data-toggle="modal" data-target="#pop-method" class="btn btn-primary btn-md pull-right">Add Billing Method</a></h3>

                                <div class="add-payment-method">
                                    <p>visa ending in 3366 (Primary)</p>
                                    <div class="my-actions pull-right">
                                        <a href="#" class="action-btn" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                        <a href="#" class="action-btn" data-toggle="tooltip" data-placement="top" title="Remove"><i class="fa fa-close"></i></a>
                                    </div>
                                </div>

                                <p class="text-center" style="margin-bottom:0px;">You have not set up any billing methods yet.</p>
                            </div>
                        </div>

                        -->

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="payment-side-block">
                                <h3 class="side-block-title"><?=$this->lang->line('transactions');?></h3>
                                <div class="invoice-list transactions-list">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th><?=$this->lang->line('order_number');?></th>
                                            <!--<th>Credit Added</th>-->
                                            <th><?=$this->lang->line('payment_type');?></th>
                                            <th><?=$this->lang->line('4_digits');?></th>
                                            <th><?=$this->lang->line('total');?></th>
                                            <th style="text-align: center"><?=$this->lang->line('date_hour');?></th>

                                        </tr>
                                        </thead>
                                        <tbody>


                                        <?php if(count($bookings) > 0) { ?>

                                            <?php foreach($bookings as $booking):?>
                                                <tr>
                                                    <td>#<?=(string_padded_with_zero($booking->id)); // ;?></td>
                                                   <!-- <td><?=ucwords($booking->package_type);?></td>-->
                                                    <td><?=ucfirst($booking->brand);?></td>
                                                    <td><?=ucfirst($booking->last4);?></td>
                                                    <td><?=$booking->total_charges/100;?></td>
                                                    <td style="text-align: center"><?=date("F jS, Y", strtotime($booking->book_date));?></td>
                                                </tr>
                                            <?php endforeach;?>

                                        <?php } else{ ?>

                                            <tr>
                                                <td colspan="5" align="center"><?=$this->lang->line('no_transactions');?></td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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