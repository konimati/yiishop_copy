<?php  

foreach ($WybranyProdukt as $ModelProduktuPokaz) 
{
	echo '<h2>'.$ModelProduktuPokaz['nazwa'].'</h2>';
	$filepath = Yii::app()->request->baseUrl.'/images/'.$ModelProduktuPokaz['url'];
	echo CHtml::image($filepath, 'image', array('class' => 'banner'));
	echo '<p class ="tresc">'.$ModelProduktuPokaz['opis'].'</p>';
	echo '<p class ="cena">'.$ModelProduktuPokaz['cena'].' zł/szt</p>';
	echo '<p class ="data">Data dodania: '.$ModelProduktuPokaz['data_dodania'].'</p>';
}
	echo '<label><span>Smak</span><select name="smak_produktu">';
foreach ($WybranySmakProduktu as $ModelSmakPokaz) 
{
	echo '<option value="'.$ModelSmakPokaz["nazwa"].'">'.$ModelSmakPokaz["nazwa"].'</option>';		
}
echo '<input type="number" name="ilosc" value="1" min="1" /><br />';
	// if($Kategoria[$ModelStrona['wpis_kategoria']] != '')
	// {
	// 	echo '<p class="kategoria">Kategoria: '.CHtml::link($Kategoria[$ModelStrona['wpis_kategoria']], array('blog/kategoria/'.$ModelStrona['wpis_kategoria'])).'</p>';
	// }

	echo "<br /><br />";

	
	//echo '</div>';
?>
