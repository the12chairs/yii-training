<?php

class SongsController extends Controller
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
                'actions'=>array('index', 'view', 'create', 'update', 'admin', 'delete', 'addGenre', 'removeGenre'),
                'roles'=>array('administrator'),
            ),
            array('allow',
                'actions'=>array('index'),
                'roles'=>array('user'),
            ),
            array('deny',
                'actions'=>array('view', 'create', 'update', 'admin', 'delete', 'addGenre', 'removeGenre'),
                'roles'=>array('user'),
            ),

            array('deny',
                'actions'=>array('index', 'view', 'create', 'update', 'admin', 'delete', 'addGenre', 'removeGenre'),
                'users'=>array('*'),
            ),
        );
	}


    public function actionAddToPlaylist()
    {
        $sId = Yii::app()->request->getQuery('id'); // Song id
        $uId = Yii::app()->user->id; // User id

        $toList = new Playlists;
        $toList->user_id = $uId;
        $toList->song_id = $sId;
        $toList->save();
        $this->redirect('../index');
    }

    /**
     * Remove association between song and genre
     */
    public function actionRemoveGenre()
    {
        $sId = Yii::app()->request->getQuery('song'); // Song id
        $gId = Yii::app()->request->getQuery('genre'); // Genre id

        $link = new Links;
        $link->remove($sId, $gId);
        $this->redirect('AddGenre?id='.$sId);
    }


    /**
     * Adds genre to song
     */
    public function actionAddGenre()
    {

        $id = Yii::app()->request->getQuery('id'); // Song id
        $gId = Yii::app()->request->getPost('Genres')['id']; // genre id
        $genre = new Genres;
        if(isset($gId) && isset($id))
        {
            $link = new Links;
            $link->song_id = $id;
            $link->genre_id = $gId;
            $link->save();

        }

        $this->render('addGenre', array(
            'song' => $this->loadModel($id),
            'genres' => $this->loadModel($id)->getGenres(),
            'genre' => $genre,
        ));
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
		$model=new Songs;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
        $songs = Yii::app()->request->getPost('Songs');
		if(isset($songs))
		{
			$model->attributes=$songs;
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
        $songs = Yii::app()->request->getPost('Songs');
		if(isset($songs))
		{
			$model->attributes=$songs;
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
        $all = new Songs;
		$this->render('index',array(
			'dataProvider'=>$all->listAll(),//$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Songs('search');
		$model->unsetAttributes();  // clear any default values
        $songs = Yii::app()->request->getQuery('Songs');
		if(isset($songs))
			$model->attributes=$songs;

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Songs the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Songs::model()->findByPk($id);
		if($model===null)
            throw new CHttpException(404,Yii::t('common', 'The requested page does not exist.'));
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Songs $model the model to be validated
	 */
    protected function performAjaxValidation($model)
    {
        $ajax = Yii::app()->request->getPost('ajax');
        if(isset($ajax) && $ajax==='songs-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
