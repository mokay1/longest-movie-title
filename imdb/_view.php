<?php
/* @var $this ImdbController */
/* @var $data Imdb */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('onst')); ?>:</b>
	<?php echo CHtml::encode($data->onst); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title_type')); ?>:</b>
	<?php echo CHtml::encode($data->title_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('primary_title')); ?>:</b>
	<?php echo CHtml::encode($data->primary_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('original_title')); ?>:</b>
	<?php echo CHtml::encode($data->original_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_adult')); ?>:</b>
	<?php echo CHtml::encode($data->is_adult); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('start_year')); ?>:</b>
	<?php echo CHtml::encode($data->start_year); ?>
	<br />

	<b><?php echo '10 Longest Movie Titles' ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->primary_title), array('title', 'id'=>$data->id)); ?>
	<br />
	
	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('end_year')); ?>:</b>
	<?php echo CHtml::encode($data->end_year); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('runtime_minutes')); ?>:</b>
	<?php echo CHtml::encode($data->runtime_minutes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('genres')); ?>:</b>
	<?php echo CHtml::encode($data->genres); ?>
	<br />

	*/ ?>

</div>