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

<b><?php echo 'Longer Movie Title' ?>:</b>
	<?php echo CHtml::link(CHtml::encode($model->primary_title), array('title', 'id'=>$model->id)); ?>
	<br />