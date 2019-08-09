<?php
/* @var $this ImdbController */
/* @var $model Imdb */

$this->breadcrumbs=array(
	'Imdbs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Imdb', 'url'=>array('index')),
	array('label'=>'Create Imdb', 'url'=>array('create')),
	array('label'=>'View Imdb', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Imdb', 'url'=>array('admin')),
);
?>

<h1>Update Imdb <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>