
<div class="container-fluid">
    <div class="row ">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?= $this->Flash->render(); ?>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-content">
                    <div style="padding:10px;">
                        Users
                    </div>
                    <div class="body table-responsive">
                        <?php $logged_roles = $this->request->session()->read('Auth.User.roles'); ?>
                        <?php $logged_role_id = $this->request->session()->read('Auth.User.role_id'); ?>

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Username</th>
                                    <th>Type</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th style="width:12%;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $value): ?>
                                    <tr>
                                        <td><?=h(($value->status == 1) ? 'Active' : 'Inactive');?></td>
                                        <td><?=h($value->username);?></td>
                                        <td><?=h($value->role->title);?></td>
                                        <td><?=h(ucwords($value->firstname . " " . $value->lastname));?></td>
                                        <td><?=h($value->email);?></td>
                                        <td style="text-align:left;">
                                            <?php 
                                                if (
                                                    (isset($logged_roles['Users']['action_edit']))
                                                    && ($logged_roles['Users']['action_edit'] === 1)
                                                ) {  ?>
                                                    <?php if ($value->status === 1) {  ?>
                                                        <?=$this->Html->link($this->Html->tag('i', '', ['class'=>'fa fa-pencil-square-o']), 
                                                            ['action' => 'edit', $value->id], ['class' => '', 'escape' => false]); ?>
                                                    <?php } ?>
                                            <?php } ?>

                                            <?php 
                                                if (
                                                    (isset($logged_roles['Users']['action_edit']))
                                                    && ($logged_roles['Users']['action_edit'] === 1)
                                                ) {  ?>
                                                
                                            <button style="background-color:transparent;color:orange;padding:0px;padding-left:10px;" 
                                                onclick='document.getElementById("deletelink").setAttribute("action", "/users/delete/<?=h($value->id);?>")'  
                                                data-toggle="modal" data-target="#deleteModal"><i class="fa fa-star-half-o"></i></button>  
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
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
                <?= $this->Form->create($roles, ['type' => 'post', 'url' => '/roles/add']); ?>
                    <div class="modal-body">
                        <div class="row clearfix">
                            <div style="padding:10px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                                <label for="title" style="padding-left:10px;"><b>Title</b></label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-7 col-xs-5">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="title" class="form-control" value="" required maxlength="30" required>
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