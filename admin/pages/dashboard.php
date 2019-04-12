<?php
$db = Xcrud_db::get_instance();
$db->query("SELECT * FROM `admin`"); // executes query
$add = $db->row();
//echo "<h4>Welcome to Traverse Superadmin Administration panel for whole site</h4>";

?>
<style>.page_title{ display:none;} .page_description { display:none;} </style>
<!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
<!-- AdminLTE Skins. Choose a skin from the css/skins
     folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
<!-- Morris chart -->
<link rel="stylesheet" href="bower_components/morris.js/morris.css">
<!-- jvectormap -->
<link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
<!-- Date Picker -->
<link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<!-- Daterange picker -->
<link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<script src="bower_components/raphael/raphael-new.js"></script>
<script src="bower_components/morris.js/jquery-morris.js"></script>
<script src="bower_components/morris.js/morris-new.js"></script>
<script src="bower_components/morris.js/polararea.js"></script>
<!-- Load the JavaScript API client and Sign-in library. -->
<script src="https://apis.google.com/js/client:platform.js"></script>

<?php
$db = Xcrud_db::get_instance();
$db->query("SELECT count(*) as total FROM `users` WHERE `user_type` != 'Agent'");
$users = $db->result();

$db->query("SELECT count(*) as total FROM `users` WHERE `user_type` != 'Agent' AND featured = 1");
$usersfeatured = $db->result();


$db->query("SELECT count(*) as total FROM `users` WHERE `user_type` != 'Agent' AND DATE(registered_date) = CURDATE()");
$usersdaily = $db->result();

$db->query("SELECT count(*) as total FROM `users` WHERE `user_type` != 'Agent' AND YEARWEEK(`registered_date`, 1) = YEARWEEK(CURDATE(), 1)");
$usersweek = $db->result();

$db->query("SELECT count(*) as total FROM `users` WHERE `user_type` != 'Agent' AND DATE(registered_date) >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)");
$usersmonthly = $db->result();

$db->query("SELECT count(*) as total FROM `users` WHERE `user_type` = 'Agent'");
$agents = $db->result();

$db->query("SELECT count(*) as total FROM `users` WHERE `user_type` = 'Agent' AND DATE(registered_date) = CURDATE()");
$agentsdaily = $db->result();

$db->query("SELECT count(*) as total FROM `users` WHERE `user_type` = 'Agent' AND YEARWEEK(`registered_date`, 1) = YEARWEEK(CURDATE(), 1)");
$agentsweekly = $db->result();

$db->query("SELECT count(*) as total FROM `users` WHERE `user_type` = 'Agent' AND DATE(registered_date) >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)");
$agentsmonth = $db->result();

$db->query("SELECT count(*) as total FROM `listing`");
$listing = $db->result();
$db->query("SELECT count(*) as total FROM `listing` WHERE DATE(date_created) = CURDATE()");
$listingtoday = $db->result();

$db->query("SELECT count(*) as total FROM `listing` WHERE YEARWEEK(`date_created`, 1) = YEARWEEK(CURDATE(), 1)");
$listingweek = $db->result();

$db->query("SELECT count(*) as total FROM `listing` WHERE DATE(date_created) >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)");
$listingmonthly = $db->result();

$db->query("SELECT count(*) as total FROM `listing` WHERE is_featured = 1");
$listingfeat = $db->result();

$db->query("SELECT MONTHNAME(registered_date) as month, COUNT(id) as ag FROM users GROUP BY MONTH(registered_date) ASC");
$userRegister = $db->result();
foreach ($userRegister as $user){
     $agentsbymonth[]= $user['ag'];
    $month[]= $user['month'];
}
$monthby= json_encode($month);
 $agentbym= json_encode($agentsbymonth);
$db->query("SELECT COUNT(id) as us FROM users WHERE `user_type` = 'Renter' GROUP BY MONTH(registered_date) ASC");
$renter = $db->result();
foreach ($renter as $u){
    $renterbymonth[]= $u['us'];
}
$renterbym= json_encode($renterbymonth);


