<?php

/**
 * This is the model class for table "imdb".
 *
 * The followings are the available columns in table 'imdb':
 * @property integer $id
 * @property string $onst
 * @property string $title_type
 * @property string $primary_title
 * @property string $original_title
 * @property integer $is_adult
 * @property string $start_year
 * @property string $end_year
 * @property string $runtime_minutes
 * @property string $genres
 */
class Imdb extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'imdb';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('is_adult', 'numerical', 'integerOnly'=>true),
			array('onst', 'length', 'max'=>10),
			array('title_type', 'length', 'max'=>12),
			array('primary_title, original_title', 'length', 'max'=>278),
			array('start_year, end_year, runtime_minutes', 'length', 'max'=>4),
			array('genres', 'length', 'max'=>32),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, onst, title_type, primary_title, original_title, is_adult, start_year, end_year, runtime_minutes, genres', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'onst' => 'Onst',
			'title_type' => 'Title Type',
			'primary_title' => 'Primary Title',
			'original_title' => 'Original Title',
			'is_adult' => 'Is Adult',
			'start_year' => 'Start Year',
			'end_year' => 'End Year',
			'runtime_minutes' => 'Runtime Minutes',
			'genres' => 'Genres',
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
		$criteria->compare('onst',$this->onst,true);
		$criteria->compare('title_type',$this->title_type,true);
		$criteria->compare('primary_title',$this->primary_title,true);
		$criteria->compare('original_title',$this->original_title,true);
		$criteria->compare('is_adult',$this->is_adult);
		$criteria->compare('start_year',$this->start_year,true);
		$criteria->compare('end_year',$this->end_year,true);
		$criteria->compare('runtime_minutes',$this->runtime_minutes,true);
		$criteria->compare('genres',$this->genres,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Imdb the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	// Define additional variables
	public $longest_name;
	/**
	 * Returns the other imdb models that have matching titles
	 * $param int $id ID of imdb record.
	 * @return next Imdb model that matches current record.
	 */
	public function nextMatch($id, array $return_array, array $used_movies) {
		// load current model (redundant)
		$model = Imdb::model()->findByPk($id);
		//Extract last word from title. 
		$title = explode( " ", $model->primary_title);
		$title_end = end($title);
	//	$title_beg = $title[0];
		// Keep track of current movie used
		$used_movies[] = $model->id;
		$return_array[] = $model->primary_title;
		
		// find all movies whose titles start with the last word of the current movie.
		$movie = Imdb::model()->findAll(array(
			'condition'=>'primary_title LIKE :PT
							OR primary_title LIKE :AT
							OR primary_title LIKE :AnT
							OR primary_title LIKE :AndT
							OR primary_title LIKE :TheT
							OR primary_title LIKE :PluralT
							AND id NOT in ('. join(",", $used_movies) .')
							',
			'params'=>array( ':PT'=>"$title_end %",
							':AT'=>"A $title_end %",
							':AnT'=>"An $title_end %",
							':AndT'=>"And $title_end %",
							':PluralT'=>"The $title_end%'s %",
							':TheT'=>"The $title_end %",
			)
		));
		
		//Return each movie title
		$movie2_count = array();
		$next_longest_title = array();
		$cnt = 0;
		foreach ($movie as $film) {
			// Keep track of movies used
			$used_movies[] = $film->id;
			//$return_array[] = $film->primary_title;
			
			$title = explode( " ", $model->primary_title);
			$title_end = end($title);
			
			//Count movie2 to determine path  the longest title
			$movie2 = Imdb::model()->findAll(array(
			'condition'=>' (primary_title LIKE :PT
							OR primary_title LIKE :AT
							OR primary_title LIKE :AnT
							OR primary_title LIKE :AndT
							OR primary_title LIKE :TheT 
							OR primary_title LIKE :PluralT
							)
							AND id NOT in ('. join(",", $used_movies) .')
							',
			'params'=>array( ':PT'=>"$title_end %",
							':AT'=>"A $title_end %",
							':AnT'=>"An $title_end %",
							':AndT'=>"And $title_end %",
							':PluralT'=>"The $title_end%'s %",
							':TheT'=>"The $title_end %",
			)
			));
		//	$movie2_count[] = array( $film->id, count($movie2)); 
			$movie2_count[$film->id] =array( $film->primary_title, count($movie2)); 
			$longest_title = max($movie2_count);
			$next_longest_title = array_keys($movie2_count,max($movie2_count));
		
	//		$return_array = $model->nextMatch($film->id, $return_array, $used_movies);
	//		$return_array[] = "\r\n";
		}
		
		foreach( $next_longest_title as $next_title) {
			//force the use of the first title
		//if( isset($next_longest_title[0])) {
		//	$new_title = 
		//	$used_movies[] = $next_longest_title[0];
			$used_movies[] = $next_title;
			$return_array = $model->nextMatch($next_title, $return_array, $used_movies);
		}
		$return_title = array();
		$ret_title = '';
		$first_flick = true;
		$i=0;
		// initialize string of titles
	//	$ret_title .= $return_array[0];
	//	$title = explode(" ", $return_array[0]);
	//	$lastword = end($title);
	/*	foreach( $return_array as $flick) {
			if( $i = 0) {
		//		// initialize string of titles
		//		$ret_title .= $flick;
		//		// save last word of title for matching in next title
		//		
		//		$title = explode(" ", $flick);
				$lastword = end($title);
				$i++;
				echo 'b';
		//	} elseif( $i=1) {
			} else {
			//	$firstword = $title[0];
				$regex = '/('. ($lastword) .')^(?!The|An|A|And)/';
				$ret_title .= preg_replace( $regex, $flick, $ret_title);
				// save last word of title for matching in next title
				$title = explode(" ", $flick);
				$lastword = end($title);
			//	$i++;
			}
			
			
		}
	*/	
		
/* Start it up when good again..		
		foreach( $return_array as $flick) {
		//	$return_title .= $flick;
			if( $i = 0 ) {
				$title = explode(" ", $flick);
				$lastword = end($title);
			//	$firstword = $title[0];
			//	$regex = '/'. end($last_word) .'s$\b/'; \s*$
				$regex = '/('. ($lastword) .')(?!The|An|A|And)/';
			//	$return_title[] =  $flick;
				$return_title[] = preg_replace( $regex, '', $flick);
				$ret_title.= preg_replace( $regex, '', $flick);
			} elseif( $i = 1) {
//			} else {
			//	$regex = '/('. ($firstword) .')(?!The|An|A|And)/';
				$title = explode(" ", $flick);
				$firstword = $title[0];
			//	$regex = '/('. ($lastword) .')(?!The|An|A|And)/';
				$regex = '/('. ($firstword) .')(?!The|An|A|And)/';
			//	$ret_title.= preg_replace( $regex, '', $flick);
				$ret_title.= preg_replace( $regex, '', $flick);
				$return_title[] = preg_replace( $regex, '', $flick);
				$title = explode(" ", $flick);
				$lastword = end($title);
				
			//	$firstword = $title[0];
			} elseif( $i > 1 ) {
//				$title = explode(" ", $flick);
//				$firstword = $title[0];
//				$regex = '/('. ($firstword) .')(?!The|An|A|And)/';
			//	$regex = '/('. ($lastword) .')(?!The|An|A|And)/';
//				$return_title[] = preg_replace( $regex, '', $flick);
			//	$title = explode(" ", $flick);
			//	$lastword = end($title);
//			//$first_flick = false;
			}
			$i++;
		}
*/		
	//	foreach( 
		
	//	if($model==null)
	//		throw new CHttpException(404,'The requested page does not exist.');
	//	return $title_end;//->id;
//		return array( count($movie), $movie2_count);
//		return array( $return_array, count($movie));
		//count($movie);//->id;
	//	$ret_title = $return_array;
		
		
		// Clean up the consecutive duplicate words
		$regex = '/\b(\w+)(\s?\1\b)+/';
		$ret_title = preg_replace( $regex, '$1', $ret_title);
	//	return array($ret_title);
		
		foreach ($movie as $film) {
			return $film->primary_title;
		}
		//return $movie->primary_title;

	}
	
	public function findTitles($id, $used_movies) {
		$model = Imdb::model()->findByPk($id);
		//Extract last word from title. 
		$title = explode( " ", $model->primary_title);
		$title_end = end($title);
	//	$title_beg = $title[0];
		// Keep track of current movie used
	//	$used_movies[] = $model->id;
	//	$return_array[] = $model->primary_title;
		
		// find all movies whose titles start with the last word of the current movie.
		$movie = Imdb::model()->findAll(array(
			'condition'=>'primary_title REGEXP "^((a|the|of|and|an) )?('.$title_end.' )"
							AND id NOT in ('. join(",", $used_movies) .')
							',
			
		));
		
		return $movie;
	}
	
	public function title($id, $return_array, $used_movies) {
		// load current model (redundant)
		$model = Imdb::model()->findByPk($id);
		//Extract last word from title. 
		$title = explode( " ", $model->primary_title);
		$title_end = end($title);
	//	$title_beg = $title[0];
		// Keep track of current movie used
	//	$used_movies[] = $model->id;
	//	$return_array[] = $model->primary_title;
		
		// find all movies whose titles start with the last word of the current movie.
		$movie = $model->findTitles($id, $used_movies);
/*		$movie = Imdb::model()->findAll(array(
			'condition'=>'primary_title LIKE :PT
							OR primary_title LIKE :AT
							OR primary_title LIKE :AnT
							OR primary_title LIKE :AndT
							OR primary_title LIKE :TheT
							OR primary_title LIKE :PluralT
							AND id NOT in ('. join(",", $used_movies) .')
							',
			'params'=>array( ':PT'=>"$title_end %",
							':AT'=>"A $title_end %",
							':AnT'=>"An $title_end %",
							':AndT'=>"And $title_end %",
							':PluralT'=>"The $title_end%'s %",
							':TheT'=>"The $title_end %",
			)
		));
*/		
		$oth_array = array();
	
		foreach ($movie as $film) {
			$return_array[] = $film->primary_title;
			$used_movies[] = $film->id;
			
			//get last word of $film title;
			$film_title= explode( " ", $film->primary_title);
			$title_end = end($film_title);
			// find all models whch start with this word
			$next_films = $model->findTitles($film->id, $used_movies);
			//The largest value in this array is the next movie
			$oth_array[] = sizeof($next_films);
			//The location of next title's index in return_array is 1 + the index of oth_array
			
			
				
			//}
		}
		// Return all the movie titles in the db which start with the last word of this movie.
		return array( 'return_array'=>$return_array, 'oth_array'=>$oth_array );
	}
}
