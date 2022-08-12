<!-- src/Template/Users/add.ctp -->

<div class="container-fluid" >
    <div class="row ">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?= $this->Flash->render(); ?>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-content">
                    <h4 style="padding:20px 20px 0px 25px;">
                        <?=$this->Html->link('Roles Access', ['controller' => 'RolesAccess', 'action' => 'index', $roles_access->role_id]) ?> > Update 
                    </h4>
                    <?php $logged_roles = $this->request->session()->read('Auth.User.roles'); ?>
                    <?php $logged_role_id = $this->request->session()->read('Auth.User.role_id'); ?>

                    <div class="card-body">
                        <?php $logged_role_id = $this->request->session()->read('Auth.User.role_id'); ?>
                        <?= $this->Form->create('Add User', ['type' => 'post', 'url' => '/RolesAccess/edit/' . $roles_access->id]); ?>
                            <div class="modal-body">
                                <div class="row clearfix">
                                    <div style="padding:10px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                                        <label for="username" style="padding-left:10px;"><b>Controller</b></label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-7 col-xs-5">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <p style="color:black;font-weight:bold;font-size:18px;margin-top:5px;"><?=h($roles_access->controller_type);?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div style="padding:10px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                                        <label for="action_index" style="padding-left:10px;"><b>Action Index</b></label>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <select name="action_index" id="action_index">
                                                    <option value="0" <?=h(($roles_access->action_index === 0) ? 'selected' : ''); ?>>Disabled</option>
                                                    <option value="1" <?=h(($roles_access->action_index === 1) ? 'selected' : ''); ?>>Enabled</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div style="padding:10px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                                        <label for="action_view" style="padding-left:10px;"><b>Action View</b></label>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <select name="action_view" id="action_view">
                                                    <option value="0" <?=h(($roles_access->action_view === 0) ? 'selected' : ''); ?>>Disabled</option>
                                                    <option value="1" <?=h(($roles_access->action_view === 1) ? 'selected' : ''); ?>>Enabled</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div style="padding:10px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                                        <label for="action_add" style="padding-left:10px;"><b>Action Add</b></label>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <select name="action_add" id="action_add">
                                                    <option value="0" <?=h(($roles_access->action_add === 0) ? 'selected' : ''); ?>>Disabled</option>
                                                    <option value="1" <?=h(($roles_access->action_add === 1) ? 'selected' : ''); ?>>Enabled</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div style="padding:10px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                                        <label for="action_edit" style="padding-left:10px;"><b>Action Edit</b></label>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <select name="action_edit" id="action_edit">
                                                    <option value="0" <?=h(($roles_access->action_edit === 0) ? 'selected' : ''); ?>>Disabled</option>
                                                    <option value="1" <?=h(($roles_access->action_edit === 1) ? 'selected' : ''); ?>>Enabled</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div style="padding:10px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                                        <label for="action_delete" style="padding-left:10px;"><b>Action Delete</b></label>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <select name="action_delete" id="action_delete">
                                                    <option value="0" <?=h(($roles_access->action_delete === 0) ? 'selected' : ''); ?>>Disabled</option>
                                                    <option value="1" <?=h(($roles_access->action_delete === 1) ? 'selected' : ''); ?>>Enabled</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div style="padding:10px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                                        <label for="action_prints" style="padding-left:10px;"><b>Action Print</b></label>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <select name="action_prints" id="action_prints">
                                                    <option value="0" <?=h(($roles_access->action_prints === 0) ? 'selected' : ''); ?>>Disabled</option>
                                                    <option value="1" <?=h(($roles_access->action_prints === 1) ? 'selected' : ''); ?>>Enabled</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div style="padding:10px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                                        <label for="action_members" style="padding-left:10px;"><b>Action Members View</b></label>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <select name="action_members" id="action_members">
                                                    <option value="0" <?=h(($roles_access->action_members === 0) ? 'selected' : ''); ?>>Disabled</option>
                                                    <option value="1" <?=h(($roles_access->action_members === 1) ? 'selected' : ''); ?>>Enabled</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div style="padding:10px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                                        <label for="action_reports" style="padding-left:10px;"><b>Action Reports</b></label>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <select name="action_reports" id="action_reports">
                                                    <option value="0" <?=h(($roles_access->action_reports === 0) ? 'selected' : ''); ?>>Disabled</option>
                                                    <option value="1" <?=h(($roles_access->action_reports === 1) ? 'selected' : ''); ?>>Enabled</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <?php if (empty($isDisabled)): ?>
                                    <input type="submit" id="submitbutton" class="btn btn-info" value="SUBMIT">
                                <?php endif; ?>
                            </div>
                        <?= $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>