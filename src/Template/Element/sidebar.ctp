<style>
    .disabled {
        pointer-events: none; 
        opacity:0.6;        
    }
</style>
<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="#" class="site_title"><i class="fa fa-sitemap"></i> <small>ONLINE BALIBAGO</small></a>
        </div>

        <div class="clearfix"></div>

        <hr />

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <!-- <div class="profile_pic">
                <img src="/images/img.jpg" alt="..." class="img-circle profile_img">
            </div> -->
            <?php $user_data = $this->request->session()->read('Auth.User'); ?>
            <div class="profile_info" style="width:100%;text-align:center;padding:10px;">
                WELCOME, <h2><?=h(strtoupper($user_data['username'])); ?></h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <hr />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li class="<?php echo ($this->request->params['controller'] == 'Pages') ? 'active' : ''; ?>">
                        <a href="/">
                            <i class="fa fa-tachometer"></i> Home
                        </a>
                    </li>
                    <?php if(isset($user_data['roles']['Sap'])) { ?>
                        <li class="<?php echo ($this->request->params['controller'] == 'Sap') ? 'active' : ''; ?>">
                            <a><i class="fa fa-home"></i> SAP <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <?php if ($user_data['roles']['Sap']['action_index']) { ?> <li><a href="/sap">Manage</a></li> <?php } ?>
                                <?php if ($user_data['roles']['Sap']['action_add']) { ?> <li><a href="/sap/add">Add</a></li> <?php } ?>
                                <?php if ($user_data['roles']['Sap']['action_members']) { ?> <li><a href="/sap/members">Members</a></li> <?php } ?>
                                <?php if ($user_data['roles']['Sap']['action_reports']) { ?> <li><a href="#" class="disabled">Reports</a></li> <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>
                    <?php if(isset($user_data['roles']['Registry'])) { ?>
                        <li class="<?php echo ($this->request->params['controller'] == 'Registry') ? 'active' : ''; ?>">
                            <a><i class="fa fa-users"></i> Registry 
                                <span class="label label-success">New</span>
                                <span class="fa fa-chevron-down pull-right"></span>
                            </a>
                            <ul class="nav child_menu">
                                <?php if ($user_data['roles']['Registry']['action_add']) { ?> <li><a href="/registry/add">Add</a></li> <?php } ?>
                                
                                <?php if(isset($user_data['roles']['Residents'])) { ?>
                                    <?php if ($user_data['roles']['Residents']['action_index']) { ?> <li><a href="/residents">Residents</a></li> <?php } ?>
                                    <?php if ($user_data['roles']['Residents']['action_members']) { ?> <li><a href="/residents/members">Resident Members</a></li> <?php } ?>
                                <?php } ?>
                                
                                <?php if(isset($user_data['roles']['Constituents'])) { ?>
                                    <?php if ($user_data['roles']['Constituents']['action_index']) { ?> <li><a href="/constituents">Constituents</a></li> <?php } ?>
                                    <?php if ($user_data['roles']['Constituents']['action_members']) { ?> <li><a href="/constituents/members">Constituent Members</a></li> <?php } ?>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>
                    <li class="<?php echo ($this->request->params['controller'] == 'Events') ? 'active' : ''; ?>">
                        <a><i class="fa fa-calendar"></i> Calendar <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <?php if ($user_data['roles']['Events']['action_view']) { ?> <li><a href="/full-calendar">View</a></li> <?php } ?>
                            <?php if ($user_data['roles']['Events']['action_index']) { ?> <li><a href="/events/">Manage</a></li> <?php } ?>
                            <?php if ($user_data['roles']['EventTypes']['action_index']) { ?> <li><a href="/event-types">Event Types</a></li> <?php } ?>
                        </ul>
                    </li>
                </ul>
            </div>
            <?php if(array_intersect_key(
                array("Scholars"=>[], "YouthProfiling"=>[]),
                $user_data['roles']
            )) { ?>
                <div class="menu_section">
                    <h3>YOUTH / PROGRAMS</h3>
                    <ul class="nav side-menu">
                        <?php if(isset($user_data['roles']['YouthProfiling'])) { ?>
                            <li class="<?php echo ($this->request->params['controller'] == 'YouthProfiling') ? 'active' : ''; ?>">
                                <a><i class="fa fa-child"></i> Youth Profiling 
                                    <span class="label label-success pull-right">Pending</span>
                                    <!-- <span class="fa fa-chevron-down"></span> -->
                                </a>
                                <ul class="nav child_menu">
                                    <?php if ($user_data['roles']['YouthProfiling']['action_index']) { ?> <li><a href="#" class="disabled">Manage</a></li> <?php } ?>
                                    <?php if ($user_data['roles']['YouthProfiling']['action_index']) { ?> <li><a href="#" class="disabled">Add</a></li> <?php } ?>
                                    <?php if ($user_data['roles']['YouthProfiling']['action_index']) { ?> <li><a href="#" class="disabled">Reports</a></li> <?php } ?>
                                </ul>
                            </li>
                        <?php } ?>
                        <?php if(isset($user_data['roles']['Scholars'])) { ?>
                            <li class="<?php echo ($this->request->params['controller'] == 'Scholars') ? 'active' : ''; ?>">
                                <a><i class="fa fa-graduation-cap"></i> Scholars 
                                    <span class="label label-success pull-right">Coming Soon</span>
                                    <!-- <span class="fa fa-chevron-down"></span> -->
                                </a>
                                <ul class="nav child_menu">
                                    <?php if ($user_data['roles']['Scholars']['action_index']) { ?> <li><a href="#" class="disabled">Manage</a></li> <?php } ?>
                                    <?php if ($user_data['roles']['Scholars']['action_index']) { ?> <li><a href="#" class="disabled">Add</a></li> <?php } ?>
                                    <?php if ($user_data['roles']['Scholars']['action_index']) { ?> <li><a href="#" class="disabled">Reports</a></li> <?php } ?>
                                </ul>
                            </li>
                        <?php } ?>
                        <br/>
                    </ul>
                </div>
            <?php } ?>
            <?php if(array_intersect_key(
                array("Users"=>[],"Categories"=>[],"Roles"=>[]),
                $user_data['roles']
            )) { ?>
                <div class="menu_section">
                    <h3>ADVANCED</h3>
                    <ul class="nav side-menu">
                        <?php if(isset($user_data['roles']['Users'])) { ?>
                            <li class="<?php echo ($this->request->params['controller'] == 'Users') ? 'active' : ''; ?>">
                                <a><i class="fa fa-user-secret"></i> Users <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <?php if ($user_data['roles']['Users']['action_index']) { ?> <li><a href="/users">Manage</a></li> <?php } ?>
                                    <?php if ($user_data['roles']['Users']['action_add']) { ?> <li><a href="/users/add">Add</a></li> <?php } ?>
                                    <?php if ($user_data['roles']['Users']['action_reports']) { ?> <li><a href="#">Reports</a></li> <?php } ?>
                                </ul>
                            </li>
                        <?php } ?>
                        <?php if(isset($user_data['roles']['Roles'])) { ?>
                            <li class="<?php echo ($this->request->params['controller'] == 'Roles') ? 'active' : ''; ?>">
                                <a><i class="fa fa-universal-access"></i> Roles <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <?php if ($user_data['roles']['Roles']['action_index']) { ?><li><a href="/roles">Manage</a></li> <?php } ?>
                                </ul>
                            </li>
                        <?php } ?>
                        <?php if(isset($user_data['roles']['Categories'])) { ?>
                            <li class="<?php echo ($this->request->params['controller'] == 'Roles') ? 'active' : ''; ?>">
                                <a><i class="fa fa-object-group"></i> Categories <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <?php if ($user_data['roles']['Categories']['action_index']) { ?><li><a href="/categories">Manage</a></li> <?php } ?>
                                </ul>
                            </li>
                        <?php } ?>
                        <br/>
                    </ul>
                </div>
            <?php } ?>

            <div class="menu_section">
                <h3>Tools</h3>
                <ul class="nav side-menu">
                    <li class="<?php echo ($this->request->params['action'] == 'Cropper') ? 'active' : ''; ?>">
                        <a href="/tools/cropper">
                            <i class="fa fa-thumb-tack"></i> Image Cropper
                        </a>
                    </li>
                    <li class="<?php echo ($this->request->params['action'] == 'Camera') ? 'active' : ''; ?>">
                        <a href="/tools/camera">
                            <i class="fa fa-camera"></i> Camera
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings --disabled">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen --disabled">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock --disabled">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="/logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>
