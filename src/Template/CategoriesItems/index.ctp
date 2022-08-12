
<div class="container-fluid">
    <div class="row ">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?= $this->Flash->render(); ?>
        </div>
        <div class="col-lg-6 col-md-9 col-sm-6 col-xs-12">
            <div class="card">
                <div class="card-content">
                    <div style="padding:10px;">
                    <?=$this->Html->link('[Return] Categories', ['controller' => 'categories', 'action' => 'index']) ?> > Items
                    <?php $logged_roles = $this->request->session()->read('Auth.User.roles'); ?>
                    </div>
                    <div class="body">
                        <div class="row clearfix">
                            <div style="padding-top:10px;padding-left:25px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                                <label for="status" style="padding-left:10px;"><b>Category Name</b></label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-7 col-xs-5">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" style="background-color:transparent;" 
                                            class="form-control" value="<?=h($categories->name); ?>" maxlength="50" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div style="padding-top:10px;padding-left:25px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                                <label for="title" style="padding-left:10px;"><b>Merge Code</b></label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-7 col-xs-5">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" style="background-color:transparent;" class="form-control" value="<?=h($categories->merge_value); ?>" maxlength="30" readonly>
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
                        <?php $roles = $this->request->session()->read('Auth.User.roles'); ?>
                        <?php if ($roles['CategoriesItems']['action_add'] === 1): ?>
                            <button type="button" 
                                class="btn btn-info btn-sm waves-effect m-r-20" 
                                data-toggle="modal" data-target="#defaultModal">
                                Add Category Item
                            </button>
                        <?php else: ?>
                            <span>Category Items</span>
                        <?php endif; ?>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <td>Status</td>
                                    <th>Name</th>
                                    <th>Merge Value</th>
                                    <th style="width:10%;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($categories_list) > 0): ?>
                                    <?php foreach ($categories_list as $key => $items): ?>
                                        <tr>
                                            <td><?=h( ($items->status) ? 'ACTIVE' : 'INACTIVE');?></td>
                                            <td><?=h($items->name);?></td>
                                            <td><i><?=h($items->merge_value);?></i></td>
                                            <td>
                                                <?php 
                                                    if (
                                                        (isset($logged_roles['CategoriesItems']['action_delete']))
                                                        && ($logged_roles['CategoriesItems']['action_delete'] === 1)
                                                    ) { ?>
                                                <button style="background-color:transparent;color:orange;padding:0px;padding-left:10px;" 
                                                    onclick='document.getElementById("deletelink").setAttribute("action", "/CategoriesItems/delete/<?=h($items->id);?>")'  
                                                    data-toggle="modal" data-target="#deleteModal"><i class="fa fa-star-half-o"></i></button>  
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4">This Category has no Active Items</td>
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
                        Add Category Item
                    </h4>
                </div>
                <?= $this->Form->create('Add Category Item', ['type' => 'post', 'url' => '/CategoriesItems/add/' . $categories->id]); ?>
                    <div class="modal-body">
                        <div class="row clearfix">
                            <div style="padding:10px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                                <label for="title" style="padding-left:10px;"><b>Category</b></label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-7 col-xs-5">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control" value="<?=h($categories->merge_value);?>" placeholder="Note: Case-sensitive" readonly disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div style="padding:10px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                                <label for="name" style="padding-left:10px;"><b>Name</b></label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-7 col-xs-5">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="name" class="form-control" value="" placeholder="Note: Case-sensitive" maxlength="60" required>
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
                                        <input type="text" name="merge_value" class="form-control" value="" placeholder="Case Sensitive" maxlength="60" required>
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
                    <span class="modal-title" id="staticModalLabel"><b> ACTIVATE/ DEACTIVATE </b></span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding 15px;">
                    Update category item status?
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