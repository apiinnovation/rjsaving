<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title')</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="icon" type="image/png" href="{{asset('images/icons/favicon.ico')}}"/>
        
        
        <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome2.css')}}">
        <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
        <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
        <link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.css')}}">
        <link rel="stylesheet" href="{{asset('bower_components/morris.js/morris.css')}}">
        <link rel="stylesheet" href="{{asset('bower_components/jvectormap/jquery-jvectormap.css')}}">
        <link rel="stylesheet" href="{{asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
        <link rel="stylesheet" href="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/iCheck/all.css')}}">
        <link rel="stylesheet" href="{{asset('css/sweetalert.min.css')}}"> 
        <link rel="stylesheet" href="{{asset('bower_components/select2/dist/css/select2.min.css')}}">
        
        <link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">     
        <link rel="stylesheet" href="{{asset('css/select.bootstrap.css')}}">
        
        <link rel="stylesheet" href="{{asset('css/datepicker.css')}}">
        <link rel="stylesheet" href="{{asset('css/apidefault.css')}}">
        <style >
            .navbar-nav>.notifications-menu>.dropdown-menu>li .menu, .navbar-nav>.messages-menu>.dropdown-menu>li .menu, .navbar-nav>.tasks-menu>.dropdown-menu>li .menu{
                max-height: 220px;
            }
        </style>

        <link rel="stylesheet" href="{{asset('css/fonts-googleapis.css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic')}}">
        
        <script src="{{asset('js/sweetalert.min.js')}}"></script>
        @yield('header')
    </head>
    <body class="hold-transition skin-green sidebar-mini">
        <div class="wrapper">

            <!-- Menu Head -->
            <header class="main-header">
                <!-- Logo -->
                <a href="{{url('/')}}" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>R</b>J</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>RJ</b> Saving</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">


                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="user user-menu">
                                <a href="{{url('/')}}" >
                                    <img src="{{asset('dist/img/bch.png')}}" class="user-image" alt="สาขา">
                                    <span class="hidden-xs">{{ Auth::user()->XVBchName }}</span>
                                </a>
                            </li>

                            <li class="user user-menu">
                                <a href="{{ url('/logout') }}" >
                                    <img src="{{asset('dist/img/logout.png')}}" class="user-image" alt="ออกจากระบบ">
                                    <span class="hidden-xs">ออกจากระบบ</span>
                                </a>
                            </li>

                            <li class="dropdown notifications-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-gears"></i>
                                </a>
                                <ul class="dropdown-menu">

                                    <li>
                                        <ul class="menu">
                                            <li>
                                                <a href="{{url('/regis_main')}}">
                                                    <i class="fa fa-users text-aqua"></i> ผู้ใช้งาน
                                                </a>
                                            </li>
                                            <!--                  <li>
                                                                <a href="{{url('/login')}}">
                                                                  <i class="fa fa-star text-yellow"></i> กำหนดสิทธิ์การใช้งาน
                                                                </a>
                                                              </li>-->
                                            <li>
                                                <a href="{{url('/company')}}">
                                                    <i class="fa fa-home text-red"></i> ข้อมูลบริษัท
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{url('/branch')}}">
                                                    <i class="fa fa-sitemap text-green"></i> ข้อมูลสาขา
                                                </a>
                                            </li>                  
                                            <li>
                                                <a href="{{url('/TCusTDivision')}}">
                                                    <i class="fa fa-th-large text-orange"></i> ข้อมูลแผนก
                                                </a>
                                            </li>                  
                                            <li>
                                                <a href="{{url('/TComMPrefix')}}">
                                                    <i class="fa fa-user text-blue"></i> คำนำหน้านาม
                                                </a>
                                            </li>                  
                                        </ul>
                                </ul>
                            </li>

                        </ul>
                    </div>
                </nav>
            </header>

            <!-- Menu Left -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="{{asset('dist/img/user.png')}}" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p>{{ Auth::user()->XVPreName ." ".Auth::user()->XVUserFName ." ".Auth::user()->XVUserLName }}</p>
                            <a href="#">
                                <i class="fa fa-circle text-success"></i><span>Online</span>
                            </a>
                        </div>
                    </div>

                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu" data-widget="tree">
                        <li class="header">MAIN NAVIGATION</li>
                        <li>
                            <a href="{{url('/')}}">
                                <i class="fa fa-home"></i> <span>หน้าแรก</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa ion-person-add"></i> <span>กองทุน</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li id="li-savemem"><a href="{{url('/savemem')}}"><i class="fa fa-circle-o"></i> ข้อมูลสมาชิก</a></li>
                                <li id="li-saveup"><a href="{{url('/stkup_main')}}"><i class="fa fa-circle-o"></i> ขอเพิ่มหุ้น</a></li>
                                <li id="li-savereduce"><a href="{{url('/stkdown_main')}}"><i class="fa fa-circle-o"></i> ขอลดหุ้น</a></li>
                                <li id="li-savewithdraw"><a href="{{url('/savewithdraw')}}"><i class="fa fa-circle-o"></i> ขอถอนเงิน</a></li>
                                <li id="li-saveresign"><a href="{{url('/saveresign')}}"><i class="fa fa-circle-o"></i> ขอลาออก</a></li>
                                <li id="li-savehistory"><a href="{{url('/savhistory')}}"><i class="fa fa-circle-o"></i> ประวัติสมาชิก</a></li>
                                <li id="li-savecondit"><a href="{{url('/savcondit')}}"><i class="fa fa-circle-o"></i> เงื่อนไขกองทุน</a></li>
                            </ul>
                        </li>

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-laptop"></i> <span>เงินกู้</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="active"><a href="{{url('/loanRegis')}}"><i class="fa fa-circle-o"></i> ขอกู้</a></li>
                                <li><a href="{{url('/loanChange')}}"><i class="fa fa-circle-o"></i> ขอเปลี่ยนเงื่อนไข</a></li>
                                <li><a href="{{url('/loanCondition')}}"><i class="fa fa-circle-o"></i> ประเภทเงินกู้</a></li>
                            </ul>
                        </li>        

                        <li>
                            <a href="{{url('/dividend')}}">
                                <i class="fa fa-th"></i> <span>ปันผล</span>
                            </a>
                        </li>


                        <li>
                            <a href="{{url('/chart')}}">
                                <i class="fa fa-pie-chart"></i> <span>กราฟ</span>
                            </a>
                        </li>
                        <!-- kj -->
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-file-o"></i> <span>1. รายงานกองทุน</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="active"><a href="{{url('/rpt011')}}"><i class="fa fa-circle-o"></i>1.1 รายงานเงินสะสม</a></li>
                                <li><a href="{{url('/rp1')}}"><i class="fa fa-circle-o"></i>1.2 ใบสรุปรายงานเงินสะสม</a></li>
                                <li><a href="{{url('/rp2')}}"><i class="fa fa-circle-o"></i>1.3 รายงานสถานภาพสมาชิก</a></li>
                                <li><a href="{{url('/rpt013')}}"><i class="fa fa-circle-o"></i>1.4 รายงานสมาชิกเข้าใหม่</a></li>
                                <li><a href="{{url('/rpt13')}}"><i class="fa fa-circle-o"></i>1.5 รายงานการเพิ่มหุ้น</a></li>
                                <li><a href="{{url('/rpt14')}}"><i class="fa fa-circle-o"></i>1.6 รายงานการลดหุ้น</a></li>
                                <li><a href="{{url('/rpt43')}}"><i class="fa fa-circle-o"></i>1.7 รายงานการถอนเงิน</a></li>
                                <li><a href="{{url('/rpt17')}}"><i class="fa fa-circle-o"></i>1.8 รายงานการลาออก</a></li>
                                <li><a href="{{url('/rpt19')}}"><i class="fa fa-circle-o"></i>1.9 รายงานผลต่างเงินสะสม</a></li>
                            </ul>
                        </li>  


                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-file-o"></i> <span>2. รายงานเงินกู้</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="active"><a href="{{url('/rpt22')}}"><i class="fa fa-circle-o"></i>2.1 รายชื่อผู้ขอกู้</a></li>
                                <li><a href="{{url('/rpt23')}}"><i class="fa fa-circle-o"></i>2.2 รายชื่อผู้ที่ได้รับอนุมัติเงินกู้</a></li>
                                <li><a href="{{url('/rpt24')}}"><i class="fa fa-circle-o"></i>2.3 ใบบัญชีเงินกู้(รายบุคคล)</a></li>
                                <li><a href="{{url('/rpt21')}}"><i class="fa fa-circle-o"></i>2.4 รายงานชำระคืนเงินกู้</a></li>

                            </ul>
                        </li> 

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-file-o"></i> <span>3. รายงานปันผล</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="active"><a href="{{url('/rp3_1')}}"><i class="fa fa-circle-o"></i>3.1 การคำนวนเงินปันผล</a></li>
                                <li><a href="{{url('/rpt32')}}"><i class="fa fa-circle-o"></i>3.2 รายงานเงินปันผล</a></li>
                                <li><a href="{{url('/rpt33')}}"><i class="fa fa-circle-o"></i>3.3 พิมพ์สลิปกองทุน</a></li>

                            </ul>
                        </li> 

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-file-o"></i> <span>4. รายงานสรุป</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="active"><a href="{{url('/rpt041')}}"><i class="fa fa-circle-o"></i>4.1 เปรียบเทียบการเพิ่มหุ้น</a></li>
                                <li><a href="{{url('/rpt42')}}"><i class="fa fa-circle-o"></i>4.2 เปรียบเทียบการลดหุ้น</a></li>
                                <li><a href="{{url('/rpt043')}}"><i class="fa fa-circle-o"></i>4.3 เปรียบเทียบการถอนเงิน</a></li>
                                <li><a href="{{url('/rpt44')}}"><i class="fa fa-circle-o"></i>4.4 เปรียบเทียบการลาออก</a></li>
                                <li><a href="{{url('/rpt45')}}"><i class="fa fa-circle-o"></i>4.5 เปรียบเทียบอนุมัติเงินกู้</a></li>
                                <li><a href="{{url('/rpt41')}}"><i class="fa fa-circle-o"></i>4.6 สรุปยอดเงินอนุมัติกู้ประจำปี</a></li>
                                <li><a href="{{url('/rpt47')}}"><i class="fa fa-circle-o"></i>4.7 สรุปยอดเงินปันผล</a></li>
                            </ul>
                        </li> 

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-file-o"></i> <span>5. พิมพ์ใบสำคัญรับ/จ่าย</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="active"><a href="{{url('/rptin01')}}"><i class="fa fa-circle-o"></i>5.1 ใบสำคัญรับ</a></li>
                                <li><a href="{{url('/rptout01')}}"><i class="fa fa-circle-o"></i>5.2 ใบสำคัญจ่าย</a></li>
                            </ul>
                        </li> 

                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Control Panel -->
            <div class="content-wrapper">

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- Main content -->

                        @yield('content')

                        <!-- /.content -->
                        
                    </div>
                </section>

            </div>
            <!-- END Control Panel -->

            <a href="javascript:" id="return-to-top"><i class="icon-chevron-up"></i></a>

            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>ระบบกองทุนฯ </b> 1.0.0
                </div>
                <strong>สงวนลิขสิทธิ์ © 2018 ห้างหุ้นส่วนจำกัด รัจนาการ (2530)</strong>
            </footer>


        </div>
        <!-- ./wrapper -->

        <script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
        <script src="{{asset('bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('bower_components/raphael/raphael.min.js')}}"></script>
        <script src="{{asset('bower_components/morris.js/morris.min.js')}}"></script>
        <script src="{{asset('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
        <script src="{{asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
        <script src="{{asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
        <script src="{{asset('bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
        <script src="{{asset('bower_components/moment/min/moment.min.js')}}"></script>
        <script src="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
        <script src="{{asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
        <script src="{{asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
        <script src="{{asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
        <script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
        <script src="{{asset('dist/js/adminlte.min.js')}}"></script>
        <script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script>
        <script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
        <script src="{{asset('js/dataTables.select.min.js')}}"></script>
        <script src="{{asset('dist/js/demo.js')}}"></script>
        <script src="{{asset('js/sweetalert.min.js')}}"></script>
        <script src="{{asset('js/bootstrap-datepicker.js')}}"></script>
        <script src="{{asset('js/bootstrap-datepicker-thai.js')}}"></script>
        <script src="{{asset('js/bootstrap-datepicker.th.js')}}"></script>
        <script src="{{asset('plugins/input-mask/jquery.inputmask.js')}}"></script>
        <script src="{{asset('plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
        <script src="{{asset('plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
        <script src="{{asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>

        <script src="{{asset('js/apimain.js')}}"></script>
        @yield('footer')
        <script type="text/javascript">

$(document).ready(function () {

    // ===== Scroll to Top ==== 
    $(window).scroll(function () {
        if ($(this).scrollTop() >= 50) {        
            $('#return-to-top').fadeIn(200);    
        } else {
            $('#return-to-top').fadeOut(200);  
        }
    });

    $('#return-to-top').click(function () {      
        $('body,html').animate({
            scrollTop: 0                       
        }, 500);
    });

    var url = window.location;

    $('.sidebar-menu li').removeClass('active');
    $('.sidebar-menu li a[href="' + url + '"]').parent().addClass('active menu-open');
    $('.sidebar-menu ul a[href="' + url + '"]').parents('li').addClass('active menu-open');
});

        </script>

    </body>
</html>
