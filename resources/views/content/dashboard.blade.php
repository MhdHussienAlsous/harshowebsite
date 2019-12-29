<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  
  <title>Hashtag - Dashboard</title>

  <!-- Favicons -->

  <link href="{{ asset('img/favicon.png') }}" rel="icon">
  <link href="{{ asset('img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Bootstrap core CSS -->
  <link href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <!--external css-->
  <link href="{{ asset('lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="{{ asset('css/zabuto_calendar.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('lib/gritter/css/jquery.gritter.css') }}" />


  <link rel="stylesheet" type="text/css" href="{{ asset('lib/bootstrap-fileupload/bootstrap-fileupload.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('lib/bootstrap-datepicker/css/datepicker.css') }}" />

  <!-- Custom styles for this template -->
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('css/style-responsive.css') }}" rel="stylesheet">
  <link href="{{ asset('css/mystyle.css') }}" rel="stylesheet">
  <script src="{{ asset('lib/chart-master/Chart.js') }}"></script>



  <link href="{{ asset('lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="{{ asset('lib/bootstrap-fileupload/bootstrap-fileupload.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('lib/bootstrap-datepicker/css/datepicker.css') }}
  " />
  <link rel="stylesheet" type="text/css" href="{{ asset('lib/bootstrap-daterangepicker/daterangepicker.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('lib/bootstrap-timepicker/compiled/timepicker.css') }}" />
  <!-- <link rel="stylesheet" type="text/css" href="{{ asset('lib/bootstrap-datetimepicker/datertimepicker.css') }}" /> -->
  <!-- Custom styles for this template -->
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('css/style-responsive.css') }}" rel="stylesheet">
  

  <!-- script for editor -->

</head>

<body>
  <section id="container">
    <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
        <!--header start-->
        <header class="header black-bg">
          <div class="sidebar-toggle-box">
            <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
          </div>
          <!--logo start-->
          <a href="/" class="logo"><b><span>Hashtag</span></b></a>
          <!--logo end-->

          <div class="top-menu">
            <ul class="nav pull-right top-menu">
              <li><a class="logout" href="/logout">Logout</a></li>
            </ul>
          </div>
        </header>
        <!--header end-->
    <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
        <!--sidebar start-->
        <aside>
          <div id="sidebar" class="nav-collapse ">
            <!-- sidebar menu start-->
            <ul class="sidebar-menu" id="nav-accordion">
              <p class="centered"><a href="#"><img src="{{ url(Auth::user()->person->image) }}" class="img-circle" width="80"></a></p>
              <h5 class="centered">{{ Auth::user()->person->name }}</h5>
              <li class="mt">
                <a class="active" href="#">
                  <i class="fa fa-dashboard"></i>
                  <span>Dashboard</span>
                </a>
              </li>

              <!-- users tab -->
              @if(Auth::check())
              <li class="sub-menu">
                <a href="javascript:;">
                  <i class="fa fa-user"></i>
                  <span>Users</span>
                </a>
                <ul class="sub">
                  <li><a href="/all-users">All users</a></li>
                  @permission('add-user')
                  <li><a href="/add-user">Add user</a></li>
                  @endpermission
                </ul>
              </li>
              @endif
              <!-- end users tab -->

              <!-- catgory tab -->
              @if(Auth::check())
              <li class="sub-menu">
                <a href="javascript:;">
                  <i class="fa fa-list-alt"></i>
                  <span>Categories</span>
                </a>
                <ul class="sub">
                  <li><a href="/all-categories">All categories</a></li>
                  @permission('add-category')
                  <li><a href="/add-category">Add category</a></li>
                  @endpermission
                </ul>
              </li>
              @endif
              <!-- end catgory tab -->

              <!-- menu tab -->
              @if(Auth::check())
              <li class="sub-menu">
                <a href="javascript:;">
                  <i class="fa fa-bars"></i>
                  <span>Menus</span>
                </a>
                <ul class="sub">
                  <li><a href="/all-menus">All menus</a></li>
                  @permission('add-menu')
                  <li><a href="/add-menu">Add menu</a></li>
                  @endpermission
                </ul>
              </li>
              @endif
              <!-- end menu tab -->          

              <li class="sub-menu">
                <a href="javascript:;">
                  <i class="fa fa-newspaper-o"></i>
                  <span>Items</span>
                </a>
                <ul class="sub">
                  <li><a href="/all-items">All items</a></li>
                  @permission('add-item')
                  <li><a href="/add-item">Add item</a></li>
                  @endpermission
                </ul>
              </li>

              <!-- phone numbers tab -->
              @if(Auth::check())
                <li class="sub-menu">
                  <a href="javascript:;">
                    <i class="fa fa-phone"></i>
                    <span>Phone Numbers</span>
                  </a>
                  <ul class="sub">
                    <li><a href="/allPhones">All Phones</a></li>
                    <li><a href="/add-phone">Add Phone Number</a></li>
                  </ul>
                </li>
              @endif
              <!-- end phone numbers tab -->  

              <!-- divan tab -->
              @if(Auth::check())
                <li class="sub-menu">
                  <a href="javascript:;">
                    <i class="fa fa-archive"></i>
                    <span>Divan</span>
                  </a>
                  <ul class="sub">
                    <li><a href="/allDivans">All Divans</a></li>
                    <li><a href="/add-divan">Add Divan</a></li>
                  </ul>
                </li>
              @endif
              <!-- end divan tab -->  

              <!-- tags tab -->
              @if(Auth::check())
              <li class="sub-menu">
                <a href="javascript:;">
                  <i class="fa fa-tags"></i>
                  <span>Tags</span>
                </a>
                <ul class="sub">
                  <li><a href="/all-tags">All tags</a></li>
                  @permission('add-tag')
                  <li><a href="/add-tag">Add tag</a></li>
                  @endpermission
                </ul>
              </li>
              @endif
              <!-- end tags tab -->  
              
              
            <!-- offer tab -->
              @if(Auth::check())
                <li class="sub-menu">
                  <a href="javascript:;">
                    <i class="fa fa-archive"></i>
                    <span>Offers</span>
                  </a>
                  <ul class="sub">
                    <li><a href="/allOffers">All Offers</a></li>
                    <li><a href="/add-offer">Add Offer</a></li>
                  </ul>
                </li>
              @endif
              <!-- end offer tab --> 

            </ul>
            <!-- sidebar menu end-->
          </div>
        </aside>
        <!--sidebar end-->
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
        <!--main content start-->
        <section id="main-content">
          <section class="wrapper site-min-height">
            <div class="row">
              <div class="col-lg-9 main-chart">
                @yield('content')
              </div>
              <!-- /col-lg-9 END SECTION MIDDLE -->
          <!-- **********************************************************************************************************************************************************
              RIGHT SIDEBAR CONTENT
              *********************************************************************************************************************************************************** -->
              <div class="col-lg-3 ds">
                <!-- CALENDAR-->
                <div id="calendar" class="mb">
                  <div class="panel green-panel no-margin">
                    <div class="panel-body">
                      <div id="date-popover" class="popover top" style="cursor: pointer; disadding: block; margin-left: 33%; margin-top: -50px; width: 175px;">
                        <div class="arrow"></div>
                        <h3 class="popover-title" style="disadding: none;"></h3>
                        <div id="date-popover-content" class="popover-content"></div>
                      </div>
                      <div id="my-calendar"></div>
                    </div>
                  </div>
                </div>
                <!-- / calendar -->
              </div>
              <!-- /col-lg-3 -->
            </div>
            <!-- /row -->
          </section>
        </section>
        <!--main content end-->
        <!--footer start-->
        <footer class="site-footer">
          <div class="text-center">
            <p>
              &copy; Copyrights <strong>Postaty</strong>. All Rights Reversed
            </p>
            <a href="index.html#" class="go-top">
              <i class="fa fa-angle-up"></i>
            </a>
          </div>
        </footer>
        <!--footer end-->
      </section>

      
      <!-- js placed at the end of the document so the pages load faster -->
      <script src="{{ asset('lib/jquery/jquery.min.js') }}"></script>

      <script src="{{ asset('lib/bootstrap/js/bootstrap.min.js') }}"></script>
      <script class="include" type="text/javascript" src="{{ asset('lib/jquery.dcjqaccordion.2.7.js') }}"></script>
      <script src="{{ asset('lib/jquery.scrollTo.min.js') }}"></script>
      <script src="{{ asset('lib/jquery.nicescroll.js') }}" type="text/javascript"></script>
      <script src="{{ asset('lib/jquery.sparkline.js') }}"></script>
      <!--common script for all pages-->
      <script src="{{ asset('lib/common-scripts.js') }}"></script>
      <script type="text/javascript" src="{{ asset('lib/gritter/js/jquery.gritter.js') }}"></script>
      <script type="text/javascript" src="{{ asset('lib/gritter-conf.js') }}"></script>
      <!--script for this page-->
      <script src="{{ asset('lib/sparkline-chart.js') }}"></script>
      <script src="{{ asset('lib/zabuto_calendar.js') }}"></script>


      <script src="{{ asset('lib/jquery-ui-1.9.2.custom.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('lib/bootstrap-fileupload/bootstrap-fileupload.js') }}"></script>
      <script type="text/javascript" src="{{ asset('lib/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>

      <script src="{{ asset('lib/advanced-form-components.js') }}"></script>

      <!-- my special script -->
      <script src="{{ asset('js/myJs.js') }}"></script>


      <script type="application/javascript">
        $(document).ready(function() {
          $("#date-popover").popover({
            html: true,
            trigger: "manual"
          });
          $("#date-popover").hide();
          $("#date-popover").click(function(e) {
            $(this).hide();
          });

          $("#my-calendar").zabuto_calendar({
            action: function() {
              return myDateFunction(this.id, false);
            },
            action_nav: function() {
              return myNavFunction(this.id);
            },
            ajax: {
              url: "show_data.php?action=1",
              modal: true
            },
            legend: [{
              type: "text",
              label: "Special event",
              badge: "00"
            },
            {
              type: "block",
              label: "Regular event",
            }
            ]
          });
        });

        function myNavFunction(id) {
          $("#date-popover").hide();
          var nav = $("#" + id).data("navigation");
          var to = $("#" + id).data("to");
          console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
      </script>

      <script type="text/javascript">
        var token     = "{{ Session::token() }}";
      </script>



    </body>

    </html>
