<?php
/* @var $this ProductsController */
/* @var $data Products */
$tid = $data->track_id;

?>

<TR id="tr_<?php print $tid ?>">
    <TD>
        <?php print CHtml::link($tid,"javascript:track('$tid')"); ?>
        <?php print CHtml::link("<i class='icon-ok'></i>","javascript:disable_track('$tid')",array("class"=>"btn")); ?>
    </TD>
    <TD>
        <?php print CHtml::image($data->img,'',array("width"=>100,"class"=>"popover_img","data-content"=>CHtml::image($data->img))); ?>
    </TD>
    <TD><?php echo CHtml::link(CHtml::encode($data->title), $data->link,array("target"=>"_blank")); ?></TD>
    <TD><div id='st_<?php echo $data->track_id?>'><?php echo $data->last_state; ?></div></TD>
    <TD><?php echo CHtml::encode($data->date_upd); ?></TD>
</TR>