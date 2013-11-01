<?php /* @var $this Controller */ ?>

<?php $this->beginContent('//layouts/main'); ?>
<div>
    <div id="sidebar">
        <?php
        $this->beginWidget('zii.widgets.CPortlet', array(
            'title'=>'',
        ));
        $this->widget('bootstrap.widgets.TbMenu', array(
            'type'=>'tabs',
            'items'=>$this->menu,
            'htmlOptions'=>array('class'=>'operations'),
        ));
        $this->endWidget();
        ?>
    </div><!-- sidebar -->
</div>
<!--<div class="span-19">-->
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
<!--</div>-->

<?php $this->endContent(); ?>