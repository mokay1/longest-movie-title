<?php
/* @var $this ImdbController */
/* @var $model Imdb */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'imdb-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'onst'); ?>
		<?php echo $form->textField($model,'onst',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'onst'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title_type'); ?>
		<?php echo $form->textField($model,'title_type',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'title_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'primary_title'); ?>
		<?php echo $form->textField($model,'primary_title',array('size'=>60,'maxlength'=>278)); ?>
		<?php echo $form->error($model,'primary_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'original_title'); ?>
		<?php echo $form->textField($model,'original_title',array('size'=>60,'maxlength'=>278)); ?>
		<?php echo $form->error($model,'original_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_adult'); ?>
		<?php echo $form->textField($model,'is_adult'); ?>
		<?php echo $form->error($model,'is_adult'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'start_year'); ?>
		<?php echo $form->textField($model,'start_year',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'start_year'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'end_year'); ?>
		<?php echo $form->textField($model,'end_year',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'end_year'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'runtime_minutes'); ?>
		<?php echo $form->textField($model,'runtime_minutes',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'runtime_minutes'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'genres'); ?>
		<?php echo $form->textField($model,'genres',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'genres'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->