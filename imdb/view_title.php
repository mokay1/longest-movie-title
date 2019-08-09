<?php
/* @var $this ImdbController */
/* @var $model Imdb */

$this->breadcrumbs=array(
	'Imdbs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Imdb', 'url'=>array('index')),
	array('label'=>'Create Imdb', 'url'=>array('create')),
	array('label'=>'Update Imdb', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Imdb', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Imdb', 'url'=>array('admin')),
);
?>

<h1>View Imdb #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'onst',
		'title_type',
		'primary_title',
		'original_title',
		'is_adult',
		'start_year',
		'end_year',
		'runtime_minutes',
		'genres',
	),
)); ?>

<?php
	//initialize return_array and pass thru to first call of function
	$return_array = array();
	$used_movies = array();
	// Keep track of current movie used
		$used_movies[] = $model->id;
		$return_array[] = $model->primary_title;
	
	
	// Return of the model function
//	print_r( $model->nextMatch($model->id, $return_array, $used_movies));
	$next_titles = $model->title($model->id, $return_array, $used_movies);
	print_r($next_titles);
	//echo sizeof($next_titles);
/*	
	// Get the last word of the primary_title
	$title_end = explode( " ", $model->primary_title);
	//Find all Movie titles that start with the last word of this movie title
	$title_oth = Imdb::model()->findAll(array(
			'condition'=>'primary_title LIKE :PT
							OR primary_title LIKE :AT
							OR primary_title LIKE :AnT
							OR primary_title LIKE :AndT
							OR primary_title LIKE :TheT
							OR primary_title LIKE :PluralT
							',
			'params'=>array( ':PT'=>'"{$title_end} %"',
							':AT'=>'"A $title_end %"',
							':AnT'=>'"An $title_end %"',
							':AndT'=>'"And $title_end %"',
							':PluralT'=>'"The $title_end%s %"',
							':TheT'=>'"The $title_end %"',
			)
		));
			
	print_r($title_oth);
*/
?>