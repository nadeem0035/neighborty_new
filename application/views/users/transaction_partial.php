<div class="portlet-body">
    <div class="invoice">
        <div class="row">
            <div class="col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
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
                                        echo " - $" . $transaction->amount;
                                    } else {
                                        echo "$" . $transaction->amount;
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
                        echo "<p style='margin-left:2%;margin-top:1%'> No record found</p>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</div>