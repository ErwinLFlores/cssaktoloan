<?php
    $cityId = "1730737";
    $googleApiUrl = "http://api.openweathermap.org/data/2.5/weather?id=" . 
        $cityId . "&lang=en&units=metric&APPID=b0c377e2e2202c41e82b85ffc8dd0e53";

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);

    curl_close($ch);
    $weather_data = json_decode($response);
    $currentTime = time();
?>
<div class="container-fluid">
    <div class="col-md-12" style="padding: 5px;">
        <div class="card">
            <div class="tile_count">
                <?php 
                    foreach ($disk as $key => $value) { 
                        if ($key === 'free_disk_converted') {
                            continue;
                        } else {
                ?>
                    <div class="col-md-3 col-sm-12 tile_stats_count">
                        <span class="count_top"><i class="fa fa-floppy-disk"></i> <?=h(ucwords(str_replace('_', ' ', $key)));?></span>
                        <div class="count"><?=h($value);?></div>
                    </div>
                <?php }} ?>
            </div>
        </div>
    </div>
    <div class="row col-md-12">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?= $this->Flash->render(); ?>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <div class="col-md-12 no-padding" style="margin-bottom:10px">
                <div class="card">
                    <div class="tile_count">
                        <div class="col-md-4 col-sm-4  tile_stats_count">
                            <span class="count_top"><i class="fa fa-user"></i> Total SAP Registrants / Members</span>
                            <div class="count"><?=h($sap_count);?>/<?=h($sap_members_count);?></div>
                            <span class="count_bottom">Last Access Date 
                                <i class="green">
                                    <?=h((isset($sap_last_modified)) ? $sap_last_modified->modified->format('Y-M-d H:i A') : 'No Data');?>
                                </i><br/>
                            </span>
                        </div>
                        <div class="col-md-4 col-sm-4  tile_stats_count">
                            <span class="count_top"><i class="fa fa-user"></i> Total Residents / Members</span>
                            <div class="count"><?=h($resident_count);?>/<?=h($resident_members_count);?></div>
                            <span class="count_bottom">Last Access Date 
                                <i class="green"><?=h((isset($resident_last_modified)) ? $resident_last_modified->modified->format('Y-M-d H:i A') : '');?></i>
                            </span>
                        </div>
                        <div class="col-md-4 col-sm-4  tile_stats_count">
                            <span class="count_top"><i class="fa fa-user"></i> Total Constituents / Members</span>
                            <div class="count"><?=h($constituent_count);?>/<?=h($constituent_members_count);?></div>
                            <span class="count_bottom">Last Access Date 
                                <i class="green"><?=h((isset($constituent_last_modified)) ? $constituent_last_modified->modified->format('Y-M-d H:i A') : '');?></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 no-padding" style="margin-bottom:10px">
                <div class="card">
                    <div class="tile_count">
                        <div class="col-md-4 col-sm-4  tile_stats_count">
                            <span class="count_top"><i class="fa fa-users"></i> Total Youth Members / Scholars <sup>Coming Soon</sup></span>
                            <div class="count">0/0</div>
                            <span class="count_bottom">Last Access Date 
                                <i class="green"><?=h((isset($no_data)) ? $no_data->modified->format('Y-M-d H:i A') : 'No Data');?></i>
                            </span>
                        </div>
                        <div class="col-md-4 col-sm-4  tile_stats_count">
                            <span class="count_top"><i class="fa fa-user"></i> Total Active Users (Web) / Mobile <sup>Backlog</sup></span>
                            <div class="count"><?=h($user_count);?>/0</div>
                            <span class="count_bottom">Last Access Date 
                                <i class="green"><?=h((isset($user_last_modified)) ? $user_last_modified->modified->format('Y-M-d H:i A') : '');?></i>
                            </span>
                        </div>
                        <div class="col-md-4 col-sm-4  tile_stats_count">
                            <span class="count_top"><i class="fa fa-user"></i> Total Category / Items</span>
                            <div class="count"><?=h($category_count);?>/<?=h($category_items_count);?></div>
                            <span class="count_bottom">Last Access Date 
                                <i class="green">N/A</i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 no-padding">
                <div class="col-md-6 col-sm-6 no-padding">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Daily Weather Report</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="col-md-12 no-padding">
                                <div class="col-md-12 no-padding" style="height:414px;">
                                    <h2><?=h($weather_data->name); ?> Weather Status</h2>
                                    <div class="time" >
                                        <div><b><?=h(date("l g:i A", $currentTime)); ?></b></div>
                                        <div><b><?=h(date("jS F, Y",$currentTime)); ?></b></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="weather-icon">
                                                <img style="height:130px;width:230px;"
                                                    src="http://openweathermap.org/img/w/<?php echo $weather_data->weather[0]->icon; ?>.png"
                                                    class="weather-icon" />
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="weather-text" style="padding-left:20px;">
                                                <h2><?=h($weather_data->name); ?> <br>
                                                    <i><?=h(ucwords($weather_data->weather[0]->description)); ?></i>
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="time">
                                        <span style="font-size:15px;color:black;">
                                            <b>MIN. TEMPT: <?=h($weather_data->main->temp_max); ?> °C</b>
                                        </span>
                                        <br/>
                                        <span style="font-size:15px;color:black;">
                                            <b>MAX. TEMPT: <?=h($weather_data->main->temp_min); ?> °C</b>
                                        </span>
                                    </div>
                                    <hr/>
                                    <div class="time">
                                        <span style="font-size:15px;color:black;">
                                            <b>HUMIDITY: <?=h($weather_data->main->humidity); ?> %</b>
                                        </span>
                                        <br/>
                                        <span style="font-size:15px;color:black;">
                                            <b>WIND: <?=h($weather_data->wind->speed); ?> km/h</b>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12 no-padding">
                    <div class="col-md-12 col-sm-12 no-padding">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Monthly Calendar Events</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="col-md-12 x_content no-padding" 
                                style="height:420px;overflow:auto;">
                                <?php if (count($event_calendar) > 0){ ?>
                                    <ul class="to_do" style="margin-left:0px;">
                                        <?php $roles = $this->request->session()->read('Auth.User.roles'); ?>
                                        <?php 
                                            foreach ($event_calendar as $key => $value) { ?>
                                            <li>
                                                <?php 
                                                    if (
                                                        (isset($roles['Events']['action_view']))
                                                        && ($roles['Events']['action_view'] === 1)
                                                    ):
                                                ?>
                                                    <?=$this->Html->link($value->title, 
                                                        ['controller' => 'Events', 'action' => 'view', $value->id], 
                                                        ['class' => '', 'escape' => false, 
                                                            'data-toggle' => 'tooltip', 
                                                            'title' => h($value->start->format('Y-M-d')) . ' Event' ]); ?>
                                                <?php else: ?>
                                                    <li data-toggle="tooltip" title="<?=h($value->start->format('Y-M-d H:i A'));?>">
                                                        <?=h($value->title);?>
                                                    </li>
                                                <?php endif; ?>
                                        <?php } ?>
                                    </ul>
                                <?php } else { ?>
                                    <i>No Active Calendar Events</i>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Recent Page Activities</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" style="height:320px;overflow-y:auto;">
                    <div class="dashboard-widget-content">
                        <ul class="list-unstyled timeline widget">
                            <?php foreach ($logs as $key => $value) { ?>
                                <li>
                                    <div class="block">
                                        <div class="block_content">
                                        <h2 class="title"><?=h(strtoupper($value->log_action));?></h2>
                                        <div class="byline">
                                            <span><?=h($value->created->format('(D) M d, Y h:i A'));?></span> 
                                            by <a><?=h(ucwords($value->user->username));?></a>
                                        </div>
                                        <p class="excerpt">
                                            <?=h($value->notes);?>
                                        </p>
                                        </div>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="x_panel">
                <div class="x_title">
                    <h2>Recent Login Activities</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" style="height:320px;overflow-y:auto;">
                    <div class="dashboard-widget-content">
                        <ul class="list-unstyled timeline widget">
                            <?php foreach ($login_logs as $key => $value) { ?>
                                <li>
                                    <div class="block">
                                        <div class="block_content">
                                        <h2 class="title"><?=h($value->message);?></h2>
                                        <div class="byline">
                                            <span><?=h($value->created->format('(D) M d, Y h:i A'));?></span> 
                                            by <a><?=h(ucwords($value->username));?></a>
                                        </div>
                                        <p class="excerpt">
                                        </p>
                                        </div>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 