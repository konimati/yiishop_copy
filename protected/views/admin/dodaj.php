<?php  
foreach ($DaneProdukty as $ProduktyPokaz) {
	echo '<tr>
			<td><p>
				<b>'.$ProduktyPokaz["nazwa"].'</b>
			</p></td>
			</tr>
			<tr>
				<td><p>'.$ProduktyPokaz["cena"].' zł/szt</p>
		</tr>';
}

?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sklep-dodaj-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'produkt_nazwa'); ?>
		<?php echo $form->textField($model,'produkt_nazwa'); ?>
		<?php echo $form->error($model,'produkt_nazwa'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'produkt_opis'); ?>
		<?php echo $form->textField($model,'produkt_opis'); ?>
		<?php echo $form->error($model,'produkt_opis'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'produkt_cena'); ?>
		<?php echo $form->textField($model,'produkt_cena'); ?>
		<?php echo $form->error($model,'produkt_cena'); ?>
	</div>

	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Dodaj produkt'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->