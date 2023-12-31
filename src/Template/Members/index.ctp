
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
                        <?php $logged_roles = $this->request->session()->read('Auth.User.roles'); ?>
                    </div>

                    <div class="col-sm-6" style="padding-right:0px; float: right;">
                        <?= $this->Form->create('Add Search Item', ['type' => 'get']); ?>
                            <div class="col-sm-6 col-xs-12 no-padding"></div>
                            <div class="col-sm-6 col-xs-12 no-padding">
                                <div class="col-sm-9 col-xs-12 no-padding">
                                    <input type="text" name="search" id="search" 
                                        value="<?=h((!empty($searched_data)) ? $searched_data: '');?>"
                                        oninput="this.value = this.value.toUpperCase()"
                                        class="form-control" placeholder="Search Name or Email">
                                </div>
                                <div class="col-sm-3 col-xs-12 no-padding">
                                    <button id="btn-search" type="submit" 
                                            style="vertical-align:middle;border-radius: 40px;padding: 4px 8px 4px 8px;margin:7px 0px 0px 5px;"> 
                                            <i class="fa fa-search"></i> <small>Search</small>
                                        <div class="ripple-container"></div>
                                    </button>
                                </div>
                            </div>
                        <?= $this->Form->end(); ?>
                    </div>
                </div>
                <div class="card-content">
                    <div class="body table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width:10%;">Status</th>
                                    <th style="width:20%;">Name</th>
                                    <th style="width:20%;">Email</th>
                                    <th style="width:15%;">Total Contributions</th>
                                    <th style="width:15%;">Contributions Count</th>
                                    <th style="width:20%;">Since</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($members) > 0): ?>
                                    <?php foreach ($members as $member): ?>
                                        <tr>
                                            <td><?=h(ucwords($member->status));?></td>
                                            <td><?=h($member->firstname);?> <?=h($member->lastname);?></td>
                                            <td><?=h($member->email);?></td>
                                            <td>PHP <?=h(sprintf("%.2f", $member->total_contribution_amount));?></td>
                                            <td><?=h($member->total_contribution_count);?></td>
                                            <td><?=h($member->created->format('Y-M-d'));?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="8">No Data found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <?php if($isPaginated): ?>
                <div class="col-sm-12 float-right" id="paginator" style="padding:10px;">
                    <div class="paginator" style="float:right;">
                        <ul class="pagination pagination-primary">
                            <?= $this->Paginator->first('<< '.__('first')); ?>
                            <?= $this->Paginator->prev('< '.__('previous')); ?>
                            <?= $this->Paginator->numbers(); ?>
                            <?= $this->Paginator->next(__('next').' >'); ?>
                            <?= $this->Paginator->last(__('last').' >>'); ?>
                        </ul>
                        <br/>
                        <small style="color:gray;">
                            <?= $this->Paginator->counter(['format' => 
                                __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')
                            ]); ?>
                        </small>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div> 
</div>