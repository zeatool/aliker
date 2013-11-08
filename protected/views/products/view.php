<?php
/* @var $this ProductsController */
/* @var $model Products */

$this->breadcrumbs=array(
	'Треки'=>array('index'),
	$model->track_id,
);
if (!$model->img) $model->img="i/no_image.png";
$this->menu=array(
	array('label'=>'Изменить трек', 'url'=>array('update', 'id'=>$model->track_id)),
	array('label'=>'Удалить трек', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->track_id),'confirm'=>'Are you sure you want to delete this item?')),
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
		'link:url',
		'date_upd',
		'last_state:html',
	),
)); ?>
</div>