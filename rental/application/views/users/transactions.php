<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-sidebar-closed-hide-logo">
  <?php $this->load->view('dashboard/dashboard-header'); ?>
  <div class="clearfix"></div>
  <div class="page-container">
    <?php $this->load->view('dashboard/dashboard-sidebar'); ?>
    <div class="page-content-wrapper">
      <div class="page-content" style="min-height:634px">           
        <div class="row">
          <div class="col-md-12">
            <div class="portlet light bordered">
              <div class="portlet-title">
                <div class="caption" style="width:100%">
                  <h3 style="display:inline" class="form-section"> Transaction History</h3>
                  <?php //echo '<pre>';print_r($funds);?>
                  <?php 
                  $availble_amount = ($funds[0]->a_credits-$funds[0]->a_debits);
                  $pending_amount  = ($funds[0]->p_credits-$funds[0]->p_debits);?>
                  <div class="pull-right">
                   <button type="button" class="btn btn-default">Available : <?=($availble_amount);?></button>
                   <button type="button" class="btn btn-default">Pending : <?=($pending_amount);?></button>
                   <?php if($availble_amount != 0){ ?>
                   <button type="button" class="btn btn-info" data-toggle="modal" data-target="#widthdraw">Withdraw</button>
                   <?php } ?>
                 </div>
                 <div class="modal fade" id="widthdraw" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Withdraw Amount</h4>
                      </div>
                      <div id="widthdraw_notice" class="alert alert-warning" style="display:none">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Sorry!  </strong> <label> Your Withdrawal Amount can not acceed your available amount.</label>
                      </div>
                      <div id="widthdraw_success" class="alert alert-success" style="display:none">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Congratulation!  </strong> <label> Your Withdrawal Amount has been initiated.</label>
                      </div>
                      <div class="modal-body">
                        <label>Total Available Amount : $<?=$availble_amount?></label> <br />
                        <form name="widthdraw_form" id="widthdraw_form">
                          <div class="form-group">
                            <label for="recipient-name" class="control-label">Amount:</label>
                            <input type="text" class="form-control" id="withdraw_amount" name="withdraw_amount">
                          </div>
                          <div class="form-group">
                            <label for="recipient-name" class="control-label">Paypal Email:</label>
                            <input type="text" class="form-control" id="recipient_email" name="recipient_email">
                          </div>
                          <div class="form-group">
                            <label for="message-text" class="control-label">Description:</label>
                            <textarea class="form-control" id="message_box" name="message_box"></textarea>
                          </div>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="withdraw_amount()">Withdraw</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tabbable tabs-left">
                <ul class="nav nav-tabs" role="tablist">
                  <li role="presentation" class="active">
                   <a href="#all" aria-controls="all" onclick="getTrasnactions(this.id)" id="ALL"  role="tab" data-toggle="tab">All</a>
                 </li>
                 <li role="presentation">
                  <a href="#DAY" onclick="getTrasnactions(this.id)" id="DAY" aria-controls="daily" role="tab" data-toggle="tab">Daily</a>
                </li>
                <li role="presentation">
                 <a href="#WEEK" onclick="getTrasnactions(this.id)" id="WEEK" aria-controls="weekly" role="tab" data-toggle="tab">Weekly</a>
               </li>
               <li role="presentation">
                <a href="#MONTH" onclick="getTrasnactions(this.id)" id="MONTH" aria-controls="monthly" role="tab" data-toggle="tab">Monthly</a>
              </li>
            </ul>
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane fade in active" id="all">
                <div class="portlet-body">
                  <div class="invoice">
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="table-responsive" style="overflow: hidden !important;">
                          <table id="transcation_div" class="table table-striped table-bordered table-hover">
                            <?php if ($transactions) { ?>
                            <thead class="flip-content">
                              <tr>
                                <th>
                                  BID
                                </th>
                                <th>
                                  Type
                                </th>
                                <th>
                                  Description
                                </th>
                                <th>
                                  Amount
                                </th>
                                <th>
                                  Status
                                </th>
                                <th>
                                  Process date
                                </th>
                                <th>
                                  Tractarians date
                                </th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach ($transactions as $transaction) { ?>
                              <tr>
                                <td>
                                  <?= $transaction->booking_id; ?>
                                </td>
                                <td>
                                  <?= $transaction->transaction_type; ?>
                                </td>
                                <td style="width:490px;">
                                  <?= $transaction->description; ?>
                                </td>
                                <td>
                                  <?php
                                  if ($transaction->transaction_type == 'Debit') {
                                    echo " - Pkr " . $transaction->amount;
                                  } else {
                                    echo "Pkr " . $transaction->amount;
                                  }
                                  ?>
                                </td>
                                <td>
                                  <?= ucwords($transaction->status); ?>
                                </td>
                                <td>
                                  <?= $transaction->process_date; ?>
                                </td>
                                <td>
                                  <?= $transaction->date_time; ?>
                                </td>
                              </tr>
                              <?php
                            }
                          } else {
                            echo "<h2> No record found</h2>";
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div role="tabpanel" class="tab-pane fade" id="DAY">
           <div id="transcation_div"></div>    
         </div>
         <div role="tabpanel" class="tab-pane fade" id="WEEK">
           <div id="transcation_div"></div> 
         </div>
         <div role="tabpanel" class="tab-pane fade" id="MONTH">
           <div id="transcation_div"></div>
         </div>
       </div>
     </div>
   </div>
 </div>
</div>
</div>
</div>
</div>
</div>
<!-- END CONTAINER -->