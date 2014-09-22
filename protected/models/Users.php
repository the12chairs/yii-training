<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $login
 * @property string $email
 * @property string $password
 * @property string $role
 *
 * The followings are the available model relations:
 * @property Playlists[] $playlists
 */
class Users extends CActiveRecord
{



    /**
     * Crypt password
     * @return bool
     */
    protected function beforeSave()
    {
        if(parent::beforeSave())
        {
            if($this->isNewRecord)
            {
                $this->password = CPasswordHelper::hashPassword($this->password);
            }
            return true;
        }
        else
            return false;
    }

    /**
     * For oauth extension
     * @param $email
     * @return mixed
     */
    public function findByEmail($email)
    {
        return self::model()->findByAttributes(array('email' => $email));
    }

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('login, email, password', 'required'),
			array('login, email, password, role', 'length', 'max'=>255),
            array('email', 'match', 'pattern' => '/^([a-z0-9_\.-]+)@([a-z0-9_\.-]+)\.([a-z\.]{2,6})$/', 'message' => Yii::t('users', 'Wrong email'), 'on' => 'creation'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, login, email, password, role', 'safe', 'on'=>'search'),
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
			'playlists' => array(self::HAS_MANY, 'Playlists', 'user_id'),
            'songs' => array(self::MANY_MANY, 'Songs', 'playlists(user_id, song_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'login' => Yii::t('users', 'Login'),
			'email' => Yii::t('users', 'Email'),
			'password' => Yii::t('users', 'Password'),
			'role' => Yii::t('users', 'Role'),
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

		$criteria->compare('id',$this->id);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('role',$this->role,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
