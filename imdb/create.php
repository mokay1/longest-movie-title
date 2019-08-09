<?php
/* @var $this ImdbController */
/* @var $model Imdb */

$this->breadcrumbs=array(
	'Imdbs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Imdb', 'url'=>array('index')),
	array('label'=>'Manage Imdb', 'url'=>array('admin')),
);
?>

<h1>Create Imdb</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>