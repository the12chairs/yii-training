<?php

/**
 * This is the model class for table "songs".
 *
 * The followings are the available columns in table 'songs':
 * @property integer $id
 * @property string $title
 * @property integer $band_id
 *
 * The followings are the available model relations:
 * @property Links[] $links
 * @property Playlists[] $playlists
 * @property Bands $band
 */
class Songs extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'songs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, band_id', 'required'),
			array('band_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, band_id, band.name', 'safe', 'on'=>'search'),
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
            'genres' => array(self::MANY_MANY, 'Genres', 'links(song_id, genre_id)'),
			'links' => array(self::HAS_MANY, 'Links', 'song_id'),
			'playlists' => array(self::HAS_MANY, 'Playlists', 'song_id'),
			'band' => array(self::BELONGS_TO, 'Bands', 'band_id'),
		);
	}



    public function getGenres()
    {
        $criteria = new CDbCriteria;
        $criteria->condition = 'song_id ='. $this->id;
        $criteria->with = array('links');
        return Genres::model()->findAll($criteria);
    }


    /**
     * Get all songs with list of genres
     * @return CActiveDataProvider
     */
    public function listAll()
    {
        $criteria = new CDbCriteria(array(
            'with'=>array('genres', 'band'),
        ));
        $provider = new CActiveDataProvider('Songs', array(
            'pagination' => array(
                'pageSize' => 15,
            ),
            'criteria' => $criteria,
        ));

        return $provider;
    }


    /**
     * Generates REST array for list request
     * @return array|null array of song information
     */
    public function restList()
    {
        $criteria = new CDbCriteria(array(
            'with'=>array('genres', 'band'),
        ));
        $songs = Songs::model()->findAll($criteria);
        $resultRow = null;
        foreach($songs as $song)
        {
            $genresNames = null;
            foreach($song['genres'] as $genre)
            {
                $genresNames[] = $genre->name;
            }
            $resultRow[] = array('id'=>$song->id, 'title' =>$song->title, 'band' => $song->band->name, 'genres' => $genresNames);

        }
        return $resultRow;
    }


    /**
     * Return single song
     * @param $id
     * @return array
     */
    public function restView($id)
    {
        $criteria = new CDbCriteria(array(
            'alias'=>'s',
            'condition'=>'s.id = :id',
            'params'=>array(':id' => $id),
            'with'=>array('genres', 'band'),
        ));
        $song = Songs::model()->find($criteria);

        foreach($song['genres'] as $genre)
        {
            $genresNames[] = $genre->name;
        }

        $resultRow = array('id'=>$song->id, 'title' =>$song->title, 'band' => $song->band->name, 'genres' => $genresNames);
        return $resultRow;

    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => Yii::t('songs', 'Title'),
			'band_id' => Yii::t('songs', 'Band'),
            'band' => Yii::t('songs', 'Band'),
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
        $criteria->alias='sng';
		$criteria->compare('sng.id',$this->id);
		$criteria->compare('title',$this->title,true);
		//$criteria->compare('band_id',$this->band_id);
        $criteria->with = array('band');
        $criteria->compare('band.name',$this->band_id, true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort' => array('attributes'=>array(
                'band_search' => array(
                    'asc'=>'band.name',
                    'desc'=>'band.name DESC',
                ),
                'band.name',
                'title',
                'id',
            )),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Songs the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
