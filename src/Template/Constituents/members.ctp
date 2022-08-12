
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

                    <div class="col-sm-6" style="padding-right:0px;">
                        <?= $this->Form->create('Add Search Item', ['type' => 'get']); ?>
                            <div class="col-sm-6 col-xs-12 no-padding" style="text-align:right">
                                <select name="scolumn" id="scolumn" class="form-control" placeholder="Search" 
                                    style="margin-bottom: 0px;padding:4px; width:250px;" required>
                                    <?php foreach($search_by_members->categories_items as $tag): ?>
                                        <option value="<?=h($tag->merge_value);?>"><?=h($tag->name);?>&nbsp;</option>
                                    <?php endforeach; ?>
                                </select> 
                            </div>
                            <div class="col-sm-6 col-xs-12 no-padding">
                                <div class="col-sm-9 col-xs-12 no-padding">
                                    <input type="text" name="search" id="search" 
                                        value="<?=h((!empty($searched_data)) ? $searched_data: '');?>"
                                        oninput="this.value = this.value.toUpperCase()"
                                        class="form-control" placeholder="Search...">
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
                    <div style="padding:10px;">
                        Registered Constituents Family Members
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width:14%;">Serial</th>
                                    <th style="width:10%;">FirstName</th>
                                    <th style="width:10%;">MiddleName</th>
                                    <th style="width:10%;">LastName</th>
                                    <th style="width:10%;">Relation</th>
                                    <th style="width:10%;">Gender</th>
                                    <th style="width:10%;">Birth Date</th>
                                    <th style="width:7%;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($families) > 0): ?>
                                    <?php foreach ($families as $family): ?>
                                        <tr>
                                            <td><?=h($family->registry_serial_key);?></td>
                                            <td><?=h($family->firstname);?></td>
                                            <td><?=h($family->middlename);?></td>
                                            <td><?=h($family->lastname);?></td>
                                            <td><?=h($family->relation);?></td>
                                            <td><?=h($family->gender);?></td>
                                            <td><?=h($family->birthdate->format('Y-M-d'));?></td>
                                            <td style="text-align:left;">
                                                <?php 
                                                    if (
                                                        (isset($logged_roles['Constituents']['action_index']))
                                                        && ($logged_roles['Constituents']['action_index'] === 1)
                                                    ) {  ?>
                                                        <?= $this->Form->create('Add Search Item', ['type' => 'get', 'url' => ['controller' => 'Constituents', 'action' => 'index', 1]]); ?>
                                                            <input type="hidden" value="registry_serial_key" name="scolumn"/>
                                                            <input type="hidden" value="<?=h($family->registry_serial_key);?>" name="search"/>
                                                            <button type="submit" class="btn btn-warning btn-sm waves-effect m-r-20"  
                                                                style="">
                                                                    MAIN
                                                            </button>
                                                        <?= $this->Form->end(); ?>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="9">No Data found.</td>
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

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header" style="padding: 15px;">
                <span class="modal-title" id="staticModalLabel"><b> ACTIVATE / DEACTIVATE </b></span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding 15px;">
                Update role status?
            </div>
            <div class="modal-footer">
                <?= $this->Form->create('id', ['id'=>'deletelink','method'=>'post']);?>
                    <button type="submit" style="padding:5px;" class="btn btn-primary btn-xs"><small>Confirm</small></button>
                <?= $this->Form->end();?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#scolumn').select2();
        <?php if (!empty($searched_column)) { ?>
            $('#scolumn').val('<?=h($searched_column);?>').trigger('change');
        <?php } ?>
    });
</script>