<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
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
                url: "index.php?r=products/track&id="+id,
                beforeSend: function(){
                    $("#st_"+id).html("<img src=i/loader2.gif>");
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
    <link href="css/main.css" rel="stylesheet">
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
            <img src="i/lg.png" style="float:left;">
            <a class="brand" href="index.php"><?php echo CHtml::encode(Yii::app()->name); ?></a>
            <div class="nav-collapse collapse">
                <?php $this->widget('zii.widgets.CMenu',array(
                    'items'=>array(
                        array('label'=>'Главная', 'url'=>array('/site/index')),
                        array('label'=>'Треки', 'url'=>array('/products'), 'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'О проекте', 'url'=>array('/site/page', 'view'=>'about')),
                        array('label'=>'Войти', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                        array('label'=>'Выйти ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                    ),
                    'htmlOptions'=>array('class'=>'nav')
                )); ?>
                <p class="navbar-text pull-right">
                    Вы вошли как <a href="#" class="navbar-link"><?php print Yii::app()->user->name; ?></a>
                </p>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</div>

<div class="container" id="page">
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>
</div><!-- page -->

</body>
</html>
