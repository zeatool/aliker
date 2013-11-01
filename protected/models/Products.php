<?php

/**
 * This is the model class for table "products".
 *
 * The followings are the available columns in table 'products':
 * @property string $track_id
 * @property string $title
 * @property string $img
 * @property string $link
 * @property string $date_upd
 * @property string $last_state
 * @property integer $disabled
 */
class Products extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'products';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('track_id, title', 'required'),
			array('disabled', 'numerical', 'integerOnly'=>true),
			array('track_id', 'length', 'max'=>16),
			array('title, img, link', 'length', 'max'=>255),
			array('last_state', 'length', 'max'=>355),
            array('link', 'match', 'pattern' => '/^http:\/\/www\.aliexpress\.com\/snapshot\/[0-9]+\.html$/u','message' => "Uncorrect link"),
            array('track_id','match','pattern'=>'/[0-9]{14}|[A-Z]{2}[0-9]{9}[A-Z]{2}/u'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('track_id, title, img, link, date_upd, last_state, disabled, store_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'store' => array(self::BELONGS_TO,'Store','store_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'track_id' => 'Track ID',
			'title' => 'Название',
			'img' => 'Картинка',
			'link' => 'Ссылка на Ali-express',
			'date_upd' => 'Дата обновления',
			'last_state' => 'Статус',
			'disabled' => 'Disabled',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('track_id',$this->track_id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('img',$this->img,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('date_upd',$this->date_upd,true);
		$criteria->compare('last_state',$this->last_state,true);
		$criteria->compare('disabled',$this->disabled);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Products the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
