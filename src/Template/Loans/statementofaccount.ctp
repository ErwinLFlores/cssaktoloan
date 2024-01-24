<div class="container mt-1">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a href="/loans/borrow"  class="btn btn-warning" style="color:black;">Back to List</a>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loanModal">
                Open Loan Info
            </button>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Statement of Account as of <?php echo date('F d, Y H:i A'); ?></h4>
                </div>
                <div class="card-body">
                    <h5>Past Due</h5>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td width="40%"></td>
                                <td width="45%">Principal</td>
                                <td>₱ <?=h(number_format($computations['past_due_principal'], 2));?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Interest (<?=h($computations['past_due_interest_rate']);?>%)</td>
                                <td>₱ <?=h(number_format($computations['past_due_interest'], 2));?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Penalty (<?=h($computations['penalty_interest'] * 100);?>%)</td>
                                <td>₱ <?=h(number_format($computations['past_due_penalty'], 2));?></td>
                            </tr>
                        </tbody>
                    </table>

                    <h5>Current Due</h5>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td width="40%"></td>
                                <td width="45%">Principal</td>
                                <td>₱ <?=h(number_format($computations['current_due_principal'], 2));?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Interest (<?=h($computations['current_due_interest_rate']);?>%)</td>
                                <td>₱ <?=h(number_format($computations['current_due_interest'], 2));?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><b>Total Amount to be Paid</b></td>
                                <td><b>₱ <?=h(number_format($computations['total_current_amount'], 2));?></b></td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <h5>-</h5>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td width="40%"></td>
                                <td width="45%"><b>Amount Not Yet Due</b></td>
                                <td>₱ <?=h(number_format($computations['not_yet_due_total'], 2));?></td>
                            </tr>

                            <tr>
                                <td></td>
                                <td>Principal</td>
                                <td>₱ <?=h(number_format($computations['not_yet_due_principal'], 2));?></td>
                            </tr>

                            <tr>
                                <td></td>
                                <td>Interest (<?=h($computations['not_yet_due_interest_rate']);?>%)</td>
                                <td>₱ <?=h(number_format($computations['not_yet_due_interest'], 2));?></td>
                            </tr>

                            <tr>
                                <td></td>
                                <td>Penalties (<?=h($computations['penalty_interest'] * 100);?>%)</td>
                                <td>₱ <?=h(number_format($computations['past_due_penalty'], 2));?></td>
                            </tr>


                            <tr>
                                <td></td>
                                <td><b>Total Amount of Obligation (unpaid)</b></td>
                                <td>
                                    <b>₱ <?=h(number_format($computations['total_obligation_amount'], 2));?></b>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Created Payments</h4>
                </div>
                <div class="card-body">

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="text-align:center;" scope="col" width="80%">Date</th>
                                <th style="text-align:center;" scope="col">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($loan_payments->isEmpty()) { ?>
                                <tr>
                                    <td colspan="2"> <i> No Payment(s) has been made </i></td>
                                </tr>
                            <?php } else { ?>
                                <?php foreach($loan_payments as $payments) { ?>
                                    <tr>
                                        <td>
                                            <?php echo date("Y-M-d H:i A", strtotime($payments['created'])); ?>
                                        </td>
                                        <td style="text-align: right;">
                                            <?php echo number_format($payments['loan_total_payment'], 2); ?>
                                        </td>
                                    </tr>
                                <?php } ?>

                                <tr>
                                    <td style="text-align: right;"><b>Total Payment</b></td>
                                    <td style="text-align: right;">
                                        <b><?=h(number_format($computations['total_payments'], 2)); ?></b>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="loanModal" tabindex="-1" role="dialog" aria-labelledby="loanModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                    <h5 class="modal-title" id="loanModalLabel">Loan Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Total Loan Amount</td>
                            <td>₱ <?=h(number_format($computations['total_loan_amount'], 2)); ?></td>
                        </tr>
                        <tr>
                            <td>Loan Terms</td>
                            <td><?=h($computations['loan_terms']); ?> months</td>
                        </tr>
                        <tr>
                            <td>Annual Interest Rate</td>
                            <td><?=h($computations['annual_interest_rate']); ?>%</td>
                        </tr>
                        <tr>
                            <td>Penalty Interest Rate</td>
                            <td><?=h($computations['penalty_interest'] * 100); ?>%</td>
                        </tr>
                        <tr>
                            <td>Request Date</td>
                            <td><?=h($loan->created->format('Y-M-d H:i A')); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>