<?php

class Relasi_poController extends Controller
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
				'actions'=>array('create','update','batal', 'batal2','view2', 'view3'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
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

	public function actionView2($id)
	{
		$this->render('view2',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionView3($id)
	{
		$this->render('view3',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new RelasiPo;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['RelasiPo']))
		{
			$model->attributes=$_POST['RelasiPo'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->ID_RELASI_PO));
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

		if(isset($_POST['RelasiPo']))
		{
			$model->attributes=$_POST['RelasiPo'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->ID_RELASI_PO));
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

	public function actionBatal($id, $perj)
	{
		$models = Perjalanan::model()->findByPk($perj);
		$model=$this->loadModel($id); 
		$ritasebaru = $models->RITASE - $model->iDONGKOS->HARGA;

		Perjalanan::model()->updateByPk($perj,array("RITASE"=>$ritasebaru));

		$this->loadModel($id)->delete();

		$this->redirect(array('perjalanan/create2','id'=>$perj));
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		
	}

	public function actionBatal2($id, $perj)
	{
		$models = Perjalanan::model()->findByPk($perj);
		$model=$this->loadModel($id); 
		$ritasebaru = $models->TAMBAHAN - $model->iDONGKOS->HARGA;

		Perjalanan::model()->updateByPk($perj,array("TAMBAHAN"=>$ritasebaru));

		$this->loadModel($id)->delete();

		$this->redirect(array('perjalanan/create3','id'=>$perj));
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('RelasiPo');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new RelasiPo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['RelasiPo']))
			$model->attributes=$_GET['RelasiPo'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return RelasiPo the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=RelasiPo::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param RelasiPo $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='relasi-po-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
