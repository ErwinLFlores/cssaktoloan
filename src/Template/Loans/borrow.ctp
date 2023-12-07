<link href="/select2/select2.min.css" rel="stylesheet" />
<script src="/select2/select2.min.js"></script>
<div class="container-fluid">
    <div class="row ">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?= $this->Flash->render(); ?>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-sm-6 no-padding">
                        
                    </div>

                    <div class="col-sm-6" style="padding-right:0px;">
                        <?= $this->Form->create('Add Search Item', ['type' => 'get']); ?>
                        <div class="col-sm-6 col-xs-12 no-padding" style="text-align:right">

                        </div>
                        <div class="col-sm-6 col-xs-12 no-padding">
                            <div class="col-sm-9 col-xs-12 no-padding">
                                <input type="text" name="search" id="search" value="<?= h((!empty($searched_data)) ? $searched_data : ''); ?>" oninput="this.value = this.value.toUpperCase()" class="form-control" placeholder="Search...">
                            </div>
                            <div class="col-sm-3 col-xs-12 no-padding">
                                <button id="btn-search" type="submit" style="vertical-align:middle;border-radius: 40px;padding: 4px 8px 4px 8px;margin:7px 0px 0px 5px;">
                                    <i class="fa fa-search"></i> <small>Search</small>
                                    <div class="ripple-container"></div>
                                </button>
                            </div>
                        </div>
                        <?= $this->Form->end(); ?>
                    </div>
                </div>
                <div class="card-content">
                    <div style="padding:10px;"></div>
                    <div class="body table-responsive ">
                        <table class="table table-striped ">
                            <thead>
                                <tr>
                                <tr>
                                    <td>Terms</td>
                                    <td>Loan</td>
                                    <td>Status</td>
                                    <td>Created</td>
                                    <td>Action</td>
                                </tr>
                                </tr>
                            </thead>
                            <tbody>

                                <?php if (count($data) > 0) : ?>
                                    <?php foreach ($data as $result) : ?>
                                        <tr>
                                            <td><?php echo $result['terms_of_payment']; ?></td>
                                            <td><?php echo number_format($result['loan_amount'], 2); ?></td>
                                            <td>
                                                <?php 
                                                    $statuses = [
                                                        ['lightsteelblue', 'For Verification'],
                                                        ['antiquewhite', 'For Contract Signing'],
                                                        ['lightpink', 'For User Contract Agreement'],
                                                        ['blue; color: white', 'For Release'],
                                                        ['lightsalmon', 'Rejected'],
                                                        ['lightgreen', 'Approved and Released'],
                                                        ['grey; color: white', 'Done'],
                                                        ['orange', 'Cancelled']
                                                    ];
                                                ?>
                                                    <h6><span class='badge' style="background-color: <?=h($statuses[$result['status']][0]);?>;"> <?=h($statuses[$result['status']][1]);?></span></h6>
                                            </td>
                                                
                                            <td><?php echo $result['created']->format('y-M-d H:i A'); ?></td>
                                            <td>
                                                <?php if ($result['status'] == 0) { ?>
                                                    <a href="/loans/borrowUpdate/<?php echo $result['id']; ?>" class="btn btn-xs btn-success" >Update</a>
                                                    <a href="/loans/borrowDelete/<?php echo $result['id']; ?>" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                                <?php } else { ?>
                                                    <a href="/loans/statementofaccount/<?php echo $result['id']; ?>" class="btn btn-xs  btn-primary" >View SOA</a>
                                                    <?php if ($result['status'] == 2) { ?>
                                                        <a href="/loans/viewcontract/<?php echo $result['id']; ?>/agreement" style="color: black;" class="btn btn-xs btn-warning" >View Contract</a>
                                                    <?php } ?>
                                                <?php } ?>
                                            </td>
                                        </tr>

                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="8">No Data found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        $('#scolumn').select2();
        <?php if (!empty($searched_column)) { ?>
            $('#scolumn').val('<?= h($searched_column); ?>').trigger('change');
        <?php } ?>
    });
</script>