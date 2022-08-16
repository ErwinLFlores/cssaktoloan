<div class="container-fluid">
    <div class="row ">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?= $this->Flash->render(); ?>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-content">
                    <div style="padding:10px;">
						<?php $logged_roles = $this->request->session()->read('Auth.User.roles'); ?>
                        <?php 
                            if (
                                (isset($logged_roles['EventTypes']['action_add']))
                                && ($logged_roles['EventTypes']['action_add'] === 1)
                            ):
                        ?>
                        <button type="button" 
                            class="btn btn-info btn-sm waves-effect m-r-20" 
                            data-toggle="modal" data-target="#defaultModal">
							Add Event Type
                        </button>
						<?php endif; ?>
                    </div>
                    <div class="body table-responsive">
						<div class="events small-12 medium-8 large-12 columns">
							<table class="table table-bordered" cellpadding="0" 
								cellspacing="0" class="small-12 columns">
								<tr>
									<th><?= $this->Paginator->sort('status');?></th>
									<th><?= $this->Paginator->sort('name');?></th>
									<th><?= $this->Paginator->sort('color');?></th>
									<th class="actions"></th>
								</tr>
							<?php
								$i = 0;
								foreach ($eventTypes as $eventType):
									$class = null;
									if ($i++ % 2 == 0) {
										$class = ' class="altrow"';
									}
							?>
								<tr<?= $class;?>>
									<td><?=h( ($eventType->status) ? 'Active' : 'Inactive'); ?></td>
									<td><?=h($eventType->name); ?></td>
									<td style="background-color:<?=h($eventType->color);?>;"></td>
									<td class="actions">
										<?php 
											if (
												(isset($logged_roles['EventTypes']['action_edit']))
												&& ($logged_roles['EventTypes']['action_edit'] === 1)
											):
										?>
											<?= $this->Html->link(__('Manage', true), ['action' => 'edit', $eventType->id]); ?> 
										<?php endif; ?>
										<?php 
											if (
												(isset($logged_roles['EventTypes']['action_delete']))
												&& ($logged_roles['EventTypes']['action_delete'] === 1)
											) { ?>
												<button style="background-color:transparent;color:orange;padding:0px;padding-left:10px;" 
													onclick='document.getElementById("deletelink").setAttribute("action", "/EventTypes/delete/<?=h($eventType->id);?>")'  
													data-toggle="modal" data-target="#deleteModal"><i class="fa fa-star-half-o"></i></button>  
										<?php } ?>
									</td>
								</tr>
								<?php endforeach; ?>
							</table>
						</div>
						<div class="col-sm-12 float-right" id="paginator" style="padding:10px;">
							<div class="paginator" style="float:right;">
								<ul class="pagination pagination-primary" style="margin-bottom:0px">
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
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>

<div class="modal fade" id="defaultModal" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="defaultModalLabel">
					Add Event Type
				</h4>
			</div>
			<?= $this->Form->create('Add Event Type', ['type' => 'post', 'url' => '/event-types/add']); ?>
				<div class="modal-body">
					<div class="row clearfix">
						<div style="padding:10px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
							<label for="name" style="padding-left:10px;"><b>Name</b></label>
						</div>
						<div class="col-lg-9 col-md-9 col-sm-7 col-xs-5">
							<div class="form-group">
								<div class="form-line">
									<input type="text" name="name" class="form-control" 
										oninput="this.value = this.value.toUpperCase()"
										value="" maxlength="50" required>
								</div>
							</div>
						</div>
					</div>
					<div class="row clearfix">
						<div style="padding:10px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
							<label for="color" style="padding-left:10px;"><b>Color</b></label>
						</div>
						<div class="col-lg-9 col-md-9 col-sm-7 col-xs-5">
							<div class="form-group">
								<div class="form-line">
									<input type="color" name="color" class="form-control" 
										value="#2AA5C0" maxlength="50" required>
								</div>
							</div>
						</div>
					</div>
					<div class="row clearfix">
						<div style="padding:10px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
							<label for="details" style="padding-left:10px;"><b>Details</b></label>
						</div>
						<div class="col-lg-9 col-md-9 col-sm-7 col-xs-5">
							<div class="form-group">
								<div class="form-line">
									<textarea class="form-control" style="min-height:350px;max-height: 350px;overflow-y:auto;" 
										name="details" id="details" cols="30" rows="10"></textarea>
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
				Update event type status?
			</div>
			<div class="modal-footer">
				<?= $this->Form->create('id', ['id'=>'deletelink','method'=>'post']);?>
					<button type="submit" style="padding:5px;" class="btn btn-primary btn-xs"><small>Confirm</small></button>
				<?= $this->Form->end();?>
			</div>
		</div>
	</div>
</div>