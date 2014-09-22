<?php

class UsersController extends Controller
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
			array('allow', // allow to admin any actions
				'actions'=>array('index', 'view', 'create', 'update', 'admin', 'delete', 'playlist'),
				'roles'=>array('administrator'),
			),
			array('deny',  // deny for user any user actions
                'actions'=>array('index', 'view', 'create', 'update', 'admin', 'delete', 'playlist'),
				'roles'=>array('user'),
			),
            array('deny', // and for guests
                'actions'=>array('index', 'view', 'create', 'update', 'admin', 'delete', 'playlist'),
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
	public function actionCreate()
	{
		$model=new Users;
        $model->scenario = 'creation';
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);


        $users = Yii::app()->request->getPost('Users');

		if(isset($users))
		{

			$model->attributes=$users;
            $model->role = Yii::app()->request->getPost('role');
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
        $users = Yii::app()->request->getPost('Users');
		if(isset($users))
		{
			$model->attributes=$users;
            $model->role = Yii::app()->request->getPost('role');
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}


    /**
     * Deletes a particular model.
     * @param $id the ID of the model to be deleted
     * @throws CHttpException
     */
    public function actionDelete($id)
	{
        if(Yii::app()->user->id == $id)
        {
            throw new CHttpException(Yii::t('users', 'You can\'t delete yourself'));
        }
		$this->loadModel($id)->delete();


		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        $ajax = Yii::app()->request->getQuery('ajax');
        if(!isset($ajax))
        {
            $rUrl = Yii::app()->request->getPost('returnUrl');
            $this->redirect(isset($rUrl) ? $rUrl : array('admin'));
        }
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Users');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Users('search');
		$model->unsetAttributes();  // clear any default values
        $users = Yii::app()->request->getQuery('Users');
		if(isset($users))
			$model->attributes=$users;

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Users the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Users::model()->findByPk($id);
		if($model===null)
            throw new CHttpException(404,Yii::t('common', 'The requested page does not exist.'));
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Users $model the model to be validated
	 */
    protected function performAjaxValidation($model)
    {
        $ajax = Yii::app()->request->getPost('ajax');
        if(isset($ajax) && $ajax==='users-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
