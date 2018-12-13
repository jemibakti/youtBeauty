<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url('assets/AdminLTE-2.0.5/dist/img/user2-160x160.jpg') ?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p><?php echo $this->session->userdata('logged_in')['user_desc']?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                    <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MANAGEMENT</li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-share"></i> <span>MANAGEMENT</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url().'adm/user';?>"><i class="fa fa-circle-o text-warning"></i> User</a></li>
                    <li><a href="<?php echo base_url().'adm/userRole';?>"><i class="fa fa-circle-o text-warning"></i> User Role</a></li>
                    <li><a href="<?php echo base_url().'adm/menu';?>"><i class="fa fa-circle-o text-warning"></i> Menu</a></li>
                    <li><a href="<?php echo base_url().'adm/menuRole';?>"><i class="fa fa-circle-o text-warning"></i> Menu Role</a></li>
                    <li>
                        <a href="#"><i class="fa fa-circle-o"></i> Mail <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="#"><i class="fa fa-circle-o text-warning"></i> Template</a></li>
                            <li>
                                <a href="#"><i class="fa fa-circle-o text-warning"></i> Recipent <i class="fa fa-angle-left pull-right"></i></a>
                                <ul class="treeview-menu">
                                    <li><a href="#"><i class="fa fa-circle-o"></i> All</a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i> Specific</a></li>
                                </ul>
                            </li>
                            <li><a href="#"><i class="fa fa-circle-o"></i> Scheduller</a></li>
                        </ul>
                    </li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="fa fa-book"></i> Documentation</a></li>
            <li class="header">LABELS</li>
            <li><a href="#"><i class="fa fa-circle-o text-danger"></i> Important</a></li>
            <li><a href="#"><i class="fa fa-circle-o text-warning"></i> Warning</a></li>
            <li><a href="#"><i class="fa fa-circle-o text-info"></i> Information</a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">