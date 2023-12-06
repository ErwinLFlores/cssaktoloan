<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Statement of Account as of <?php echo date('F, d Y'); ?>
                </div>
                <div class="card-body">

                    <h3>Past Due</h3>
                    <table class="table">
                        <tbody>
                            <tr>

                                <td width="55%"></td>
                                <td>Principal</td>
                                <td style="text-align: right;">0.00</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Interest</td>
                                <td style="text-align: right;">0.00</td>
                            </tr>
                        </tbody>
                    </table>

                    <h3>Current Due</h3>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td width="55%"></td>
                                <td>Principal</td>
                                
                                <td style="text-align: right;">
                                    <?php 
                                        $current_due = abs($loan['loan_amount']) / abs($loan['terms_of_payment']);
                                        echo number_format($current_due, 2);
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Interest (3.5%)</td>
                                <td style="text-align: right;">
                                    <?php 
                                        $current_interest_loan = abs($loan['loan_amount']) * 3.5;
                                        $current_interest = $current_interest_loan / 100;
                                        echo number_format($current_interest, 2);
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table">
                        <tbody>
                            <tr>
                                <td width="55%"></td>
                                <td><b>Total Amount</b></td>
                                <td style="text-align: right;">
                                <b>
                                    <?php
                                        $total_amount = $current_due + $current_interest;
                                        echo number_format($total_amount, 2);
                                    ?>
                                </b>
                                </td>
                            </tr>

                            <tr>
                                <td></td>
                                <td><b>Amount Not Yet Due</b></td>
                                <td style="text-align: right;">0.00</td>
                            </tr>

                            <tr>
                                <td></td>
                                <td style="padding-left: 100px;">Principal</td>
                                <td style="text-align: right;">0.00</td>
                            </tr>

                            <tr>
                                <td></td>
                                <td style="padding-left: 100px;">Interest</td>
                                <td style="text-align: right;">0.00</td>
                            </tr>

                            <tr>
                                <td></td>
                                <td><b>Total Amount of Obligation</b></td>
                                <td style="text-align: right;">
                                <b>
                                    <?php
                                        $total_amount_obligation = $total_amount * abs($loan['terms_of_payment']);
                                        echo number_format($total_amount_obligation, 2);
                                    ?>
                                </b>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Created Payment
                </div>
                <div class="card-body">

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" width="80%">Date</th>
                                <th scope="col">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total_payment = 0; ?>
                            <?php foreach($loan_payments as $payments) { ?>
                                <tr>
                                    <td>
                                        <?php echo date("Y-m-d", strtotime($payments['created'])); ?>
                                    </td>
                                    <td style="text-align: right;">
                                        <?php echo number_format($payments['amount'], 2); ?>
                                    </td>
                                </tr>
                                <?php $total_payment += $payments['amount']; ?>
                            <?php } ?>
                            

                            <tr>
                                <td style="text-align: right;"><b>Total Payment</b></td>
                                <td style="text-align: right;">
                                    <b><?php echo number_format($total_payment, 2); ?></b>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>