$db->query("SELECT count(id) as total,
    count(CASE WHEN `user_type` LIKE '%Agent%' THEN 1 END) AS agents,
    count(CASE WHEN `user_type` LIKE '%Renter%' THEN 1 END) AS renters
FROM `users`; ");
$donutdata = $db->result();

$db->query("SELECT count(*) as claimed FROM `users` WHERE `user_type` = 'Agent' AND claimed = 1");
$claimed = $db->result();
$db->query("SELECT count(*) as unclaimed FROM `users` WHERE `user_type` = 'Agent' AND claimed = 0");
$unclaimed = $db->result();


?>



<div class="content-wrapper" style="margin-left: 0">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">

          <!-- small box -->
          <div class="small-box bg-aqua">


            <div class="inner">
                <div class="form-group rightselect">
                    <select name="ProductSelector" id="ProductSelector" class="form-control">
                        <option value="<?php echo $users[0]['total']; ?>" >Total</option>
                        <option value="<?php echo $usersdaily[0]['total']; ?>">Daily</option>
                        <option value="<?php echo $usersweek[0]['total']; ?>">Weekly</option>
                        <option value="<?php echo $usersmonthly[0]['total'] ?>">Montly</option>
                    </select>
                </div>


              <h3 id="some"><?php echo $users[0]['total']; ?></h3>

              <p>Total Users</p>
            </div>

            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
                <div class="form-group rightselect">
                    <select name="agentSelector" id="agentSelector" class="form-control">
                        <option value="<?php echo $agents[0]['total']; ?>" >Total</option>
                        <option value="<?php echo $agentsdaily[0]['total']; ?>">Daily</option>
                        <option value="<?php echo $agentsweekly[0]['total']; ?>">Weekly</option>
                        <option value="<?php echo $agentsmonth[0]['total'] ?>">Montly</option>
                    </select>
                </div>
              <h3 id="agents"><?php echo $agents[0]['total'];?></h3>

              <p>Total Agents</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $listingfeat[0]['total'];?></h3>

              <p>Featured listings</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $usersfeatured[0]['total'];?></h3>

              <p>Featured Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>


        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-olive">
                    <div class="inner">
                        <h3><?php if($listing){ echo $listing[0]['total'];}else{ echo '0';} ?></h3>

                        <p>Total Listings</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-blue">
                    <div class="inner">
                        <h3><?php if($listingtoday){ echo $listingtoday[0]['total'];}else{ echo '0';} ?> </h3>

                        <p>Daily Listings</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-teal">
                    <div class="inner">
                        <h3><?php if($listingweek){ echo $listingweek[0]['total'];}else{ echo '0';} ?></h3>

                        <p>Weekly Listings</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?php if($listingmonthly){ echo $listingmonthly[0]['total'];}else{ echo '0';} ?></h3>

                        <p>Monthly Listings</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>

        <!-- /.row -->
        <div class="row rowpadd" >
            <div class="col-lg-6 col-xs-12">
            <div class="view-selector" id="view-selector-1-container"></div>
            <div id="embed-api-auth-container" style="display: none"></div>
            </div>
        </div>

      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
            <!-- /.nav-tabs-custom -->
            <div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <ul class="nav nav-tabs pull-right">
                    <li class="pull-left header"><i class="fa fa-inbox"></i>Visitors By Regions</li>
                </ul>
                <div class="tab-content no-padding">
                    <div id="chart-1-container" style="padding-top: 20px;"></div>

                </div>
            </div>
            <div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <ul class="nav nav-tabs pull-right">
                    <li class="pull-left header"><i class="fa fa-inbox"></i>Visitors By Country</li>
                </ul>
                <div class="tab-content no-padding">
                    <div id="chart-2-container"></div>

                </div>
            </div>
            <div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <ul class="nav nav-tabs pull-right">
                    <li class="pull-left header"><i class="fa fa-inbox"></i>Claimed / Unclaimed Agents</li>
                </ul>
                <div class="tab-content no-padding">
                    <canvas id="pieChart" style="height:250px"></canvas>

                </div>
            </div>

            <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="active"><a href="#revenue-chart" data-toggle="tab">Stats by month</a></li>
             <!-- <li><a href="#sales-chart" data-toggle="tab">All Users</a></li>-->
              <li class="pull-left header"><i class="fa fa-inbox"></i>Users Register Stats</li>
            </ul>
            <div class="tab-content no-padding">
                <div class="box-body">
                    <div class="foo ag"><span style="padding-left: 5px;">Agents</span></div>
                    <div class="foo us"><span style="padding-left: 5px;">Users</span></div>
                    <div class="chart">
                        <!--<canvas id="areaChart" style="height:250px"></canvas>-->
                        <canvas id="barChart" style="height:230px"></canvas>
                    </div>
                </div>
            </div>
          </div>


        </section>
        <section class="col-lg-5 connectedSortable">

          <!-- Map box -->
          <div class="box box-solid bg-light-blue-gradient">
            <div class="box-header">
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-primary btn-sm daterange pull-right" title="Date range" style="display: none;">
                  <i class="fa fa-calendar"></i></button>
                <button type="button" class="btn btn-primary btn-sm pull-right" data-widget="collapse"
                         title="Collapse" style="margin-right: 5px; display: none;">
                  <i class="fa fa-minus"></i></button>
              </div>
              <h3 class="box-title">
                Daily Visitors
              </h3>
            </div>
            <div class="box-body">
                <div id="chart-container12"></div>

            </div>
          </div>
            <div class="box box-solid bg-light-blue-gradient">
                <div class="box-header">
                    <!-- tools box -->
                    <div class="pull-right box-tools">
                        <button type="button" class="btn btn-primary btn-sm daterange pull-right" title="Date range" style="display: none;">
                            <i class="fa fa-calendar"></i></button>
                        <button type="button" class="btn btn-primary btn-sm pull-right" data-widget="collapse"
                                title="Collapse" style="margin-right: 5px; display: none;">
                            <i class="fa fa-minus"></i></button>
                    </div>
                    <h3 class="box-title">
                        Users By Type
                    </h3>
                </div>

                <div class="box-body">
                        <!-- Morris chart - Sales -->
                        <div class="chart tab-pane active" id="sales-chart" style="position: relative; height: 300px; background-color: #fff"></div>


                </div>
            </div>

            <div class="box box-solid bg-light-blue-gradient">
                <div class="box-header">
                    <!-- tools box -->
                    <div class="pull-right box-tools">
                        <button type="button" class="btn btn-primary btn-sm daterange pull-right" title="Date range" style="display: none;">
                            <i class="fa fa-calendar"></i></button>
                        <button type="button" class="btn btn-primary btn-sm pull-right" data-widget="collapse"
                                title="Collapse" style="margin-right: 5px; display: none;">
                            <i class="fa fa-minus"></i></button>
                    </div>
                    <h3 class="box-title">
                        Visitors By Browsers
                    </h3>
                </div>

                <div class="box-body">
                    <div id="main-chart-container"></div>
                    <div id="breakdown-chart-container"></div>


                </div>
            </div>

      </div>

        <!--<section class="col-lg-12 connectedSortable">

                <div class="nav-tabs-custom padcostm">

                    <ul class="nav nav-tabs pull-right">
                        <li class="pull-left header"><i class="fa fa-inbox"></i>Visitors By Browsers</li>
                    </ul>
                    <div class="tab-content no-padding">


                    </div>
                </div>


            </section>-->


        </section>


      </div>
    </section>
    <!-- /.content -->
</div>

<script>
    var element = document.getElementById('ProductSelector');
    var event = new Event('change');
    element.addEventListener('change', function(event) {
        getItems(event.target.value);
    });
    function getItems(val) {
        document.getElementById('some').innerHTML=val;
    }

    var element2 = document.getElementById('agentSelector');
    var agent = new Event('change');
    element2.addEventListener('change', function(agent) {
        getItem(agent.target.value);
    });
    function getItem(val) {
        document.getElementById('agents').innerHTML=val;
    }


    var donut = new Morris.Donut({
        element  : 'sales-chart',
        resize   : true,
        colors   : ['#f56954', '#00a65a'],
        data     : [
            { label: 'Agents', value: [<?php echo $donutdata[0]['agents']; ?>] },
            { label: 'Users', value: [<?php echo $donutdata[0]['renters']; ?>] }
        ],
        hideHover: 'auto'
    });

</script>
<!-- ChartJS -->
<script src="bower_components/chart.js/Chart.js"></script>
<script>
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieChart       = new Chart(pieChartCanvas)
    var PieData        = [
        {
            value    : <?php echo $claimed[0]['claimed']; ?>,
            color    : '#00c0ef',
            highlight: '#f56954',
            label    : 'Claimed'
        },
        {
            value    : <?php echo $unclaimed[0]['unclaimed']; ?>,
            color    : '#00a65a',
            highlight: '#f39c12',
            label    : 'Unclaimed'
        },


    ]
    var pieOptions     = {
        segmentShowStroke    : true,
        segmentStrokeColor   : '#fff',
        segmentStrokeWidth   : 2,
        percentageInnerCutout: 50,
        animationSteps       : 100,
        animationEasing      : 'easeOutBounce',
        animateRotate        : true,
        animateScale         : false,
        responsive           : true,
        maintainAspectRatio  : true,
        legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
    }
    pieChart.Doughnut(PieData, pieOptions)

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
    var barChart                         = new Chart(barChartCanvas)
    var areaChartData = {
        labels  : <?php echo $monthby; ?>,
        datasets: [
             {
                 label               : 'Renters',
                 fillColor           : 'rgba(210, 214, 222, 1)',
                 strokeColor         : 'rgba(210, 214, 222, 1)',
                 pointColor          : 'rgba(210, 214, 222, 1)',
                 pointStrokeColor    : '#c1c7d1',
                 pointHighlightFill  : '#fff',
                 pointHighlightStroke: 'rgba(220,220,220,1)',
                 data                : <?php echo $renterbym; ?>
             },
            {
                label               : 'Agents',
                fillColor           : 'rgba(60,141,188,0.9)',
                strokeColor         : 'rgba(60,141,188,0.8)',
                pointColor          : '#3b8bba',
                pointStrokeColor    : 'rgba(60,141,188,1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data                :<?php echo $agentbym; ?>
            }
        ]
    }
    var barChartData                     = areaChartData
    barChartData.datasets[1].fillColor   = '#3365cc'
    barChartData.datasets[1].strokeColor = '#3365cc'
    barChartData.datasets[1].pointColor  = '#f56853'
    var barChartOptions                  = {

        scaleBeginAtZero        : true,
        scaleShowGridLines      : true,
        scaleGridLineColor      : 'rgba(0,0,0,.05)',
        scaleGridLineWidth      : 1,
        scaleShowHorizontalLines: true,
        scaleShowVerticalLines  : true,
        barShowStroke           : true,
        barStrokeWidth          : 2,
        barValueSpacing         : 5,
        barDatasetSpacing       : 1,
        legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
        responsive              : true,
        maintainAspectRatio     : true
    }

    //barChartOptions.datasetFill = false
    barChart.Bar(barChartData, barChartOptions)





</script>

<script>

    gapi.analytics.ready(function() {
        gapi.analytics.auth.authorize({
            container: 'embed-api-auth-container',
            clientid: '625301608991-vvmnbemnqdujkdd1hg9qq4uq7t2c7sq9.apps.googleusercontent.com'
        });

        var viewSelector1 = new gapi.analytics.ViewSelector({
            container: 'view-selector-1-container'
        });
        viewSelector1.execute();
        var dataChart = new gapi.analytics.googleCharts.DataChart({
            query: {
                metrics: 'ga:users',
                dimensions: 'ga:date',
                'start-date': '30daysAgo',
                'end-date': 'yesterday'
            },
            chart: {
                container: 'chart-container12',
                type: 'LINE',
                options: {
                    width: '100%'
                }
            }
        });
        var dataChart1 = new gapi.analytics.googleCharts.DataChart({
            query: {
                metrics: 'ga:sessions',
                dimensions: 'ga:city',
                'start-date': '15daysAgo',
                'end-date': 'yesterday',
                'max-results': 10,
                sort:'-ga:sessions'
            },
            chart: {
                container: 'chart-1-container',
                type: 'PIE',
                options: {
                    width: '100%',
                    pieHole: 4/9
                }
            }
        });
        var dataChart2 = new gapi.analytics.googleCharts.DataChart({
                query: {
                    metrics: 'ga:sessions',
                    dimensions: 'ga:country',
                    'start-date': '15daysAgo',
                    'end-date': 'yesterday',
                    'max-results': 10,
                    sort:'-ga:sessions'
                },
                chart: {
                    container: 'chart-2-container',
                    type: 'PIE',
                    options: {
                        width: '100%',
                        pieHole: 4/9
                    }
                }
            });
        var mainChart = new gapi.analytics.googleCharts.DataChart({
            query: {
                'dimensions': 'ga:browser',
                'metrics': 'ga:sessions',
                'sort': '-ga:sessions',
                'max-results': '6'
            },
            chart: {
                type: 'TABLE',
                container: 'main-chart-container',
                options: {
                    width: '100%'
                }
            }
        });
        var breakdownChart = new gapi.analytics.googleCharts.DataChart({
            query: {
                'dimensions': 'ga:date',
                'metrics': 'ga:sessions',
                'start-date': '7daysAgo',
                'end-date': 'yesterday'
            },
            chart: {
                type: 'LINE',
                container: 'breakdown-chart-container',
                options: {
                    width: '100%'
                }
            }
        });
        var mainChartRowClickListener;
        viewSelector1.on('change', function(ids) {
            dataChart1.set({query: {ids: ids}}).execute();
            dataChart.set({query: {ids: ids}}).execute();
            dataChart2.set({query: {ids: ids}}).execute();
            var options = {query: {ids: ids}};
            if (mainChartRowClickListener) {
                google.visualization.events.removeListener(mainChartRowClickListener);
            }
            mainChart.set(options).execute();
            breakdownChart.set(options);
            if (breakdownChart.get().query.filters) breakdownChart.execute();
        });


        mainChart.on('success', function(response) {
            var chart = response.chart;
            var dataTable = response.dataTable;
            mainChartRowClickListener = google.visualization.events
                .addListener(chart, 'select', function(event) {
                    if (!chart.getSelection().length) return;
                    var row =  chart.getSelection()[0].row;
                    var browser =  dataTable.getValue(row, 0);
                    var options = {
                        query: {
                            filters: 'ga:browser==' + browser
                        },
                        chart: {
                            options: {
                                title: browser
                            }
                        }
                    };
                    breakdownChart.set(options).execute();
                });
        });

    });
</script>
















