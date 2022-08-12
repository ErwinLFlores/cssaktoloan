
<div class="container-fluid">
    <div class="row ">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?= $this->Flash->render(); ?>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-content">
                    <div style="padding:10px;">
                    <?=$this->Html->link('[Return] Roles', ['controller' => 'roles', 'action' => 'index']) ?> > Role Details
                    </div>
                    <div class="body">
                        <div class="row clearfix">
                            <div style="padding-top:10px;padding-left:25px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                                <label for="status" style="padding-left:10px;"><b>Status</b></label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-7 col-xs-5">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" style="background-color:transparent;" class="form-control" value="<?=h(($role->status == 1) ? 'Active' : 'Inactive'); ?>" maxlength="30" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div style="padding-top:10px;padding-left:25px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                                <label for="title" style="padding-left:10px;"><b>Title</b></label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-7 col-xs-5">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" style="background-color:transparent;" class="form-control" value="<?=h($role->title); ?>" maxlength="30" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div style="padding-top:10px;padding-left:25px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                                <label for="genaccess" style="padding-left:10px;"><b>General Access</b></label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-7 col-xs-5">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" style="background-color:transparent;" class="form-control" value="<?=h(($role->others == 1) ? 'Enabled' : 'Disabled'); ?>" maxlength="30" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br/>
            <div class="card">
                <div class="card-content">
                    <div style="padding:10px;">
                        <?php $active_role_id = $this->request->session()->read('Auth.User.role_id'); ?>
                        <?php $roles = $this->request->session()->read('Auth.User.roles'); ?>
                        <?php $editing_role_id = $role->id; ?>
                        <?php 
                            if (
                                ($active_role_id < $editing_role_id)
                                && ($roles['RolesAccess']['action_add'] === 1)
                            ):
                        ?>
                            <button type="button" 
                                class="btn btn-info btn-sm waves-effect m-r-20" 
                                data-toggle="modal" data-target="#defaultModal">
                                Add Role Access 
                            </button>
                        <?php else: ?>
                            <span>Role Access List</span>
                        <?php endif; ?>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Controller</th>
                                    <th>Index</th>
                                    <th>View</th>
                                    <th>Add</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                    <th>Print</th>
                                    <th>Reports</th>
                                    <th style="width:10%;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($role_access) > 0): ?>
                                    <?php foreach ($role_access as $key => $access): ?>
                                        <tr>
                                            <td><?=h(ucwords($access->controller_type));?></td>
                                            <td><?=h($access->action_index);?></td>
                                            <td><?=h($access->action_view);?></td>
                                            <td><?=h($access->action_add);?></td>
                                            <td><?=h($access->action_edit);?></td>
                                            <td><?=h($access->action_delete);?></td>
                                            <td><?=h($access->action_prints);?></td>
                                            <td><?=h($access->action_members);?></td>
                                            <td><?=h($access->action_reports);?></td>
                                            <td>
                                                <?php 
                                                    if (
                                                        ($active_role_id < $editing_role_id)
                                                        && ($roles['RolesAccess']['action_edit'] === 1)
                                                    ):
                                                ?>
                                                    <?=$this->Html->link($this->Html->tag('i', '', ['class'=>'fa fa-pencil-square-o']), 
                                                        ['controller' => 'RolesAccess', 'action' => 'edit', $access->id], 
                                                        ['class' => '', 'escape' => false]); ?>
                                                <?php endif; ?>
                                                <?php 
                                                    if (
                                                        ($active_role_id < $editing_role_id)
                                                        && ($roles['RolesAccess']['action_delete'] === 1)
                                                    ):
                                                ?>
                                                    <button style="background-color:transparent;color:red;padding:0px;padding-left:10px;" 
                                                        onclick='document.getElementById("deletelink").setAttribute("action", "/RolesAccess/delete/<?=h($access->id);?>")'  
                                                        data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i></button>  
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="9">This Role has no Active Access</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> 

    <div class="modal fade" id="defaultModal" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">
                        Add Role
                    </h4>
                </div>
                <?= $this->Form->create('Add Role Access', ['type' => 'post', 'url' => '/RolesAccess/add/' . $role->id]); ?>
                    <div class="modal-body">
                        <div class="row clearfix">
                            <div style="padding:10px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                                <label for="title" style="padding-left:10px;"><b>Controller</b></label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-7 col-xs-5">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="controller_type" class="form-control" value="" placeholder="Note: Case-sensitive" required maxlength="60" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" id="submitbutton" class="btn btn-info" value="SUBMIT">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">CLOSE</button>
                    </div>
                <?= $this->Form->end(); ?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header" style="padding: 15px;">
                    <span class="modal-title" id="staticModalLabel"><b> DELETE </b></span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding 15px;">
                    Permanently delete role access?
                </div>
                <div class="modal-footer">
                    <?= $this->Form->create('id', ['id'=>'deletelink','method'=>'post']);?>
                        <button type="submit" style="padding:5px;" class="btn btn-primary btn-xs"><small>Confirm</small></button>
                    <?= $this->Form->end();?>
                </div>
            </div>
        </div>
    </div>
</div>