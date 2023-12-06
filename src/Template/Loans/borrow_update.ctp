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
                                <input type="text" class="form-control" name="terms" id="terms" placeholder="Enter your Terms" value="<?php echo $loan['terms']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="lastName">Loan Amount</label>
                                <input type="text" class="form-control" name="max_loan_amount" id="max_loan_amount" placeholder="Enter your Loan Amount" value="<?php echo $loan['max_loan_amount']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="lastName">Date Request</label>
                                <input type="text" class="form-control" name="date" id="date" readonly  value="<?php echo $loan['created']; ?>">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>