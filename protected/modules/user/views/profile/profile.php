<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Profile");
$this->breadcrumbs=array(
	UserModule::t("Профиль"),
);
$this->menu=array(
	((UserModule::isAdmin())
		?array('label'=>UserModule::t('Пользователи'), 'url'=>array('/user/admin'))
		:array()),
    array('label'=>UserModule::t('List User'), 'url'=>array('/user'),'visible'=>UserModule::isAdmin()),
    array('label'=>UserModule::t('Редактировать'), 'url'=>array('edit')),
    array('label'=>UserModule::t('Сменить пароль'), 'url'=>array('changepassword')),
    array('label'=>UserModule::t('Выход'), 'url'=>array('/user/logout')),
);
?>
<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
<div class="alert alert-info">
	<a class="close" data-dismiss="alert" href="#">x</a>
	<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
</div>
<?php endif; ?>
<div class="span4 profileicon">
    <img src="<?php echo Yii::app()->getBaseUrl(true);?>/i/ava.png" width="150">
    <p><strong><?php echo CHtml::encode($model->getAttributeLabel('username')); ?>:</strong> <?php echo CHtml::encode($model->username); ?></p>
    <p><strong><?php echo CHtml::encode($model->getAttributeLabel('email')); ?></strong> <a href="<?php echo CHtml::encode($model->email); ?>"><?php echo CHtml::encode($model->email); ?></a></p>
    <?php $profileFields=ProfileField::model()->forOwner()->sort()->findAll();
    if ($profileFields) {
        foreach($profileFields as $field) { ?>
            <p><strong><?php echo CHtml::encode(UserModule::t($field->title)); ?>:</strong>
                <?php echo (($field->widgetView($profile))?$field->widgetView($profile):CHtml::encode((($field->range)?Profile::range($field->range,$profile->getAttribute($field->varname)):$profile->getAttribute($field->varname)))); ?></td>
            </p>
        <?php
        }
    }  ?>
    <p><strong><?php echo CHtml::encode($model->getAttributeLabel('create_at')); ?>:</strong> <?php echo $model->create_at; ?></p>
    <p><strong><?php echo CHtml::encode($model->getAttributeLabel('lastvisit_at')); ?>:</strong> <?php echo $model->lastvisit_at; ?></p>
    <p><strong><?php echo CHtml::encode($model->getAttributeLabel('status')); ?>:</strong><?php echo CHtml::encode(User::itemAlias("UserStatus",$model->status)); ?></p>


</div>