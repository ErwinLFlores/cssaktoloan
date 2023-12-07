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

    <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
        <div class="col-md-6 no-padding">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Daily Weather Report</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="col-md-12 no-padding">
                        <div class="col-md-12 no-padding" style="height:200px;">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 no-padding">
            <div class="x_panel">
                <div class="x_content">
                    <div class="col-md-12 no-padding">
                        <div class="col-md-12 no-padding" style="height:252px;text-align:center;">
                            <br/>
                            <h1><?=h(date('F'));?></h1>
                            <span style="font-size: 55px;"><?=h(date('d'));?></span><br/>
                            <h1> <?=h(date('Y'));?></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row col-md-12">
        <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
            <?= $this->Flash->render(); ?>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="col-md-12 no-padding" style="margin-bottom:10px">
                <div class="card">
                    <div class="tile_count">
                        <div class="col-md-6 col-sm-6  tile_stats_count">
                            <span class="count_top"><i class="fa fa-user"></i> Total Contributions</span>
                            <div class="count"><?=h($total_contribution);?></div>
                            <span class="count_bottom">Last Access Date 
                                <i class="green">
                                    <?=h(date('Y-M-d H:i A'));?>
                                </i><br/>
                            </span>
                        </div>
                        <div class="col-md-6 col-sm-6  tile_stats_count">
                            <span class="count_top"><i class="fa fa-user"></i> Total Loans</span>
                            <div class="count"><?=h($total_loan);?></div>
                            <span class="count_bottom">Last Access Date 
                                <i class="green">
                                    <?=h(date('Y-M-d H:i A'));?>
                                </i><br/>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 no-padding" style="margin-bottom:10px">
                <div class="card">
                    <div class="tile_count">
                        <div class="col-md-6 col-sm-6  tile_stats_count">
                            <span class="count_top"><i class="fa fa-user"></i> For Approval </span>
                            <div class="count"><?=h($for_approval);?></div>
                            <span class="count_bottom">Last Access Date 
                                <i class="green">
                                    <?=h(date('Y-M-d H:i A'));?>
                                </i><br/>
                            </span>
                        </div>
                        <div class="col-md-6 col-sm-6  tile_stats_count">
                            <span class="count_top"><i class="fa fa-user"></i> Pending Release </span>
                            <div class="count"><?=h($for_release);?></div>
                            <span class="count_bottom">Last Access Date 
                                <i class="green">
                                    <?=h(date('Y-M-d H:i A'));?>
                                </i><br/>
                            </span>
                        </div>
                        <!-- <div class="col-md-6 col-sm-6  tile_stats_count">
                            <span class="count_top"><i class="fa fa-user"></i> Contract Generation </span>
                            <div class="count"><?=h($for_contract);?></div>
                            <span class="count_bottom">Last Access Date 
                                <i class="green">
                                    <?=h(date('Y-M-d H:i A'));?>
                                </i><br/>
                            </span>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="col-md-12 no-padding" style="margin-bottom:10px">
                <div class="card">
                    <div class="tile_count">
                        <div class="col-md-6 col-sm-6  tile_stats_count">
                            <span class="count_top"><i class="fa fa-user"></i> Total Users </span>
                            <div class="count"><?=h($total_users);?></div>
                            <span class="count_bottom">Last Access Date 
                                <i class="green">
                                    <?=h(date('Y-M-d H:i A'));?>
                                </i><br/>
                            </span>
                        </div>
                        <div class="col-md-6 col-sm-6  tile_stats_count">
                            <span class="count_top"><i class="fa fa-user"></i> Approved and Released</span>
                            <div class="count"><?=h($approved_loans);?></div>
                            <span class="count_bottom">Last Access Date 
                                <i class="green">
                                    <?=h(date('Y-M-d H:i A'));?>
                                </i><br/>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 no-padding" style="margin-bottom:10px">
                <div class="card">
                    <div class="tile_count">
                        <!-- <div class="col-md-6 col-sm-6  tile_stats_count">
                            <span class="count_top"><i class="fa fa-user"></i> Rejected</span>
                            <div class="count"><?=h($rejected_loans);?></div>
                            <span class="count_bottom">Last Access Date 
                                <i class="green">
                                    <?=h(date('Y-M-d H:i A'));?>
                                </i><br/>
                            </span>
                        </div> -->
                        <div class="col-md-6 col-sm-6  tile_stats_count">
                            <span class="count_top"><i class="fa fa-user"></i> Max Loan per Contribution Percentage</span>
                            <div class="count"><?=h($max_load_percent);?> %</div>
                            <span class="count_bottom">Last Access Date 
                                <i class="green">
                                    <?=h(date('Y-M-d H:i A'));?>
                                </i><br/>
                            </span>
                        </div>
                        <div class="col-md-6 col-sm-6  tile_stats_count">
                            <span class="count_top"><i class="fa fa-user"></i> Active Loan Interest</span>
                            <div class="count"><?=h($active_interest);?> %</div>
                            <span class="count_bottom">Last Access Date 
                                <i class="green">
                                    <?=h(date('Y-M-d H:i A'));?>
                                </i><br/>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row col-md-12">
        <div class="col-md-4">
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
                                            <span><?=h($value->created->format('Y-M-d H:i A'));?></span>
                                            by <a><?=h(ucwords($value->username));?></a>
                                        </div>
                                        <p class="excerpt"></p>
                                        </div>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Recent Contribution Activities</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" style="height:320px;overflow-y:auto;">
                    <div class="dashboard-widget-content">
                        <ul class="list-unstyled timeline widget">
                            <?php foreach ($loans_notif as $key => $value) { ?>
                                <li>
                                    <div class="block">
                                        <div class="block_content">
                                        <h2 class="title"><?=h($value->message);?></h2>
                                        <div class="byline">
                                            <span><?=h($value->created->format('Y-M-d H:i A'));?></span>
                                            by <a><?=h(ucwords($value->username));?></a>
                                        </div>
                                        <p class="excerpt"></p>
                                        </div>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Recent Loan Status Logs</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" style="height:320px;overflow-y:auto;">
                    <div class="dashboard-widget-content">
                        <ul class="list-unstyled timeline widget">
                            <?php foreach ($approval_logs as $key => $value) { ?>
                                <li>
                                    <div class="block">
                                        <div class="block_content">
                                        <h2 class="title"><?=h($value->message);?></h2>
                                        <div class="byline">
                                            <span><?=h($value->created->format('Y-M-d H:i A'));?></span>
                                            by <a><?=h(ucwords($value->action_provider));?></a>
                                        </div>
                                        <p class="excerpt"></p>
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