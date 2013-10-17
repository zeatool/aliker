<?php
include("cfg.php");

if(!$_COOKIE['track_user'])
{
    echo "<meta http-equiv=\"refresh\" content=\"0;url=login.php\">";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Panda tracking</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="bootstrap/jquery.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/bootbox.min.js"></script>
    <script>
        function track(id)
        {
            $.ajax({
                type:"GET",
                url: "track_soap.php",
                data: "code="+id,
                cache: false,
                beforeSend: function(){
                    $("#st_"+id).html("<img src=loader2.gif>");
                },
                success: function(html){
                    $("#st_"+id).html(html);
                }
            });

        }
    </script>
    <!-- Le styles -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/main.css" rel="stylesheet">
    <style>
        body {
            padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
        }
    </style>
    <link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

<body>

<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="brand" href="index.php">Panda Tracking</a>
            <div class="nav-collapse collapse">
                <ul class="nav">
                    <li class="active"><a href="index.php">Главная</a></li>
                    <li><a href="?q=add">Добавить</a></li>
                </ul>
                <p class="navbar-text pull-right">
                    Вы вошли как <a href="#" class="navbar-link"><?php print $_COOKIE['track_user']; ?></a>
                </p>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</div>

<div class="container">
    <?php
    if($_GET['q']=="add")
        include("add.php");
    else
        include("main.php");
    ?>
</div> <!-- /container -->

<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

</body>
</html>
