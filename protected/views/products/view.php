<?php
/* @var $this ProductsController */
/* @var $model Products */

$this->breadcrumbs=array(
	'Products'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Products', 'url'=>array('index')),
	array('label'=>'Create Products', 'url'=>array('create')),
	array('label'=>'Update Products', 'url'=>array('update', 'id'=>$model->track_id)),
	array('label'=>'Delete Products', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->track_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Products', 'url'=>array('admin')),
);
?>
<style>
    .product_img{float:left;}
</style>
<h1>Трек #<?php echo $model->track_id; ?></h1>
<div class="product_img">
    <img src="<?php print Yii::app()->createUrl($model->img); ?>" width="200">
</div>
<div style="float:right; max-width: 940px;">
<?php
$store = $model->store_id ? "<a href='".$model->store->link."'>".$model->store->title."</a>" : "-";
$this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'track_id',
		'title',
        array(
            'label'=>'Магазин',
            'type'=>'raw',
            'value'=>$store,
        ),
		'link',
		'date_upd',
		'last_state',
	),
)); ?>
</div>