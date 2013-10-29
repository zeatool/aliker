<?php

class ProductsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','disable','checkurl','track'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

    private function CheckUrl($link,$code,$it_save=false)
    {
        Yii::import('ext.SimpleHTMLDOM.SimpleHTMLDOM');
        $simpleHTML = new SimpleHTMLDOM();

        $ret = array();

        $html = $simpleHTML->file_get_html($link);
        $title=$html->find("#product-name",0);

        $ret['title']=trim($title->plaintext);

        $img_div = $html->find('#img',0);
        $img = $img_div->find('img',0);
        $img_src = str_replace('.summ','',$img->attr['src']);

        if(!$img_src)
        {
            preg_match("/MAIN_BIG_PIC='(.*)';/",$html,$tmp);
            $img_src=trim(substr($tmp[1],0,strpos($tmp[1],'//]]')));
            $img_src=str_replace("';",'',$img_src);
        }

        $local_src='data/'.$code.'.jpg';
        file_put_contents($local_src,file_get_contents($img_src));
        $ret['img']=$local_src;

        if (!$it_save) return $ret;

        // Пробьем инфу по магазу :)
        $store_link = $html->find('.company-name',0);
        if ($store_link)
        {
            $store_link = $store_link->find('a',0);
            $ret['title_store']=trim($store_link->plaintext);
            $ret['link']=trim($store_link->href);
            $ret['id']=intval(str_replace('http://www.aliexpress.com/store/','',$store_link->href));

            $store = Store::model()->findByPk($ret['id']);
            if ($store==null)
            {
                $store = new Store();
                $store->id = $ret['id'];
                $store->title = $ret['title_store'];
                $store->link = $ret['link'];
                $store->save(false);
            }
        }

    }



	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Products;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Products']))
		{
			$model->attributes=$_POST['Products'];
            $model->store_id = $_POST['Products']['store_id'];
            $model->user_id=Yii::app()->user->user_id;

			if($model->save())
				$this->redirect(array('view','id'=>$model->track_id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Products']))
		{
			$model->attributes=$_POST['Products'];
            if ($_POST['Products']['store_id'])
                $model->store_id = $_POST['Products']['store_id'];

			if($model->save())
				$this->redirect(array('view','id'=>$model->track_id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
         $disabled = intval($_GET['disabled']);
         $criteria=new CDbCriteria(array(
            'condition'=>'disabled='.$disabled.' AND user_id='.Yii::app()->user->user_id
         ));

		$dataProvider=new CActiveDataProvider('Products',
        array( 'criteria'=>$criteria,));

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Products('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Products']))
			$model->attributes=$_GET['Products'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

    /*
     * ���������� ��������
     * */

    public function actionDisable($id){
        $model=$this->loadModel($id);
        $model->disabled=1;
        $model->save();
        var_dump($model);
    }
    // Получение инфы о товаре с страницы на алиэкспресс :)
    public function actionCheckURL()
    {
        Yii::import('ext.SimpleHTMLDOM.SimpleHTMLDOM');
        $simpleHTML = new SimpleHTMLDOM();
        $link = trim($_REQUEST['link']);
        $code = trim($_REQUEST['code']);
        $ret = array();

        $html = $simpleHTML->file_get_html($link);
        $title=$html->find("#product-name",0);

        $ret['title']=trim($title->plaintext);

        $img_div = $html->find('#img',0);
        $img = $img_div->find('img',0);
        $img_src = str_replace('.summ','',$img->attr['src']);

        if(!$img_src)
        {
            //@eregi("MAIN_BIG_PIC='(.*)'; ",$html,$tmp);
            preg_match("/MAIN_BIG_PIC='(.*)';/",$html,$tmp);
            $img_src=trim(substr($tmp[1],0,strpos($tmp[1],'//]]')));
            $img_src=str_replace("';",'',$img_src);
            // print $img_src;
        }

        $local_src='data/'.$code.'.jpg';
        file_put_contents($local_src,file_get_contents($img_src));
        $ret['img']=$local_src;

       // Пробьем инфу по магазу :)
        $store_link = $html->find('.company-name',0);
        if ($store_link)
        {
            $store_link = $store_link->find('a',0);
            $ret['title_store']=trim($store_link->plaintext);
            $ret['link']=trim($store_link->href);
            $ret['id']=intval(str_replace('http://www.aliexpress.com/store/','',$store_link->href));

            $store = Store::model()->findByPk($ret['id']);
            if ($store==null)
            {
                $store = new Store();
                $store->id = $ret['id'];
                $store->title = $ret['title_store'];
                $store->link = $ret['link'];
                $store->save(false);
            }
        }

        echo json_encode($ret);
    }

    // Трекинг посылки
    public function actionTrack($id)
    {
        //error_reporting(E_ALL);
        Yii::import('ext.RussianPost.RussianPostAPI');
        $client = new RussianPostAPI();
        $code = trim($id);


        $track = $client->getOperationHistory($code);
        if(sizeof($track))
        {
            $last_state=$track[sizeof($track)-1];
            $date=date('d.m.Y H:i:s',strtotime($last_state->operationDate));
            $stat = $date."<br>".$last_state->operationPlaceName." ".$last_state->operationPlacePostalCode."<br>(".$last_state->operationType.")<BR>".$last_state->operationAttribute;
        }
        else
            $stat = "Нет данных";

        $model=$this->loadModel($id);
        $model->last_state=$stat;
        $model->save();

        if(strpos($stat,'Красноярск'))
        {
            if (strpos($stat,'Прибыло в место вручения'))
                $stat.= "<br><img src='i/panda1.gif'>";
            else
                $stat.= "<br><img src='i/dance.gif'>";
        }
        print $stat;
    }
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Products the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Products::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Products $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='products-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
