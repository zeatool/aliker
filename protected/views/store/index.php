<?php
$this->breadcrumbs=array(
	'Магазины',
);
?>
<h1>Магазины</h1>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'dataProvider'=>$dataProvider,
    'type'=>'striped bordered condensed',
    'columns'=>array(
        'id',
        'title',
        'link:url',
        'trackCount',
    ),
)); ?>
