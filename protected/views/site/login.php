<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Вход';
?>
<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
<style type="text/css">

    .form-my {
      margin-left: 35px;
      float:left;
    }

</style>

<h1>Пожалуйста войдите</h1>
<div data-align="center">
<div class="form-my">
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'login-form',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
    )); ?>

        <div class="row">
            <?php echo $form->labelEx($model,'username'); ?>
            <?php echo $form->textField($model,'username'); ?>
            <?php echo $form->error($model,'username'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'password'); ?>
            <?php echo $form->passwordField($model,'password'); ?>
            <?php echo $form->error($model,'password'); ?>
        </div>

        <div class="row rememberMe">
            <?php echo $form->checkBox($model,'rememberMe'); ?>
            <?php echo $form->label($model,'rememberMe'); ?>
            <?php echo $form->error($model,'rememberMe'); ?>
        </div>

        <div class="row buttons">
            <?php echo CHtml::submitButton('Войти',array('class'=>'btn btn-large btn-primary')); ?>
        </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->
<div>
    <img src="<?php echo Yii::app()->getBaseUrl(true);?>/i/0.jpeg" width="200">
</div>
</div>