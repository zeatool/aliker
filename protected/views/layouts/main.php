<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="<?php echo Yii::app()->getBaseUrl(true);?>/bootstrap/jquery.js"></script>
    <script src="<?php echo Yii::app()->getBaseUrl(true);?>/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo Yii::app()->getBaseUrl(true);?>/js/bootbox.min.js"></script>
    <script>
        var curl='<?php echo Yii::app()->getBaseUrl(true);?>';
        function track(id)
        {
            $.ajax({
                type:"GET",
                url: curl+"/products/track/"+id,
                beforeSend: function(){
                    $("#st_"+id).html("<img src="+curl+"/i/loader2.gif>");
                },
                success: function(html){
                    $("#st_"+id).html(html);
                }
            });

        }
    </script>
    <!-- Le styles -->
    <link href="<?php echo Yii::app()->getBaseUrl(true);?>/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->getBaseUrl(true);?>/bootstrap/css/main.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->getBaseUrl(true);?>/bootstrap/css/admin.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->getBaseUrl(true);?>/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
<body>
<div id="wrap">
<div class="masthead">
        <div class="container">
        <div style="float: left;"><img width="100" src="<?php echo Yii::app()->getBaseUrl(true);?>/i/lg2.png"></div>
        <div class="masthead-top clearfix">

            <?php $this->widget('bootstrap.widgets.TbMenu',array(
                'items'=>array(
                    array('label'=>Yii::app()->user->name,'icon'=>'user white', 'url'=>array('/'), 'visible'=>!Yii::app()->user->isGuest,'class'=>'btn',
                    'items'=>array(
                        array('label'=>'Информация','url'=>'/user/profile'),
                        array('label'=>'Настройки','url'=>'/user/profile/edit'),
                        '---',
                        array('label'=>'Выйти','url'=>array('/site/logout')),
                    )),
                    array('label'=>'Войти','icon'=>'user white', 'url'=>array('/user/login'), 'visible'=>Yii::app()->user->isGuest),
                    array('label'=>'Регистрация', 'icon'=>'arrow-right white','url'=>array('/user/registration'), 'visible'=>Yii::app()->user->isGuest),
                ),
                'htmlOptions'=>array('class'=>'nav-pills pull-right')
            )); ?>

           <h1> <?php echo CHtml::encode(Yii::app()->name); ?></h1>
        </div>

        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">

                    <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <div class="nav-collapse">

                        <?php $this->widget('bootstrap.widgets.TbMenu',array(
                            'items'=>array(
                                array('label'=>'Главная', 'icon'=>'home','url'=>array('/site/index')),
                                array('label'=>'Треки', 'icon'=>'tags','url'=>'#', 'visible'=>!Yii::app()->user->isGuest,
                                    'items'=>array(
                                      array('label'=>'Список треков','url'=>array('/products')),
                                      array('label'=>'Добавить трек','url'=>array('/products/create')),
                                    )
                                ),
                                array('label'=>'Магазины', 'icon'=>'briefcase', 'url'=>array('/store'), 'visible'=>!Yii::app()->user->isGuest),
                                array('label'=>'Как пользоваться', 'icon'=>'info-sign','url'=>array('/site/help', 'view'=>'help')),
                                array('label'=>'О проекте', 'url'=>array('/site/page', 'view'=>'about')),
                            )
                        )); ?>
<!---
                         <ul class="nav pull-right">
                            <li><a href="#"><i class="icon-bullhorn"></i> Alerts<span class="badge badge-info">2</span></a></li>
                            <li class="dropdown active">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-info-sign"></i> Help <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="content.html">FAQ</a></li>
                                    <li class="active"><a href="content.html">User Guide</a></li>
                                    <li><a href="content.html">Support</a></li>
                                </ul>
                            </li>
                        </ul>-->
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
<div  class="main-area dashboard">
    <div class="container" id="page">
        <?php if(isset($this->breadcrumbs)):?>
            <?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
                'links'=>$this->breadcrumbs,
            )); ?><!-- breadcrumbs -->
        <?php endif?>

        <?php echo $content; ?>
    </div><!-- page -->
</div>
</div>

<div id="footer">
    <div class="container">
        <div style="float:left;">
        <!--LiveInternet counter--><script type="text/javascript"><!--
            document.write("<a href='http://www.liveinternet.ru/click' "+
                "target=_blank><img src='//counter.yadro.ru/hit?t25.2;r"+
                escape(document.referrer)+((typeof(screen)=="undefined")?"":
                ";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
                    screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
                ";"+Math.random()+
                "' alt='' title='LiveInternet: РїРѕРєР°Р·Р°РЅРѕ С‡РёСЃР»Рѕ РїРѕСЃРµС‚РёС‚РµР»РµР№ Р·Р°"+
                " СЃРµРіРѕРґРЅСЏ' "+
                "border='0' width='88' height='15'><\/a>")
            //--></script><!--/LiveInternet-->
    </div>

    <p>Отслеживание товаров с Aliexpress. &copy; Aliker.ru, <?php print date('Y'); ?> </p>
    </div>
</div>

</body>
</html>
