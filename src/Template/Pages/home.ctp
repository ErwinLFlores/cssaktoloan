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
    <!-- <div class="col-md-12" style="padding: 5px;">
        <div class="card">
            <div class="tile_count">
               
                    <div class="col-md-3 col-sm-12 tile_stats_count">
                        <span class="count_top"><i class="fa fa-floppy-disk"></i> Past Due </span>
                        <div class="count">2</div>
                    </div>

                    <div class="col-md-3 col-sm-12 tile_stats_count">
                        <span class="count_top"><i class="fa fa-floppy-disk"></i> Current Due </span>
                        <div class="count">2</div>
                    </div>

                    <div class="col-md-3 col-sm-12 tile_stats_count">
                        <span class="count_top"><i class="fa fa-floppy-disk"></i> Total Loan Amount </span>
                        <div class="count">2</div>
                    </div>

                    <div class="col-md-3 col-sm-12 tile_stats_count">
                        <span class="count_top"><i class="fa fa-floppy-disk"></i>  </span>
                        <div class="count">2</div>
                    </div>
            </div>
        </div>
    </div> -->
    <div class="row col-md-12">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?= $this->Flash->render(); ?>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="col-md-12 no-padding" style="margin-bottom:10px">
                <div class="card">
                    <div class="tile_count">
                        <div class="col-md-6 col-sm-6  tile_stats_count">
                            <span class="count_top"><i class="fa fa-user"></i> Total Contributions</span>
                            <div class="count">
                                <?php echo number_format($user['total_contribution_amount'], 2); ?>
                            </div>
                            <span class="count_bottom">Last Access Date 
                                <i class="green">
                                    TO DO
                                </i><br/>
                            </span>
                        </div>
                        <div class="col-md-6 col-sm-6  tile_stats_count">
                            <span class="count_top"><i class="fa fa-user"></i> Total Loans</span>
                            <div class="count">
                                <?php echo isset($total_loan) ? $total_loan : 0; ?>
                            </div>
                            <span class="count_bottom">Last Access Date 
                                <i class="green">
                                    TO DO
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
                            <span class="count_top"><i class="fa fa-user"></i> Monthly Contribution Amount </span>
                            <div class="count"><?php echo number_format($user['monthly_contribution_amount'], 2); ?></div>
                            <span class="count_bottom">Last Access Date 
                                <i class="green">
                                    TO DO
                                </i><br/>
                            </span>
                        </div>
                        <div class="col-md-6 col-sm-6  tile_stats_count">
                            <span class="count_top"><i class="fa fa-user"></i> Withdraw Amount </span>
                            <div class="count">0.00</div>
                            <span class="count_bottom">Last Access Date 
                                <i class="green">
                                    TO DO
                                </i><br/>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="col-md-6 no-padding">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 no-padding">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Recent Login Activities</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content" style="height:320px;overflow-y:auto;">
                        <div class="dashboard-widget-content">
                        <?php foreach ($login_logs as $key => $value) { ?>
                                    <li>
                                        <div class="block">
                                            <div class="block_content">
                                            <h2 class="title"><?=h($value->message);?></h2>
                                            <div class="byline">
                                                <span>DATETIME</span> 
                                                <span><?=h($value->created->format('Y-M-d H:i A'));?></span>
                                                by <a><?=h(ucwords($value->username));?></a>
                                            </div>
                                            <p class="excerpt"></p>
                                            </div>
                                        </div>
                                    </li>
                                <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 