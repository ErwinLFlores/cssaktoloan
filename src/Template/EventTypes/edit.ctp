<div class="container-fluid" style="background-color:white;">
    <div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<?= $this->Flash->render(); ?>
		</div>
		<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
			<?= $this->Form->create('Edit Event Type', ['type' => 'post', 'url' => '/EventTypes/edit/' . $event_type->id]); ?>
				<div class="card">
					<div class="card-content">
						<div class="card-header">
							<?=$this->Html->link('[Return] Event Types', 
								['controller' => 'EventTypes', 'action' => 'index']) ?> > Edit
						</div>
						<div class="card-body">
							<div class="row clearfix">
								<div style="padding:10px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
									<label for="name" style="padding-left:10px;"><b>Status</b></label>
								</div>
								<div class="col-lg-9 col-md-9 col-sm-7 col-xs-5">
									<div class="form-group">
										<div class="form-line">
											<p class="form-control" style="width:100%;"> 
												<?=h(($event_type->status) ? 'ACTIVE' : 'INACTIVE');?>
											</p>
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
											<input type="text" name="name" class="form-control" 
												oninput="this.value = this.value.toUpperCase()"
												value="<?=h($event_type->name);?>" maxlength="50" required>
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
												value="<?=h($event_type->color); ?>" maxlength="50" required>
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
											<textarea class="form-control" name="details" 
												style="min-height:250px;max-height: 250px;overflow-y:auto;white-space: pre;" 
												cols="30" rows="10"><?= (h($event_type->details));?></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="card-footer" style="text-align:right;">
							<input type="submit" id="submitbutton" class="btn btn-info" value="SUBMIT">
						</div>
					</div>
				</div>
			<?= $this->Form->end(); ?>
		</div>
    </div> 
	<br/>
	<div class="row ">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?= $this->Flash->render(); ?>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-content">
                    <div style="padding:10px;">
                        <h2 style="color:black;">Related Events</h2>
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
									<th class="actions"></th>
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
											<?= $this->Html->link(__('VIEW'), 
												['controller' => 'events', 'action' => 'view', $event->id, $event_type->id], ['class' => '', 'escape' => false]); ?> &nbsp;
											<?= $this->Html->link(__('EDIT'), 
												['controller' => 'events', 'action' => 'edit', $event->id], ['class' => '', 'escape' => false]); ?> &nbsp;
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