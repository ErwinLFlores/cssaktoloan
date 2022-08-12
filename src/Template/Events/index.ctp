<div class="container-fluid">
    <div class="row ">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?= $this->Flash->render(); ?>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-content">
                    <div style="padding:10px;">
						<?php $roles = $this->request->session()->read('Auth.User.roles'); ?>
                        <?php 
                            if (
                                (isset($roles['Events']['action_add']))
                                && ($roles['Events']['action_add'] === 1)
                            ):
                        ?>
							<button type="button" 
								class="btn btn-info btn-sm waves-effect m-r-20" 
								data-toggle="modal" data-target="#defaultModal">
								Add an Event
							</button>
                        <?php endif; ?>
                    </div>
                    <div class="body table-responsive">
                        <?php $logged_roles = $this->request->session()->read('Auth.User.roles'); ?>
						<div class="events small-12 medium-8 large-12 columns">
							<table class="table table-bordered" cellpadding="0" 
								cellspacing="0" class="small-12 columns">
								<tr>
									<th><?= $this->Paginator->sort('event_type_id');?></th>
									<th><?= $this->Paginator->sort('title');?></th>
									<th><?= $this->Paginator->sort('status');?></th>
									<th><?= $this->Paginator->sort('start');?></th>
									<th><?= $this->Paginator->sort('end');?></th>
									<th><?= $this->Paginator->sort('all_day');?></th>
									<th class="actions" style="color:black;">Actions</th>
								</tr>
								<?php
									$i = 0;
									foreach ($events as $event):
										$class = null;
										if ($i++ % 2 == 0) {
											$class = ' class="altrow"';
										}
								?>
									<tr<?= $class;?>>
										<td>
											<?= $this->Html->link($event->event_type->name, ['controller' => 'event_types', 'action' => 'view', $event->event_type->id]); ?>
										</td>
										<td><?=h($event->title); ?></td>
										<td><?=h($event->status); ?></td>
										<td><?=h($event->start->format('Y-M-d H:i A')); ?></td>
										<?php if($event->all_day == 0): ?>
											<td><?=h($event->end->format('Y-M-d H:i A')); ?></td>
										<?php else: ?>
											<td>N/A</td>
										<?php endif; ?>
										<td><?php if($event->all_day == 1) { echo "Yes"; } else { echo "No"; } ?></td>
										<td class="actions">
											<?php 
												if (
													(isset($roles['Events']['action_add']))
													&& ($roles['Events']['action_add'] === 1)
												):
											?>
												<?= $this->Html->link(__('VIEW'), 
													['action' => 'view', $event->id], ['class' => '', 'escape' => false]); ?> &nbsp;
											<?php endif; ?>

											<?php 
												if (
													(isset($roles['Events']['action_edit']))
													&& ($roles['Events']['action_edit'] === 1)
												):
											?>
												<?= $this->Html->link(__('EDIT'), 
													['action' => 'edit', $event->id], ['class' => '', 'escape' => false]); ?> &nbsp;
											<?php endif; ?>

											<?php 
												if (
													(isset($roles['Events']['action_delete']))
													&& ($roles['Events']['action_delete'] === 1)
												):
											?>
												<?= $this->Form->postLink(__('DELETE'), 
													['action' => 'delete', $event->id], ['confirm' => 'Are you sure?'], 
													['class' => '', 'escape' => false]); ?>
											<?php endif; ?>
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
					Add Event
				</h4>
			</div>
			<?= $this->Form->create('Add Event', ['type' => 'post', 'url' => '/events/add']); ?>
				<div class="modal-body">
					<div class="row clearfix">
						<div style="padding:10px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
							<label for="name" style="padding-left:10px;"><b>Type</b></label>
						</div>
						<div class="col-lg-9 col-md-9 col-sm-7 col-xs-5">
							<div class="form-group">
								<div class="form-line">
									<select id="event_type_id" name="event_type_id" class="form-control select2" required>
										<option value="" selected disabled>SELECT...</option>
										<?php foreach ($event_types as $key => $status) { ?>
											<option value="<?=h($status->id);?>"><?=h(strtoupper($status->name));?></option>
										<?php } ?>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="row clearfix">
						<div style="padding:10px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
							<label for="title" style="padding-left:10px;"><b>Title</b></label>
						</div>
						<div class="col-lg-9 col-md-9 col-sm-7 col-xs-5">
							<div class="form-group">
								<div class="form-line">
									<input type="text" name="title" class="form-control" 
										oninput="this.value = this.value.toUpperCase()"
										value="" maxlength="50" required>
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
					<div class="row clearfix">
						<div style="padding:10px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
							<label for="start" style="padding-left:10px;"><b>Start</b></label>
						</div>
						<div class="col-lg-9 col-md-9 col-sm-7 col-xs-5">
							<div class="form-group">
								<div class="form-line">
									<input type="datetime-local" name="start" class="form-control" placeholder="Case Sensitive" value="" maxlength="50" required>
								</div>
							</div>
						</div>
					</div>
					<div class="row clearfix">
						<div style="padding:10px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
							<label for="end" style="padding-left:10px;"><b>End</b></label>
						</div>
						<div class="col-lg-9 col-md-9 col-sm-7 col-xs-5">
							<div class="form-group">
								<div class="form-line">
									<input type="datetime-local" name="end" class="form-control" placeholder="Case Sensitive" value="" maxlength="50" required>
								</div>
							</div>
						</div>
					</div>
					<div class="row clearfix">
						<div style="padding:10px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
							<label for="all_day" style="padding-left:10px;"><b>All Day Event?</b></label>
						</div>
						<div class="col-lg-9 col-md-9 col-sm-7 col-xs-5">
							<div class="form-group">
								<div class="form-line">
									<select id="all_day" name="all_day" class="form-control select2" required>
										<option value="1">YES</option>
										<option value="0" selected>NO</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="row clearfix">
						<div style="padding:10px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
							<label for="status" style="padding-left:10px;"><b>Status</b></label>
						</div>
						<div class="col-lg-9 col-md-9 col-sm-7 col-xs-5">
							<div class="form-group">
								<div class="form-line">
									<select id="status" name="status" class="form-control select2" required>
										<option value="" selected disabled>SELECT...</option>
										<?php foreach ($event_status->categories_items as $key => $status) { ?>
											<option value="<?=h($status->merge_value);?>"><?=h($status->name);?></option>
										<?php } ?>
									</select>
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
