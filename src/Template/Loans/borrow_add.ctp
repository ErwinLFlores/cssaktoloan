<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Borrow Form
                    </div>
                    <div class="card-body">
                        <?=$this->Form->create('Save Borrow', [
                            // 'url' => ['action' => 'borrowAdd'],
                            'method' => 'post'
                        ]); ?>
                            <div class="form-group">
                                <label for="firstName">Terms</label>
                                <input type="text" class="form-control" name="terms_of_payment" id="terms_of_payment" placeholder="Enter your Terms">
                            </div>
                            <div class="form-group">
                                <label for="lastName">Loan Amount</label>
                                <input type="text" class="form-control" name="loan_amount" id="loan_amount" placeholder="Enter your Loan Amount">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>