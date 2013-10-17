<?php
/* @var $this ProductsController */
/* @var $model Products */

$this->breadcrumbs=array(
	'Треки'=>array('index'),
	'Новый',
);?>
<?php
$this->menu=array(
	array('label'=>'List Products', 'url'=>array('index')),
	array('label'=>'Manage Products', 'url'=>array('admin')),
);
?>

<h1>Create Products</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>