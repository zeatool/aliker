<?php
/* @var $this ProductsController */
/* @var $model Products */

$this->breadcrumbs=array(
	'Треки'=>array('index'),
	'Новый',
);?>

<h1>Новый трек</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>