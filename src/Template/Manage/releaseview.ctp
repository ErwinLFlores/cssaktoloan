
<div class="container-fluid">
    <div class="row ">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?= $this->Flash->render(); ?>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-header" style="padding:10px;">
                    <?=$this->Html->link('Back', ['controller' => 'manage', 'action' => 'loans']) ?> > View
                </div>
                <div class="col-md-12 card-content">
                    <br/>
                    <div class="col-md-1 col-xs-12"></div>
                    <div class="col-md-10 col-xs-12 no-padding" id="report001" style="border: 1px solid grey;width:98%;">
                        <div class="col-md-12" style="text-align:center;">
                            <h1> LOAN INFORMATION </h1>
                        </div>
                        <hr style="background-color: grey; margin:0px;border: 1px solid grey;"/>
                        <div id="head-family" class="col-md-12 no-padding">
                            <div class="col-md-2 no-padding" style="text-align:center;">
                                <div class="col-md-12 no-padding">
                                    <img src="/images/user.png" alt="User Photo" 
                                        style="width:150px;margin:10px 10px 5px 10px;border: 1px solid black;">
                                </div>
                            </div>
                            <div class="col-md-10" style="color:black; padding: 15px;">
                                <div class="col-md-4 no-padding" style="font-size:13px;">
                                    <div style="padding-top:5px;"><b><u>PERSONAL INFORMATION</u></b></div>

                                    <div class="col-md-12 no-padding">
                                        <div class="col-md-5 col-xs-12 no-padding">FULL NAME</div>
                                        <div class="col-md-7 col-xs-12 no-padding"><?=h($data->user->firstname);?> <?=h($data->user->lastname);?></div>
                                    </div>

                                    <div class="col-md-12 no-padding">
                                        <div class="col-md-5 col-xs-12 no-padding">BIRTHDATE</div>
                                        <div class="col-md-7 col-xs-12 no-padding">YYYY-MM-DD</div>
                                    </div>

                                    <div class="col-md-12 no-padding">
                                        <div class="col-md-5 col-xs-12 no-padding">AGE</div>
                                        <div class="col-md-7 col-xs-12 no-padding">25</div>
                                    </div>

                                    <div class="col-md-12 no-padding">
                                        <div class="col-md-5 col-xs-12 no-padding">GENDER</div>
                                        <div class="col-md-7 col-xs-12 no-padding">OTHER</div>
                                    </div>

                                    <div class="col-md-12 no-padding">
                                        <div class="col-md-5 col-xs-12 no-padding">CIVIL STATUS</div>
                                        <div class="col-md-7 col-xs-12 no-padding">SINGLE</div>
                                    </div>

                                    <div class="col-md-12 no-padding">
                                        <div class="col-md-5 col-xs-12 no-padding">CELLPHONE NO.</div>
                                        <div class="col-md-7 col-xs-12 no-padding">00000000000</div>
                                    </div>

                                    <div class="col-md-12 no-padding">
                                        <div class="col-md-5 col-xs-12 no-padding">WORK</div>
                                        <div class="col-md-7 col-xs-12 no-padding">SAMPLE WORK</div>
                                    </div>

                                    <div class="col-md-12 no-padding">
                                        <div class="col-md-5 col-xs-12 no-padding">COMPANY</div>
                                        <div class="col-md-7 col-xs-12 no-padding">SAMPLE COMPANY</div>
                                    </div>
                                </div>
                                <div class="col-md-4 no-padding" style="font-size:13px;">
                                    <div class="col-md-12 no-padding">
                                        <div style="padding-top:5px;"><b><u>RESIDENTIAL ADDRESS</u></b></div>

                                        <div class="col-md-12 no-padding">
                                            <div class="col-md-5 col-xs-12 no-padding">PUROK</div>
                                            <div class="col-md-7 col-xs-12 no-padding">IV</div>
                                        </div>

                                        <div class="col-md-12 no-padding">
                                            <div class="col-md-5 col-xs-12 no-padding">HOUSE NUMBER</div>
                                            <div class="col-md-7 col-xs-12 no-padding">SAMPLE HOUSE #</div>
                                        </div>

                                        <div class="col-md-12 no-padding">
                                            <div class="col-md-5 col-xs-12 no-padding">STREET</div>
                                            <div class="col-md-7 col-xs-12 no-padding">SAMPLE STREET</div>
                                        </div>

                                        <div class="col-md-12 no-padding">
                                            <div class="col-md-5 col-xs-12 no-padding">SITIO</div>
                                            <div class="col-md-7 col-xs-12 no-padding">N/A</div>
                                        </div>

                                        <div class="col-md-12 no-padding">
                                            <div class="col-md-5 col-xs-12 no-padding">BARANGAY</div>
                                            <div class="col-md-7 col-xs-12 no-padding">Balibago</div>
                                        </div>

                                        <div class="col-md-12 no-padding">
                                            <div class="col-md-5 col-xs-12 no-padding">CITY</div>
                                            <div class="col-md-7 col-xs-12 no-padding">Angeles City</div>
                                        </div>

                                        <div class="col-md-12 no-padding">
                                            <div class="col-md-5 col-xs-12 no-padding">RPOVINCE</div>
                                            <div class="col-md-7 col-xs-12 no-padding">Pampanga</div>
                                        </div>

                                        <div class="col-md-12 no-padding">
                                            <div class="col-md-5 col-xs-12 no-padding">REGION</div>
                                            <div class="col-md-7 col-xs-12 no-padding">III</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 no-padding" style="font-size:13px;">
                                    <div style="padding-top:5px;"><b><u>LOAN INFORMATION</u></b></div>

                                    <div class="col-md-12 no-padding">
                                        <div class="col-md-5 col-xs-12 no-padding">MONTHLY SALARY</div>
                                        <div class="col-md-7 col-xs-12 no-padding"><?=h($data->user->monthly_salary);?></div>
                                    </div>

                                    <div class="col-md-12 no-padding">
                                        <div class="col-md-5 col-xs-12 no-padding">LOAN AMOUNT</div>
                                        <div class="col-md-7 col-xs-12 no-padding"><?=h($data->loan_amount);?></div>
                                    </div>

                                    <div class="col-md-12 no-padding">
                                        <div class="col-md-5 col-xs-12 no-padding">LOAN INTEREST</div>
                                        <div class="col-md-7 col-xs-12 no-padding"><?=h($data->interest_per_annum);?></div>
                                    </div>

                                    <div class="col-md-12 no-padding">
                                        <div class="col-md-5 col-xs-12 no-padding">PAYMENT TERMS</div>
                                        <div class="col-md-7 col-xs-12 no-padding"><?=h($data->terms_of_payment);?></div>
                                    </div>

                                    <div class="col-md-12 no-padding">
                                        <div style="padding-top:5px;"><b><u>ID'S</u></b></div>

                                        <div class="col-md-12 no-padding">
                                            <div class="col-md-5 col-xs-12 no-padding">TYPE OF ID</div>
                                            <div class="col-md-7 col-xs-12 no-padding">SAMPLE-ID-TYPE</div>
                                        </div>

                                        <div class="col-md-12 no-padding">
                                            <div class="col-md-5 col-xs-12 no-padding">ID NUMBER</div>
                                            <div class="col-md-7 col-xs-12 no-padding">SAMPLE-ID-0001</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div style="color: black;" class="col-md-12">
                            <?php echo($contract); ?>
                        </div>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <div style="color: black;" class="col-md-12">
                            <?php $user_data = $this->request->session()->read('Auth.User'); ?>
                            <div class="col-md-6">
                                <div class="col-md-12" style="text-align:center;">
                                    <img src="/images/samplesigns/esign2.png" style="max-width: 200px;" alt="">
                                    <div>
                                        <span style="font-size: 16px;"> <?=h($data->user->firstname);?> <?=h($data->user->lastname);?></span> </br>
                                        <span style="font-size: 12px;"> <b>Borrower</b></span> </br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12" style="text-align:center;">
                                    <img src="/images/samplesigns/esign2.png" style="max-width: 200px;" alt="">
                                    <div>
                                        <span style="font-size: 16px;"> <?=h($user_data->firstname);?> <?=h($user_data->lastname);?></span> </br>
                                        <span style="font-size: 12px;"> <b>Approved By: </b></span> </br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <style>
                            table > thead > tr > th {
                                padding: 3px !important;
                                padding-top: 5px !important;
                                font-size: 12px;
                            }

                            table > tbody > tr > td {
                                padding: 3px !important;
                                font-size: 12px;
                            }
                        </style>
                        <hr style="background-color: grey; margin:0px;border: 1px solid grey;"/>
                        <hr style="background-color: grey; margin:0px;border: 1px solid grey;"/>
                        <div id="family-sectors" class="col-md-12 col-xs-12 no-padding" style="font-size:9px;text-align:center;">
                            <b><u>STATUS</u> &nbsp;</b>
                            0 = For Verification | 1 = For Contract Signing | 2 = For Release | 3 = Rejected | 4 = Approved | 5 = Done 
                        </div>
                    </div>
                    <div class="col-md-1 col-xs-12"></div>
                </div>
                <br/>
                <div class="col-md-12 card-footer">
                    <div class="col-md-6" style="text-align:left;">
                        <?= $this->Form->create('Add Category', ['type' => 'post', 'url' => '/manage/rejectloan/' . $data->id . '/release']); ?>
                            <input type="submit" id="submitbutton" class="btn btn-danger" value="Reject Loan">
                        <?= $this->Form->end(); ?>
                    </div>
                    <div class="col-md-6" style="text-align:right;">
                        <?= $this->Form->create('Add Category', ['type' => 'post', 'url' => '/manage/verifyrelease/' . $data->id . '/release']); ?>
                            <input type="submit" id="submitbutton" class="btn btn-info" value="Loan Released">
                        <?= $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>