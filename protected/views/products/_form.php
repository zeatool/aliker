    <?php
/* @var $this ProductsController */
/* @var $model Products */
/* @var $form CActiveForm */
?>
<script>
    function check(){
        $.ajax({
            type:"POST",
            url: curl+"/products/checkurl",
            data: "link="+$("#Products_link").val()+"&code="+$("#Products_track_id").val(),
            dataType: 'json',
            beforeSend: function(){$('#img_div').html("<img width=200 src='"+curl+"/i/656297.gif'>");},
            success: function(data){
                $('#Products_title').val(data.title);
                $('#Products_img').val(data.img);
                $('#img_div').html("<img width=200 src='"+curl+'/'+data.img+"'>");
                if (data.id)
                    $('#store_id').val(data.id);
            }
        });
    }
</script>

<div>
<div class="form" style="float:left;">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'products-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля отмеченные <span class="required">*</span> обязательны.</p>
    <input type="hidden" value="0" name="Products[store_id]" id="store_id">
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'track_id'); ?>
		<?php echo $form->textField($model,'track_id',array('class'=>'span2','size'=>16,'maxlength'=>16,'placeholder'=>'RB12345678CN')); ?>
		<?php echo $form->error($model,'track_id'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'link'); ?>
        <?php echo $form->textField($model,'link',array('class'=>'span4','size'=>60,'maxlength'=>255,'placeholder'=>'http://www.aliexpress.com/snapshot/XXXXXX.html')); ?>
        <a href="#" class="btn" onclick="check();"><i class="icon-refresh" title="Получить данные с али"></i></a>
        <?php echo $form->error($model,'link'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'img'); ?>
		<?php echo $form->textField($model,'img',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'img'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить',array('class'=>'btn btn-success')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
  <div id="img_div">

  </div>

</div>