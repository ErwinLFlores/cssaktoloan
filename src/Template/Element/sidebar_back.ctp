<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <br />
        <div class="profile clearfix">
            <div class="profile_info" style="width:100%;text-align:center;padding:10px;">
                <?php
                    $back_locations = [
                        'Sap' => [
                            'current_action' => 'prints',
                            'back_controller' => 'Sap',
                            'back_action' => 'view',
                            'is_parametered' => true
                        ]
                    ];

                    $current_controller = $this->request->params['controller'];
                    $current_action = $this->request->params['action'];
                    if (isset($back_locations[$current_controller])) { 
                        if ($current_action === $back_locations[$current_controller]['current_action']) {
                            $back_action = $back_locations[$current_controller]['back_action'];
                            $back_controller = $back_locations[$current_controller]['back_controller'];
                            $is_parametered = $back_locations[$current_controller]['is_parametered'];

                            if ($is_parametered) { 
                ?>
                            <a href="/<?=h($back_controller);?>/<?=h($back_action);?>/<?=h($back_id);?>" style="color:white;">
                                <i class="fa fa-arrow-circle-left"></i> &nbsp; BACK
                            </a>
                        <?php } else { ?>
                            <a href="/<?=h($back_controller);?>/<?=h($back_action);?>" style="color:white;">
                                <i class="fa fa-arrow-circle-left"></i> &nbsp; BACK
                            </a>
                        <?php }} ?>
                    <?php } else { ?>
                        <a href="/"  style="color:white;">
                            <i class="fa fa-home"></i> &nbsp; HOME
                        </a>
                    <?php } ?>
            </div>
        </div>
        <hr />
    </div>
</div>
