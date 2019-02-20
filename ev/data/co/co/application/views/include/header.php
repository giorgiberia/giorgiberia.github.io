<!DOCTYPE HTML>
<html>
<head>
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- Bootstrap Core CSS -->
    <link href="<?=base_url('assets/css/bootstrap.min.css')?>" rel='stylesheet' type='text/css' />
    <!-- Custom CSS -->
    <link href="<?=base_url('assets/css/style.css')?>" rel='stylesheet' type='text/css' />

    <link href="<?=base_url('assets/css/morris.css')?>" rel="stylesheet"  type="text/css"/>
    <script src="https://unpkg.com/sweetalert2@7.13.1/dist/sweetalert2.all.js"></script>
    <!-- Graph CSS -->
    <link href="<?=base_url('assets/css/font-awesome.css')?>" rel="stylesheet">
    <!-- jQuery -->
    <script src="<?=base_url('assets/js/jquery-2.1.4.min.js')?>"></script>
    <!-- //jQuery -->

    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/table-style.css')?>" />
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/basictable.css')?>" />

    <link href='https://fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <!-- lined-icons -->
    <link rel="stylesheet" href="<?=base_url('assets/css/icon-font.min.css')?>" type='text/css' />
    <!-- //lined-icons -->
</head>
<body>
<div class="page-container">

    <!--/content-inner-->
    <div class="left-content">
        <div class="mother-grid-inner">
            <!--header start here-->
            <div class="header-main">
                <div class="logo-w3-agile">
                    <h1><a href="index.html">Pooled</a></h1>
                </div>
                <div class="w3layouts-left">

                    <!--search-box-->
                    <div class="w3-search-box">
                        <form action="#" method="post">
                            <input type="text" placeholder="Search..." required="">
                            <input type="submit" value="">
                        </form>
                    </div><!--//end-search-box-->
                    <div class="clearfix"> </div>
                </div>
                <div class="w3layouts-right">
                    <div class="profile_details_left"><!--notifications of menu start -->
                        <ul class="nofitications-dropdown">
                            <li class="dropdown head-dpdn">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-envelope"></i><span class="badge">3</span></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <div class="notification_header">
                                            <h3>You have 3 new messages</h3>
                                        </div>
                                    </li>
                                    <li><a href="#">
                                            <div class="user_img"><img src="<?=base_url()?>/assets/images/in11.jpg" alt=""></div>
                                            <div class="notification_desc">
                                                <p>Lorem ipsum dolor</p>
                                                <p><span>1 hour ago</span></p>
                                            </div>
                                            <div class="clearfix"></div>
                                        </a></li>
                                    <li class="odd"><a href="#">
                                            <div class="user_img"><img src="<?=base_url()?>/assets/images/in10.jpg" alt=""></div>
                                            <div class="notification_desc">
                                                <p>Lorem ipsum dolor </p>
                                                <p><span>1 hour ago</span></p>
                                            </div>
                                            <div class="clearfix"></div>
                                        </a></li>
                                    <li><a href="#">
                                            <div class="user_img"><img src="<?=base_url()?>/assets/images/in9.jpg" alt=""></div>
                                            <div class="notification_desc">
                                                <p>Lorem ipsum dolor</p>
                                                <p><span>1 hour ago</span></p>
                                            </div>
                                            <div class="clearfix"></div>
                                        </a></li>
                                    <li>
                                        <div class="notification_bottom">
                                            <a href="#">See all messages</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown head-dpdn">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell"></i><span class="badge blue">3</span></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <div class="notification_header">
                                            <h3>You have 3 new notification</h3>
                                        </div>
                                    </li>
                                    <li><a href="#">
                                            <div class="user_img"><img src="<?=base_url()?>/assets/images/in8.jpg" alt=""></div>
                                            <div class="notification_desc">
                                                <p>Lorem ipsum dolor</p>
                                                <p><span>1 hour ago</span></p>
                                            </div>
                                            <div class="clearfix"></div>
                                        </a></li>
                                    <li class="odd"><a href="#">
                                            <div class="user_img"><img src="<?=base_url()?>/assets/images/in6.jpg" alt=""></div>
                                            <div class="notification_desc">
                                                <p>Lorem ipsum dolor</p>
                                                <p><span>1 hour ago</span></p>
                                            </div>
                                            <div class="clearfix"></div>
                                        </a></li>
                                    <li><a href="#">
                                            <div class="user_img"><img src="<?=base_url()?>/assets/images/in7.jpg" alt=""></div>
                                            <div class="notification_desc">
                                                <p>Lorem ipsum dolor</p>
                                                <p><span>1 hour ago</span></p>
                                            </div>
                                            <div class="clearfix"></div>
                                        </a></li>
                                    <li>
                                        <div class="notification_bottom">
                                            <a href="#">See all notifications</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown head-dpdn">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-tasks"></i><span class="badge blue1">9</span></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <div class="notification_header">
                                            <h3>You have 8 pending task</h3>
                                        </div>
                                    </li>
                                    <li><a href="#">
                                            <div class="task-info">
                                                <span class="task-desc">Database update</span><span class="percentage">40%</span>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="progress progress-striped active">
                                                <div class="bar yellow" style="width:40%;"></div>
                                            </div>
                                        </a></li>
                                    <li><a href="#">
                                            <div class="task-info">
                                                <span class="task-desc">Dashboard done</span><span class="percentage">90%</span>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="progress progress-striped active">
                                                <div class="bar green" style="width:90%;"></div>
                                            </div>
                                        </a></li>
                                    <li><a href="#">
                                            <div class="task-info">
                                                <span class="task-desc">Mobile App</span><span class="percentage">33%</span>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="progress progress-striped active">
                                                <div class="bar red" style="width: 33%;"></div>
                                            </div>
                                        </a></li>
                                    <li><a href="#">
                                            <div class="task-info">
                                                <span class="task-desc">Issues fixed</span><span class="percentage">80%</span>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="progress progress-striped active">
                                                <div class="bar  blue" style="width: 80%;"></div>
                                            </div>
                                        </a></li>
                                    <li>
                                        <div class="notification_bottom">
                                            <a href="#">See all pending tasks</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <div class="clearfix"> </div>
                        </ul>
                        <div class="clearfix"> </div>
                    </div>
                    <!--notification menu end -->

                    <div class="clearfix"> </div>
                </div>
                <div class="profile_details w3l">
                    <ul>
                        <li class="dropdown profile_details_drop">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <div class="profile_img">
                                    <span class="prfil-img"><img src="<?=base_url()?>/assets/images/in4.jpg" alt=""> </span>
                                    <div class="user-name">
                                        <p>Administrator</p>
                                        <span>Administrator</span>
                                    </div>
                                    <i class="fa fa-angle-down"></i>
                                    <i class="fa fa-angle-up"></i>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                            <ul class="dropdown-menu drp-mnu">
                                <li> <a href="#"><i class="fa fa-cog"></i> Settings</a> </li>
                                <li> <a href="#"><i class="fa fa-user"></i> Profile</a> </li>
                                <li> <a href="<?=base_url('main/clogout')?>"><i class="fa fa-sign-out"></i> Logout</a> </li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="clearfix"> </div>
            </div>
            <!--header end here-->