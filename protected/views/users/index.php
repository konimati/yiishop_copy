<?php  
if(!empty($DaneAdresy))
{
	echo '<h2>Twój adres:</h2><br />';
	foreach ($DaneAdresy as $ModelDaneAdresyPokaz) 
	{
		echo '<p>Imie: '.$ModelDaneAdresyPokaz['imie'].'</p>';
		echo '<p>Nazwisko: '.$ModelDaneAdresyPokaz['nazwisko'].'</p>';
		echo '<p>Miejscowosc: '.$ModelDaneAdresyPokaz['miejscowosc'].'</p>';
		echo '<p>Ulica: '.$ModelDaneAdresyPokaz['ulica'].'</p>';
		echo '<p>Nr domu: '.$ModelDaneAdresyPokaz['nr_domu'].'</p>';
		if(isset($ModelDaneAdresyPokaz['nr_lokalu']))
			echo '<p>Nr lokalu: '.$ModelDaneAdresyPokaz['nr_lokalu'].'</p>';
		echo '<p>Kod pocztowy: '.$ModelDaneAdresyPokaz['kod_pocztowy'].'</p>';
	}
	echo "<br /><br />";
}
else
{
	echo '<h2>Brak adresu</h2><br />';
}


?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-index-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	 'clientOptions'=>array(
	 	'validateOnSubmit'=>true,
	 ),
)); ?>


	<p class="note">Pola oznaczone <span class="required">*</span> są wymagane.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'imie'); ?>
		<?php echo $form->textField($model,'imie'); ?>
		<?php echo $form->error($model,'imie'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nazwisko'); ?>
		<?php echo $form->textField($model,'nazwisko'); ?>
		<?php echo $form->error($model,'nazwisko'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'miejscowosc'); ?>
		<?php echo $form->textField($model,'miejscowosc'); ?>
		<?php echo $form->error($model,'miejscowosc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ulica'); ?>
		<?php echo $form->textField($model,'ulica'); ?>
		<?php echo $form->error($model,'ulica'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nr_domu'); ?>
		<?php echo $form->textField($model,'nr_domu'); ?>
		<?php echo $form->error($model,'nr_domu'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nr_lokalu'); ?>
		<?php echo $form->textField($model,'nr_lokalu'); ?>
		<?php echo $form->error($model,'nr_lokalu'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kod_pocztowy'); ?>
		<?php echo $form->textField($model,'kod_pocztowy'); ?>
		<?php echo $form->error($model,'kod_pocztowy'); ?>
	</div>

	<div class="row buttons">
			<?php echo CHtml::submitButton('Dodaj adres'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->