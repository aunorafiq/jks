<?php

class OngkosController extends Controller
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
				'actions'=>array('create', 'create2', 'create3', 'create4','update', 'update2', 'update3','insert', 'insert2'),
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($id)
	{
		$model=new Ongkos;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Ongkos']))
		{
			$model->attributes=$_POST['Ongkos'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->ID_ONGKOS));
		}

		$this->render('create',array(
			'model'=>$model, 'message'=>$id
		));
	}

	public function actionCreate4($id)
	{
		$model=new Ongkos;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Ongkos']))
		{
			$model->attributes=$_POST['Ongkos'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->ID_ONGKOS));
		}

		$this->render('create',array(
			'model'=>$model, 'message'=>$id
		));
	}

	public function actionCreate2()
	{
		$model=new Ongkos;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Ongkos']))
		{
			$model->attributes=$_POST['Ongkos'];
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('create2',array(
			'model'=>$model,
		));
	}

	public function actionCreate3($perj)
	{
		$model=new Ongkos;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Ongkos']))
		{
			$model->attributes=$_POST['Ongkos'];
			if($model->save())
				$this->redirect(array('perjalanan/create2','id'=>$perj));
		}

		$this->render('create3',array(
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

		if(isset($_POST['Ongkos']))
		{
			$model->attributes=$_POST['Ongkos'];
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionUpdate2($id, $perj)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Ongkos']))
		{
			$model->attributes=$_POST['Ongkos'];
			if($model->save())
				$this->redirect(array('perjalanan/create2','id'=>$perj));
		}

		$this->render('update2',array(
			'model'=>$model,
		));
	}

	public function actionUpdate3($id, $perj)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Ongkos']))
		{
			$model->attributes=$_POST['Ongkos'];
			if($model->save())
				$this->redirect(array('perjalanan/create3','id'=>$perj));
		}

		$this->render('update2',array(
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

	public function actionInsert($id, $perj)
	{
		$isi = Yii::app()->db->createCommand()->select('COUNT(*)')->from('relasi_po')->where('ID_PERJALANAN=:ID_PERJALANAN AND ID_ONGKOS=:ID_ONGKOS',array(':ID_PERJALANAN'=>$perj, ':ID_ONGKOS'=>$id))->queryScalar();
		$idrel = Yii::app()->db->createCommand()->select('ID_RELASI_PO')->from('relasi_po')->where('ID_PERJALANAN=:ID_PERJALANAN AND ID_ONGKOS=:ID_ONGKOS',array(':ID_PERJALANAN'=>$perj, ':ID_ONGKOS'=>$id))->queryScalar();
		$ritase = Yii::app()->db->createCommand()->select('RITASE')->from('perjalanan')->where('ID_PERJALANAN=:ID_PERJALANAN',array(':ID_PERJALANAN'=>$perj))->queryScalar();
		if($isi==0)
		{
			Yii::app()->db->createCommand()->insert('relasi_po',array('ID_PERJALANAN'=>$perj, 'ID_ONGKOS'=>$id));
			$harga = Yii::app()->db->createCommand()->select('HARGA')->from('ongkos')->where('ID_ONGKOS=:ID_ONGKOS',array(':ID_ONGKOS'=>$id))->queryScalar();
			if($ritase==NULL)
			{
				$ritase = $harga;
			}
			else if($ritase!=NULL)
			{
				$ritase = $ritase+$harga;
			}
		}
		else if($isi>0)
		{
			RelasiPo::model()->updateByPk($idrel,array('ID_PERJALANAN'=>$perj, 'ID_ONGKOS'=>$id));
		}

		Perjalanan::model()->updateByPk($perj,array("RITASE"=>$ritase));



		$this->redirect(array('perjalanan/create2','id'=>$perj));
	}

	public function actionInsert2($id, $perj)
	{
		$isi = Yii::app()->db->createCommand()->select('COUNT(*)')->from('relasi_po')->where('ID_PERJALANAN=:ID_PERJALANAN AND ID_ONGKOS=:ID_ONGKOS',array(':ID_PERJALANAN'=>$perj, ':ID_ONGKOS'=>$id))->queryScalar();
		$idrel = Yii::app()->db->createCommand()->select('ID_RELASI_PO')->from('relasi_po')->where('ID_PERJALANAN=:ID_PERJALANAN AND ID_ONGKOS=:ID_ONGKOS',array(':ID_PERJALANAN'=>$perj, ':ID_ONGKOS'=>$id))->queryScalar();
		$ritase = Yii::app()->db->createCommand()->select('TAMBAHAN')->from('perjalanan')->where('ID_PERJALANAN=:ID_PERJALANAN',array(':ID_PERJALANAN'=>$perj))->queryScalar();
		if($isi==0)
		{
			Yii::app()->db->createCommand()->insert('relasi_po',array('ID_PERJALANAN'=>$perj, 'ID_ONGKOS'=>$id));
			$harga = Yii::app()->db->createCommand()->select('HARGA')->from('ongkos')->where('ID_ONGKOS=:ID_ONGKOS',array(':ID_ONGKOS'=>$id))->queryScalar();
			if($ritase==NULL)
			{
				$ritase = $harga;
			}
			else if($ritase!=NULL)
			{
				$ritase = $ritase+$harga;
			}
		}
		else if($isi>0)
		{
			RelasiPo::model()->updateByPk($idrel,array('ID_PERJALANAN'=>$perj, 'ID_ONGKOS'=>$id));
		}

		Perjalanan::model()->updateByPk($perj,array("TAMBAHAN"=>$ritase));



		$this->redirect(array('perjalanan/create3','id'=>$perj));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		/*$dataProvider=new CActiveDataProvider('Ongkos');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));*/

		$model=new Ongkos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Ongkos']))
			$model->attributes=$_GET['Ongkos'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Ongkos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Ongkos']))
			$model->attributes=$_GET['Ongkos'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Ongkos the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Ongkos::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Ongkos $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='ongkos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
