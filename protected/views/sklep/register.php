
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sklep-register-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>20,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Zarejestruj się'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->