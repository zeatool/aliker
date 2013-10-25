<?php
$this->breadcrumbs=array(
	'Магазины',
);

$this->menu=array(
	array('label'=>'Create Store','url'=>array('create')),
	array('label'=>'Manage Store','url'=>array('admin')),
);
?>

<h1>Магазины</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
