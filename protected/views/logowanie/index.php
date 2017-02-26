<h1>Zaloguj się</h1>

<div class="form">
	<?php
		$form=$this->beginWidget('CActiveForm', array(
		'id'=>'blog-komentarze-zaloguj-form',
		'enableAjaxValidation'=>false,
		));

	?>
	<p class="note">Pola oznaczone <span class="required">*</span> są wymagane.</p>
		<?php
		if($BladDanych)
		{
			echo '<div class="zle"> Wpisałeś złe dane!</div>';	
		}
		echo $form->errorSummary($UzytkownicyModel);
		?>
	<div class="row">
		<?php 
		echo $form->labelEx($UzytkownicyModel, 'login');
		echo $form->textField($UzytkownicyModel, 'login');
		echo $form->error($UzytkownicyModel, 'login');
		?>
	</div>
	<div class="row">
		<?php 
		echo $form->labelEx($UzytkownicyModel, 'haslo');
		echo $form->passwordField($UzytkownicyModel, 'haslo');
		echo $form->error($UzytkownicyModel, 'haslo');
		?>
	</div>
	<div class="row buttons">
		<?php  
			echo CHtml::submitButton('Zaloguj');
		?>
	</div>
		<?php  
			$this->endWidget();
		?>
</div>
