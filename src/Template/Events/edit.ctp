<div class="container-fluid">
    <div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<?= $this->Flash->render(); ?>
		</div>
		<div class="col-lg-7 col-md-8 col-sm-12 col-xs-12">
			<?= $this->Form->create('Edit Event', ['type' => 'post', 'url' => '/events/edit/' . $event->id]); ?>
				<div class="card">
					<div class="card-content">
						<div class="card-header">
							<?=$this->Html->link('[Return] Events', 
								['controller' => 'events', 'action' => 'index']) ?> > Edit
						</div>
						<div class="card-body">
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
													<option value="<?=h($status->id);?>"
														<?=h(($event->event_type->name === $status->name) ? 'selected' : '');?>>
															<?=h(strtoupper($status->name));?>
													</option>
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
												value="<?=h($event->title);?>" maxlength="50" required>
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
												style="min-height:350px;max-height: 350px;overflow-y:auto;white-space: pre;" 
												cols="30" rows="10"><?= (h($event->details));?></textarea>
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
											<input type="datetime-local" name="start" 
												class="form-control" value="<?=h($event->start->format('Y-m-d\TH:i'));?>" maxlength="50" required>
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
											<input type="datetime-local" name="end" 
												class="form-control" value="<?=h($event->end->format('Y-m-d\TH:i'));?>" maxlength="50" required>
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
												<option value="1" <?=h(($event->all_day) ? 'selected' : '');?>>YES</option>
												<option value="0" <?=h(($event->all_day === 0) ? 'selected' : '');?>>NO</option>
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
													<option <?=h(($event->status === $status->name) ? 'selected' : '');?>
														value="<?=h($status->merge_value);?>">
															<?=h($status->name);?>
													</option>
												<?php } ?>
											</select>
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
</div>