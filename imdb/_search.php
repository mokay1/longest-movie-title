<?php
/* @var $this ImdbController */
/* @var $model Imdb */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'onst'); ?>
		<?php echo $form->textField($model,'onst',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'title_type'); ?>
		<?php echo $form->textField($model,'title_type',array('size'=>12,'maxlength'=>12)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'primary_title'); ?>
		<?php echo $form->textField($model,'primary_title',array('size'=>60,'maxlength'=>278)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'original_title'); ?>
		<?php echo $form->textField($model,'original_title',array('size'=>60,'maxlength'=>278)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_adult'); ?>
		<?php echo $form->textField($model,'is_adult'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'start_year'); ?>
		<?php echo $form->textField($model,'start_year',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'end_year'); ?>
		<?php echo $form->textField($model,'end_year',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'runtime_minutes'); ?>
		<?php echo $form->textField($model,'runtime_minutes',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'genres'); ?>
		<?php echo $form->textField($model,'genres',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->