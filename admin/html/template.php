<!DOCTYPE HTML>
<html>
    <head>
	<title>Neighborty</title>
    	<meta http-equiv="content-type" content="text/html;charset=utf-8" />  
        <link href="assets/style.css" rel="stylesheet" type="text/css" />
         <link href="xcrud/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="../admin/assets/favicon.ico"/>
        
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
        <script>
            (function(w,d,s,g,js,fjs){
                g=w.gapi||(w.gapi={});g.analytics={q:[],ready:function(cb){this.q.push(cb)}};
                js=d.createElement(s);fjs=d.getElementsByTagName(s)[0];
                js.src='https://apis.google.com/js/platform.js';
                fjs.parentNode.insertBefore(js,fjs);js.onload=function(){g.load('analytics')};
            }(window,document,'script'));

        </script>


     </head>
    
    <body>
        <div id="page">
            <div id="menu"><?php include(dirname(__FILE__).'/menu.php') ?></div>
            <div id="content">
                <a href="javascript:;" class="btn btn-default pull-right" style="margin-top:15px;display: none;">visit to site</a>
                <div class="clr">&nbsp;</div>
                <h1 class="page_title"><?php echo $title_1 ?></h1>
                <p class="page_description"><?php echo $description ?></p>
                
                <?php include($file) ?>
                <div class="clr">&nbsp;</div>
            </div>
        </div>



       <!-- <script src="bower_components/jquery/dist/jquery.min.js"></script>-->
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>

<script src="bower_components/morris.js/morris.min.js"></script>


<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>



     </body>
</html>