<?php
/* @var $this ProductsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Треки',
);

?>
<script src="<?php print Yii::app()->getBaseUrl(); ?>/js/track.js"></script>
<script>
    $(document).ready(function(){
        $(".popover_img").popover({
            html:true,
            trigger:'hover'
        });
    });
</script>
<?php $this->widget('bootstrap.widgets.TbButtonGroup', array(
    'toggle' => 'radio', // 'checkbox' or 'radio'
    'buttons' => array(
        array('label'=>'Активные',"url"=>Yii::app()->createUrl("/products/"),"active"=>!intval($_GET['disabled'])),
        array('label'=>'Завершенные',"url"=>Yii::app()->createUrl("/products/?disabled=1"),"active"=>(bool)intval($_GET['disabled'])),
    ),
)); ?>
<h1>Ваши товары</h1>
<table class="table  table-hover">
    <tr>
        <th>TrackID</th>
        <th>Картинка</th>
        <th>Название</th>
        <th>Статус</th>
        <th>Дата обновления</th>
    </tr>
<?php
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
    'template'=>"{items}\n{pager}",
));
?>
</table>