<style>
    .disabled {
        pointer-events: none; 
        opacity:0.6;        
    }
</style>
<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="#" class="site_title"><i class="fa fa-sitemap"></i> <small>CSC Sakto Loan</small></a>
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
                WELCOME, <h2><?=h(strtoupper($logged_name));?></h2>
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
                            <i class="fa fa-tachometer"></i> Dashboard
                        </a>
                    </li>
                    <li class="<?php echo ($this->request->params['controller'] == 'Loans') ? 'active' : ''; ?>">
                        <a><i class="fa fa-home"></i> Loans <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="/loans">Manage</a></li>
                            <li><a href="/loans/add">Request</a></li>
                            <li><a href="/loans/borrow">Borrow</a></li>
                        </ul>
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
