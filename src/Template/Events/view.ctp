<div class="container-fluid">
    <div class="row ">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?= $this->Flash->render(); ?>
        </div>
        <div class="col-lg-7 col-md-8 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-content">
					<div class="card-header">
						<?=$this->Html->link('[Return] Events', 
							['controller' => 'events', 'action' => 'index']) ?> > View
					</div>
					<div class="card-body">
						<div class="row clearfix">
							<div style="padding:10px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
								<label for="name" style="padding-left:10px;"><b>Type</b></label>
							</div>
							<div class="col-lg-9 col-md-9 col-sm-7 col-xs-5">
								<div class="form-group">
									<div class="form-line">
										<p class="form-control" style="width:100%;"> 
											<?=h($event->event_type->name);?>
										</p>
									</div>
								</div>
							</div>
						</div>
						<div class="row clearfix">
							<div style="padding:10px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
								<label for="name" style="padding-left:10px;"><b>Title</b></label>
							</div>
							<div class="col-lg-9 col-md-9 col-sm-7 col-xs-5">
								<div class="form-group">
									<div class="form-line">
										<p class="form-control" style="width:100%;"> 
											<?=h($event->title);?>
										</p>
									</div>
								</div>
							</div>
						</div>
						<div class="row clearfix">
							<div style="padding:10px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
								<label for="name" style="padding-left:10px;"><b>Details</b></label>
							</div>
							<div class="col-lg-9 col-md-9 col-sm-7 col-xs-5">
								<div class="form-group">
									<div class="form-line">
										<p class="form-control" style="height:400px;width:100%;overflow-y:auto"> 
											<?=nl2br(h($event->details));?>
										</p>
									</div>
								</div>
							</div>
						</div>
						<div class="row clearfix">
							<div style="padding:10px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
								<label for="name" style="padding-left:10px;"><b>Start</b></label>
							</div>
							<div class="col-lg-9 col-md-9 col-sm-7 col-xs-5">
								<div class="form-group">
									<div class="form-line">
										<p class="form-control" style="width:100%;"> 
											<?=h($event->start->format('d/M/Y h:i A'));?>
										</p>
									</div>
								</div>
							</div>
						</div>
						<div class="row clearfix">
							<div style="padding:10px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
								<label for="name" style="padding-left:10px;"><b>End</b></label>
							</div>
							<div class="col-lg-9 col-md-9 col-sm-7 col-xs-5">
								<div class="form-group">
									<div class="form-line">
										<p class="form-control" style="width:100%;"> 
											<?php if ($event->all_day != 1): ?>
												<?=h($event->end->format('d/M/Y h:i A'));?>
											<?php else: ?>
												-
											<?php endif; ?>
										</p>
									</div>
								</div>
							</div>
						</div>
						<div class="row clearfix">
							<div style="padding:10px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
								<label for="name" style="padding-left:10px;"><b>All Day Event?</b></label>
							</div>
							<div class="col-lg-9 col-md-9 col-sm-7 col-xs-5">
								<div class="form-group">
									<div class="form-line">
										<p class="form-control" style="width:100%;"> 
											<?=h( ($event->all_day) ? 'YES' : 'NO');?>
										</p>
									</div>
								</div>
							</div>
						</div>
						<div class="row clearfix">
							<div style="padding:10px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
								<label for="name" style="padding-left:10px;"><b>Status</b></label>
							</div>
							<div class="col-lg-9 col-md-9 col-sm-7 col-xs-5">
								<div class="form-group">
									<div class="form-line">
										<p class="form-control" style="width:100%;"> 
											<?=h($event->status);?>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer" style="text-align:right;">
						<?php if(isset($back_id)) { ?>
							<a href="/event-types/edit/<?=h($back_id);?>" style="color:black;"
								class="btn btn-warning" data-dismiss="modal">RETURN TO EVENT TYPE</a>
						<?php } ?>
					</div>
                </div>
            </div>
        </div>
    </div> 
</div>