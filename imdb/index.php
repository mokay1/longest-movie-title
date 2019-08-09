<?php
/* @var $this ImdbController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Imdbs',
);

$this->menu=array(
	array('label'=>'Create Imdb', 'url'=>array('create')),
	array('label'=>'Manage Imdb', 'url'=>array('admin')),
);
?>

<h1>Imdbs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
