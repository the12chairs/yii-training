<?php

class ApiController extends Controller
{
    // Members
    /**
     * Key which has to be in HTTP USERNAME and PASSWORD headers
     */
    Const APPLICATION_ID = 'ASCCPE';

    private $format = 'json';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array();
    }

    /**
     * List all items. Some tricks with Songs and Playlists.
     */
    public function actionList()
    {

        // Get the respective model instance
        switch(Yii::app()->request->getQuery('model'))
        {
            case 'songs':
                // Complex method with getting linked data
                $this->_sendResponse(200, CJSON::encode(Songs::model()->restList()));
                Yii::app()->end();
                break;
            case 'users':
                _checkAdmin();
                $models = Users::model()->findAll();
                break;
            case 'genres':
                $models = Genres::model()->findAll();
                break;
            case 'bands':
                $this->_sendResponse(200, CJSON::encode(Bands::model()->restList()));
                Yii::app()->end();
                break;
            case 'playlists':
                _checkAuth();
                $this->_sendResponse(200, CJSON::encode(Playlists::model()->restList(Yii::app()->request->getQuery('id'))));
                Yii::app()->end();
                break;
            default:
                // Model not implemented error
                $this->_sendResponse(501, sprintf(
                    'Error: Mode <b>list</b> is not implemented for model <b>%s</b>',
                    Yii::app()->request->getQuery('model')) );
                Yii::app()->end();
        }

        // Did we get some results?
        if(empty($models)) {
            // No
            $this->_sendResponse(200,
                sprintf('No items where found for model <b>%s</b>', Yii::app()->request->getQuery('model')));
        } else {
            // Prepare response
            $rows = array();
            foreach($models as $model)
                $rows[] = $model->attributes;
            // Send the response
            $this->_sendResponse(200, CJSON::encode($rows));
        }
    }

    /**
     * View $model
     */
    public function actionView()
    {
        // views by get
        $id = Yii::app()->request->getQuery('id');
        $model = null;
        if(!isset($id))
            $this->_sendResponse(500, 'Error: Parameter <b>id</b> is missing' );

        switch(Yii::app()->request->getQuery('model'))
        {
            // Find respective model
            case 'songs':
                _authAdmin();
                $this->_sendResponse(200, CJSON::encode(Songs::model()->restView($id)));
                Yii::app()->end();
                break;
            case 'bands':
                $this->_sendResponse(200, CJSON::encode(Bands::model()->restView($id)));
                Yii::app()->end();
                break;
            case 'genres':
                $model = Genres::model()->findByPk($id);
                break;
            case 'users':
                $model = Users::model()->findByPk($id);
                break;
            case 'genres':
            default:
                $this->_sendResponse(501, sprintf(
                    'Mode <b>view</b> is not implemented for model <b>%s</b>',
                    Yii::app()->request->getQuery('model')) );
                Yii::app()->end();
        }
        // No model found
        if(is_null($model))
            $this->_sendResponse(404, 'No Item found with id '.$id);
        else
            $this->_sendResponse(200, CJSON::encode($model));
    }


    /**
     * Create with POST
     */
    public function actionCreate()
    {
        _authAdmin();
        switch(Yii::app()->request->getQuery('model'))
        {
            // Get an instance of the respective model
            case 'songs':
                $model = new Songs;
                break;
            case 'users':
                $model = new Users;
                break;
            case 'genres':
                $model = new Genres;
                break;
            case 'playlists':
                $model = new Playlists;
                break;
            default:
                $this->_sendResponse(501,
                    sprintf('Mode <b>create</b> is not implemented for model <b>%s</b>',
                        Yii::app()->request->getQuery('id')) );
                Yii::app()->end();
        }

        // Try to assign POST values to attributes
        foreach($_POST as $var=>$value) {
            // Does the model have this attribute? If not raise an error
            if($model->hasAttribute($var))
                $model->$var = $value;
            else
                $this->_sendResponse(500,
                    sprintf('Parameter <b>%s</b> is not allowed for model <b>%s</b>', $var,
                        Yii::app()->request->getQuery('id')) );
        }
        // Try to save the model
        if($model->save())
            $this->_sendResponse(200, CJSON::encode($model));
        else {
            // Errors occurred
            $msg = "<h1>Error</h1>";
            $msg .= sprintf("Couldn't create model <b>%s</b>", Yii::app()->request->getQuery('model'));
            $msg .= "<ul>";
            foreach($model->errors as $attribute=>$attr_errors) {
                $msg .= "<li>Attribute: $attribute</li>";
                $msg .= "<ul>";
                foreach($attr_errors as $attr_error)
                    $msg .= "<li>$attr_error</li>";
                $msg .= "</ul>";
            }
            $msg .= "</ul>";
            $this->_sendResponse(500, $msg );
        }
    }


    /*
     * Update with POST
     */
    public function actionUpdate()
    {
        _authAdmin();
        // Using POST
        $id = Yii::app()->request->getQuery('id');
        switch(Yii::app()->request->getQuery('model'))
        {
            // Find respective model
            case 'songs':
                $model = Songs::model()->findByPk($id);
                break;
            case 'users':
                $model = Users::model()->findByPk($id);
                break;
            case 'genres':
                $model = Genres::model()->findByPk($id);
                break;
            case 'playlists':
                $model = Playlists::model()->findByPk($id);
                break;
            default:
                $this->_sendResponse(501,
                    sprintf( 'Error: Mode <b>update</b> is not implemented for model <b>%s</b>',
                        Yii::app()->request->getQuery('model')) );
                Yii::app()->end();
        }
        // Did we find the requested model? If not, raise an error
        if($model === null)
            $this->_sendResponse(400,
                sprintf("Error: Didn't find any model <b>%s</b> with ID <b>%s</b>.",
                    Yii::app()->request->getQuery('model'), $id) );

        foreach($_POST as $var=>$value) {
            // Check attr-s
            if($model->hasAttribute($var))
                $model->$var = $value;
            else {
                $this->_sendResponse(500,
                    sprintf('Parameter <b>%s</b> is not allowed for model <b>%s</b>',
                        $var, Yii::app()->request->getQuery('model')) );
            }
        }
        // Try to save the model
        if($model->save())
            $this->_sendResponse(200, CJSON::encode($model));
        else
        {
            // Errors occurred
            $msg = "<h1>Error</h1>";
            $msg .= sprintf("Couldn't update model <b>%s</b>", Yii::app()->request->getQuery('model'));
            $msg .= "<ul>";
            foreach($model->errors as $attribute=>$attr_errors) {
                $msg .= "<li>Attribute: $attribute</li>";
                $msg .= "<ul>";
                foreach($attr_errors as $attr_error)
                    $msg .= "<li>$attr_error</li>";
                $msg .= "</ul>";
            }
            $msg .= "</ul>";
            $this->_sendResponse(500, $msg );
        }
    }

    /**
     * Delete by id
     */
    public function actionDelete()
    {
        _authAdmin();
        $id = Yii::app()->request->getQuery('id');
        $model = null;
        switch(Yii::app()->request->getQuery('model'))
        {
            // Load the respective model
            case 'songs':
                $model = Songs::model()->findByPk($id);
                break;
            case 'users':
                $model = Users::model()->findByPk($id);
                break;
            case 'genres':
                $model = Genres::model()->findByPk($id);
                break;
            case 'playlists':
                $model = Playlists::model()->findByPk($id);
                break;
            default:
                $this->_sendResponse(501,
                    sprintf('Error: Mode <b>delete</b> is not implemented for model <b>%s</b>',
                        Yii::app()->request->getQuery('model')) );
                Yii::app()->end();
        }
        // Was a model found? If not, raise an error
        if($model === null)
            $this->_sendResponse(400,
                sprintf("Error: Didn't find any model <b>%s</b> with ID <b>%s</b>.",
                    Yii::app()->request->getQuery('model'), $id) );

        // Delete the model
        $num = $model->delete();
        if($num>0)
            $this->_sendResponse(200, 'Deleted');
        else
            $this->_sendResponse(500,
                sprintf("Error: Couldn't delete model <b>%s</b> with ID <b>%s</b>.",
                    Yii::app()->request->getQuery('model'), $id) );
    }

    /**
     * Sending response
     * @param int $status
     * @param string $body
     * @param string $content_type
     */
    private function _sendResponse($status = 200, $body = '', $content_type = 'text/html')
    {
        // set headers
        $status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
        header($status_header);
        header('Content-type: ' . $content_type);

        // pages with body are easy
        if($body != '')
        {
            // send the body
            echo $body;
        }
        // we need to create the body if none is passed
        else
        {
            // create some body messages
            $message = '';

            // return some error message
            switch($status)
            {
                case 401:
                    $message = 'You must be authorized to view this page.';
                    break;
                case 404:
                    $message = 'The requested URL ' . $_SERVER['REQUEST_URI'] . ' was not found.';
                    break;
                case 500:
                    $message = 'The server encountered an error processing your request.';
                    break;
                case 501:
                    $message = 'The requested method is not implemented.';
                    break;
            }

            // servers don't always have a signature turned on
            // (this is an apache directive "ServerSignature On")
            $signature = ($_SERVER['SERVER_SIGNATURE'] == '') ? $_SERVER['SERVER_SOFTWARE'] . ' Server at ' . $_SERVER['SERVER_NAME'] . ' Port ' . $_SERVER['SERVER_PORT'] : $_SERVER['SERVER_SIGNATURE'];

            // this should be templated in a real-world solution
            $body = '
                    <!DOCTYPE html>
                    <html>
                    <head>
                        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                        <title>' . $status . ' ' . $this->_getStatusCodeMessage($status) . '</title>
                    </head>
                    <body>
                        <h1>' . $this->_getStatusCodeMessage($status) . '</h1>
                        <p>' . $message . '</p>
                        <hr />
                        <address>' . $signature . '</address>
                    </body>
                    </html>';

            echo $body;
        }
        Yii::app()->end();
    }


    /**
     * Returns message code
     * @param $status
     * @return string
     */
    private function _getStatusCodeMessage($status)
    {
        // Code messages
        $codes = Array(
            200 => 'OK',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
        );
        return (isset($codes[$status])) ? $codes[$status] : '';
    }


    /**
     * Auth user
     */
    private function _checkAuth()
    {
        if(!(isset($_SERVER['HTTP_X_EMAIL']) and isset($_SERVER['HTTP_X_PASSWORD']))) {
            // Error: Unauthorized
            $this->_sendResponse(401);
        }
        $email = $_SERVER['HTTP_X_EMAIL'];
        $password = $_SERVER['HTTP_X_PASSWORD'];
        // Find the user
        $user=Users::model()->find('LOWER(email)=?',array(strtolower($email)));
        if($user===null) {
            // Error: Unauthorized
            $this->_sendResponse(401, 'Error: User Name is invalid');
        } else if(!$user->validatePassword($password)) {
            // Error: Unauthorized
            $this->_sendResponse(401, 'Error: User Password is invalid');
        }
    }

    /**
     * Auth admin
     */
    private function _authAdmin()
    {
        if(!(isset($_SERVER['HTTP_X_EMAIL']) and isset($_SERVER['HTTP_X_PASSWORD']))) {
            // Error: Unauthorized
            $this->_sendResponse(401);
        }
        $email = $_SERVER['HTTP_X_EMAIL'];
        $password = $_SERVER['HTTP_X_PASSWORD'];
        // Find the user
        $user=Users::model()->find('LOWER(email)=?',array(strtolower($email)));
        if($user===null) {
            // Error: Unauthorized
            $this->_sendResponse(401, 'Error: User Name is invalid');
        } else if(!$user->validatePassword($password)) {
            // Error: Unauthorized
            $this->_sendResponse(401, 'Error: User Password is invalid');
        } else if($user->role != 'administrator')
            $this->_sendResponse(403, 'Error: Admin only');

    }


}