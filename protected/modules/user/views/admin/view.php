<?php
$this->breadcrumbs=array(
	UserModule::t('Users')=>array('admin'),
	$model->username,
);


$this->menu=array(
    array('label'=>UserModule::t('Create User'), 'url'=>array('create')),
    array('label'=>UserModule::t('Update User'), 'url'=>array('update','id'=>$model->id)),
    array('label'=>UserModule::t('Delete User'), 'url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>UserModule::t('Are you sure to delete this item?'))),
    array('label'=>UserModule::t('Manage Users'), 'url'=>array('admin')),
    array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('profileField/admin')),
    array('label'=>UserModule::t('List User'), 'url'=>array('/user')),
);
?>
<h1><?php echo UserModule::t('View User').' "'.$model->username.'"'; ?></h1>
<div class="span5">
<?php
 
	$attributes = array(
		'id',
		'username',
	);
	
	$profileFields=ProfileField::model()->forOwner()->sort()->findAll();
	if ($profileFields) {
		foreach($profileFields as $field) {
			array_push($attributes,array(
					'label' => UserModule::t($field->title),
					'name' => $field->varname,
					'type'=>'raw',
					'value' => (($field->widgetView($model->profile))?$field->widgetView($model->profile):(($field->range)?Profile::range($field->range,$model->profile->getAttribute($field->varname)):$model->profile->getAttribute($field->varname))),
				));
		}
	}
	
	array_push($attributes,
		'password',
		'email',
		'activkey',
		'create_at',
		'lastvisit_at',
		array(
			'name' => 'superuser',
			'value' => User::itemAlias("AdminStatus",$model->superuser),
		),
		array(
			'name' => 'status',
			'value' => User::itemAlias("UserStatus",$model->status),
		)
	);
	
	$this->widget('bootstrap.widgets.TbDetailView', array(
		'data'=>$model,
		'attributes'=>$attributes,
	));
?>
</div>
<div class="span5">
    <div class="slate">
        <div class="page-header">
            <h2><i class="icon-shopping-cart pull-right"></i>Активные треки (<?php print sizeof($tracks); ?>)</h2>
        </div>
        <table class="orders-table table">
            <tbody>
            <?php
                foreach ($tracks as $track)
                {?>
                    <tr>
                        <td><?php print Chtml::link($track->track_id,Yii::app()->createUrl('/products/view/'.$track->track_id)) ?></td>
                        <td><?php print $track->last_state ?></td>
                    </tr>
            <?php
                }?>
            </tbody>
        </table>

    </div>
</div>