<?php
/* @var $this ImdbController */
/* @var $model Imdb */

$this->breadcrumbs=array(
	'Imdbs'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Imdb', 'url'=>array('index')),
	array('label'=>'Create Imdb', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#imdb-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Imdbs</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'imdb-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'onst',
		'title_type',
		'primary_title',
		'original_title',
		'is_adult',
		array(
				'name'=>'longest_name',
				'type'=>'raw',
				'value' => $model->nextMatch('$data->id'),
		//		'cssClassExpression'=>"'gridcolumn'",
				'htmlOptions'=>array('title'=>'%0'), 
		),
		/*
		'start_year',
		'end_year',
		'runtime_minutes',
		'genres',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
