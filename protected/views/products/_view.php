<?php
/* @var $this ProductsController */
/* @var $data Products */
$tid = $data->track_id;

?>

<TR id="tr_<?php print $tid ?>">
    <TD>
        <?php print CHtml::link($tid,'/products/view/'.$tid); ?><BR>
    <?php
    if(!$data->disabled){
        print CHtml::link("<i class='icon-ok'></i>","javascript:disable_track('$tid')",array("class"=>"btn btn-small"));
        print CHtml::link("<i class='icon-edit'></i>",Yii::app()->getBaseUrl()."/products/edit/".$tid,array("class"=>"btn btn-small"));
        print CHtml::link("<i class='icon-refresh'></i>","javascript:track('$tid')",array("class"=>"btn btn-small"));
    }
    ?>
    </TD>
    <TD>
        <?php print CHtml::image(Yii::app()->getBaseUrl()."/".$data->img,'',array("width"=>100,"class"=>"popover_img","data-content"=>CHtml::image(Yii::app()->getBaseUrl()."/".$data->img))); ?>
    </TD>
    <TD><?php echo CHtml::link(CHtml::encode($data->title), $data->link,array("target"=>"_blank")); ?></TD>
    <TD><div id='st_<?php echo $data->track_id?>'><?php echo $data->last_state; ?></div></TD>
    <TD><?php echo CHtml::encode($data->date_upd); ?></TD>
</TR>