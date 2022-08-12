<?php if (!empty($this->request->session()->read('Auth.User'))) { ?>
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <?php if (isset($page_title)): ?>
                        <h3><?=h($page_title);?></h3>
                    <?php else: ?>
                        <h3><?=h('');?></h3>
                    <?php endif; ?>
                </div>

                <div class="title_right">
                    <?php if(false): ?>
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search for...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default">Go!</button>
                                </span>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row col-md-12">
                <?php echo $this->fetch('content'); ?>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="col-md-12 col-xs-12" role="main">
        <?php echo $this->fetch('content'); ?>
    </div>
<?php } ?>

