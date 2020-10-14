<?php
require("database.php");

$ID=$_GET["ID"];
$L=$_GET["L"];
$R=$_GET["R"];
// Create connection
$conn = new mysqli($servername, $username, $password,$db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo "Connected successfully";

?>

<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Fish Barcode</title>

	<link href="./css/bootstrap.min.css" rel="stylesheet">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      a:link, a:visited {
        color: black;
        display: inline-block;
      }

      a:hover, a:active {
        color: #00D1D1;
      }
      html{
        scroll-behavior: smooth;
      }
      .navbar{
        transition: top 0.5s ease;
      }
      .navbar-hide{
        top:-56px;
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="./css/dashboard.css" rel="stylesheet">
  	<style type="text/css">/* Chart.js */
@-webkit-keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}@keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}.chartjs-render-monitor{-webkit-animation:chartjs-render-animation 0.001s;animation:chartjs-render-animation 0.001s;}</style></head>
  <body>
<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow"> 
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="index.php">FISH BARCODE</a>
</nav>

<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-2 mb-1 text-muted">
          <span>Detial</span>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="#species">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
              Species Info
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#seq">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
              Sequence Info
            </a>
          </li>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#related_species">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
              Related Species
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
      

      <div class="table-responsive" id="species"></div>
      <div class="table-responsive" id="seq"></div>
      <div class="table-responsive" id="related_species"></div>

    </main>
  </div>
</div>

<script src="./js/jquery-3.3.1.min.js"></script>
        <script>window.jQuery || document.write('<script src="./js/jquery-3.3.1.min.js"><\/script>')</script>
        <script src="./js/bootstrap.bundle.min.js"></script>
        <script src="./js/feather.min.js"></script>
        <script type="text/javascript">
         var ID_JS = "<?php echo $ID ?>";
         var L_JS = "<?php echo $L ?>";
         var R_JS = "<?php echo $R ?>";

          $(document).ready(function(){
            
              $.post("list_info.php",
              {
                ID: ID_JS
              },
              function(data){
                $("#species").html(data);
              });

              $.post("list_seq.php",
              {
                ID: ID_JS
              },
              function(data){
                $("#seq").html(data);
              });

              $.post("list_related_species.php",
              {
                ID: ID_JS,
                L: L_JS,
                R: R_JS
              },
              function(data){
                $("#related_species").html(data);
              });

            });

          $(window).scroll(function(e){
        var scroll=$(window).scrollTop();
        if(scroll >= 150){
          $('.navbar').addClass("navbar-hide");
        }
        else{
          $('.navbar').removeClass("navbar-hide");
        }
      });

  </script>>

</body>
</html>