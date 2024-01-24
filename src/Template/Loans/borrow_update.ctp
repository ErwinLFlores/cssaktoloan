<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Borrow Form
                    </div>
                    <div class="card-body">
                        <?=$this->Form->create('Update Borrow', [
                            // 'url' => ['action' => 'borrowAdd'],
                            'method' => 'post'
                        ]); ?>
                            <div class="form-group">
                                <label for="firstName">Terms</label>
                                <input type="text" class="form-control" name="terms_of_payment" id="terms_of_payment" placeholder="Enter your Terms (months)" value="<?=h($loan['terms_of_payment']); ?>">
                            </div>
                            <div class="form-group">
                                <label for="lastName">Loan Amount</label>
                                <input type="text" class="form-control" name="loan_amount" id="loan_amount" placeholder="Enter your Loan Amount" value="<?=h($loan['loan_amount']); ?>">
                            </div>
                            <div class="form-group">
                                <label for="lastName">Date Request</label>
                                <input type="text" class="form-control" name="date" id="date" readonly  value="<?=h($loan['created']->format('y-M-d H:i A')); ?>">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="/loans/borrow" type="button" style="color:black;" class="btn btn-warning">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



