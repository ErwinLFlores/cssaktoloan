
<div class="container-fluid">
    <div class="row ">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?= $this->Flash->render(); ?>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-content">
                    <div style="padding:10px;">
                        <?php $roles = $this->request->session()->read('Auth.User.roles'); ?>
                        <?php 
                            if (
                                (isset($roles['Categories']['action_add']))
                                && ($roles['Categories']['action_add'] === 1)
                            ):
                        ?>
                            <button type="button" 
                                class="btn btn-info btn-sm waves-effect m-r-20" 
                                data-toggle="modal" data-target="#defaultModal">
                                Add Category
                            </button> &nbsp;
                        <?php endif; ?>
                    </div>
                    <div class="body table-responsive">
                        <?php $logged_roles = $this->request->session()->read('Auth.User.roles'); ?>

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>STATUS</th>
                                    <th>Title</th>
                                    <th>Merge Code</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($categories) > 0): ?>
                                    <?php foreach ($categories as $key => $cat): ?>
                                        <tr>
                                            <td><?=h($cat->id);?></td>
                                            <td><?=h( ($cat->status) ? 'ACTIVE' : 'INACTIVE');?></td>
                                            <td><?=h($cat->name);?></td>
                                            <td><i><?=h($cat->merge_value);?></i></td>
                                            <td>
                                                <?=$this->Html->link($this->Html->tag('i', '', ['class'=>'fa fa-pencil-square-o']), 
                                                    ['controller' => 'CategoriesItems', 'action' => 'index', $cat->id], 
                                                    ['class' => '', 'escape' => false]); ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5">No Categories found.</td>
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
                        Add Category
                    </h4>
                </div>
                <?= $this->Form->create('Add Category', ['type' => 'post', 'url' => '/categories/add']); ?>
                    <div class="modal-body">
                        <div class="row clearfix">
                            <div style="padding:10px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                                <label for="name" style="padding-left:10px;"><b>Name</b></label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-7 col-xs-5">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="name" class="form-control" placeholder="Case Sensitive" value="" maxlength="50" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row clearfix">
                            <div style="padding:10px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                                <label for="merge_value" style="padding-left:10px;"><b>Merge Value</b></label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-7 col-xs-5">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="merge_value" class="form-control" placeholder="Case Sensitive" value="" maxlength="50" required>
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