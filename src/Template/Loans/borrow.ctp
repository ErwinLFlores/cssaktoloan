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
                                                    // 0 = for verification
                                                    // 1 = for contract signing
                                                    // 2 = for release
                                                    // 3 = rejected
                                                    // 4 = approved
                                                    // 5 = done 

                                                    switch ($result['status']) {
                                                        case 0:
                                                            echo "<h6><span class='badge badge-primary'>for verification</span></h6>";
                                                            break;
                                                        case 1:
                                                            echo "<h6><span class='badge badge-warning'>for contract signing</span></h6>";
                                                            break;
                                                        case 2:
                                                            echo "<h6><span class='badge badge-info'>for release</span></h6>";
                                                            break;
                                                        case 3:
                                                            echo "<h6><span class='badge badge-danger'>Rejected</span></h6>";
                                                            break;
                                                        case 4:
                                                            echo "<h6><span class='badge badge-success'>Approved</span></h6>";
                                                            break;
                                                        case 5:
                                                            echo "<h6><span class='badge badge-secondary'>Done</span></h6>";
                                                            break;
                                                        // add more cases as needed
                                                        default:
                                                        echo "";
                                                    }

                                                ?>
                                            </td>
                                                
                                            <td><?php echo $result['created']; ?></td>
                                            <td>
                                                <?php if ($result['status'] == 0) { ?>
                                                    <a href="/loans/borrowUpdate/<?php echo $result['id']; ?>" class="btn btn-primary" >Update</a>
                                                    <a href="/loans/borrowDelete/<?php echo $result['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                                <?php } else { ?>
                                                    <a href="/loans/statementofaccount/<?php echo $result['id']; ?>" class="btn btn-secondary" >Statement of Account</a>
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