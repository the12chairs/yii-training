<?php

/**
 * This is the model class for table "links".
 *
 * The followings are the available columns in table 'links':
 * @property integer $id
 * @property integer $genre_id
 * @property integer $song_id
 *
 * The followings are the available model relations:
 * @property Songs $song
 * @property Genres $genre
 */
class Links extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'links';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('genre_id, song_id', 'required'),
			array('genre_id, song_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, genre_id, song_id', 'safe', 'on'=>'search'),
		);
	}


    /**
     * remove entity(s) from DB
     * @param $sId
     * @param $gId
     */
    public function remove($sId, $gId)
    {
        $criteria = new CDbCriteria;
        $criteria->condition = 'song_id = :sid and genre_id = :gid';
        $criteria->params = array(':sid'=>$sId, ':gid'=>$gId);
        Links::model()->deleteAll($criteria);

    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'song' => array(self::BELONGS_TO, 'Songs', 'song_id'),
			'genre' => array(self::BELONGS_TO, 'Genres', 'genre_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'genre_id' => 'Genre',
			'song_id' => 'Song',
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
		$criteria->compare('genre_id',$this->genre_id);
		$criteria->compare('song_id',$this->song_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Links the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
