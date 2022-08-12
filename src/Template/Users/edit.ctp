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
                        <?=$this->Html->link('Users', ['controller' => 'users', 'action' => 'index']) ?> > Update 
                    </h4>
                    <?php $logged_roles = $this->request->session()->read('Auth.User.roles'); ?>
                    <?php $logged_role_id = $this->request->session()->read('Auth.User.role_id'); ?>
                    <?php $isDisabled = (
                        ($logged_roles['Users']['action_edit'] === 1)
                            && ($user->role_id >= $logged_role_id)
                        ) ? '': 'disabled readonly'; ?>

                    <div class="card-body">
                        <?php $logged_role_id = $this->request->session()->read('Auth.User.role_id'); ?>
                        <?= $this->Form->create('Add User', ['type' => 'post', 'url' => '/users/edit/' . $user->id]); ?>
                            <div class="modal-body">
                                <div class="row clearfix">
                                    <div style="padding:10px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                                        <label for="username" style="padding-left:10px;"><b>Username</b></label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-7 col-xs-5">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="username" class="form-control" <?=h($isDisabled); ?> value="<?=h($user->username);?>" maxlength="30" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div style="padding:10px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                                        <label for="password" style="padding-left:10px;"><b>Password</b></label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-7 col-xs-5">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="password" name="password" class="form-control" <?=h($isDisabled); ?> value="" maxlength="100">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div style="padding:10px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                                        <label for="role_id" style="padding-left:10px;"><b>Role</b></label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-7 col-xs-5">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <select name="role_id" <?=h($isDisabled); ?> id="role_id">
                                                    <?php 
                                                        if ($user->role_id === 1) { ?>
                                                            <option value="1" selected>Super Admin</option>
                                                        <?php } else {
                                                            foreach ($roles_list as $role): 
                                                                if ($logged_role_id <= $role->id) {
                                                        ?>
                                                            <option value="<?=h($role->id); ?>" 
                                                                <?=h(($user->role_id === $role->id) ? 'selected' : '');?>
                                                            >
                                                                <?=h($role->title); ?>
                                                            </option>
                                                        <?php } endforeach; }?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div style="padding:10px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                                        <label for="firstname" style="padding-left:10px;"><b>First Name</b></label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-7 col-xs-5">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="firstname" class="form-control" <?=h($isDisabled); ?> value="<?=h($user->firstname);?>" maxlength="50" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div style="padding:10px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                                        <label for="lastname" style="padding-left:10px;"><b>Last Name</b></label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-7 col-xs-5">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="lastname" class="form-control" <?=h($isDisabled); ?> value="<?=h($user->lastname);?>" maxlength="50" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div style="padding:10px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                                        <label for="email" style="padding-left:10px;"><b>Email</b></label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-7 col-xs-5">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="email" name="email" class="form-control" <?=h($isDisabled); ?> value="<?=h($user->email);?>" maxlength="60" required>
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