<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
            'oauth' => array(
                // the list of additional properties of this action is below
                'class'=>'ext.hoauth.HOAuthAction',
                // Yii alias for your user's model, or simply class name, when it already on yii's import path
                // default value of this property is: User
                'model' => 'Users',
                // map model attributes to attributes of user's social profile
                // model attribute => profile attribute
                // the list of avaible attributes is below
                'attributes' => array(
                    'email' => 'email',
                    'fname' => 'firstName',
                    'lname' => 'lastName',
                    'gender' => 'genderShort',
                    'birthday' => 'birthDate',
                    // you can also specify additional values,
                    // that will be applied to your model (eg. account activation status)
                    'acc_status' => 1,
                ),
            ),
            // this is an admin action that will help you to configure HybridAuth
            // (you must delete this action, when you'll be ready with configuration, or
            // specify rules for admin role. User shouldn't have access to this action!)
            'oauthadmin' => array(
                'class'=>'ext.hoauth.HOAuthAdminAction',
            ),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{


		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

    /**
     * Set lang from GET
     */
    public function actionSetLang()
    {
        $lng = Yii::app()->request->getQuery('lang');

        if($lng)
        {
            Yii::app()->session['lang'] = $lng;
        }
        $this->redirect('index');
    }

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;
		// if it is ajax validation request
        $ajax = Yii::app()->request->getPost('ajax');
		if(isset($ajax) && $ajax==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
        $loginForm = Yii::app()->request->getPost('LoginForm');
		if(isset($loginForm))
		{
			$model->attributes=$loginForm;
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}