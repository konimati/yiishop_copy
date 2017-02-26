<?php  

foreach ($DaneProduktow as $ModelProduktowPokaz) 
{
	echo '<h2>'.CHtml::link($ModelProduktowPokaz['nazwa'], array('sklep/produkt/'.$ModelProduktowPokaz['idProdukty'])).'</h2>';
	$filepath = Yii::app()->request->baseUrl.'/images/'.$ModelProduktowPokaz['url'];
	echo CHtml::image($filepath, 'image', array('class' => 'banner'));
	echo '<p class ="data">Data dodania: '.$ModelProduktowPokaz['data_dodania'].'</p>';
	//echo '<p class ="tresc">'.substr($ModelProduktowPokaz['opis'], 0, 100).'...</p>';
	echo '<p class ="cena">'.$ModelProduktowPokaz['cena'].' zł/szt</p>';
	// if($Kategoria[$ModelStrona['wpis_kategoria']] != '')
	// {
	// 	echo '<p class="kategoria">Kategoria: '.CHtml::link($Kategoria[$ModelStrona['wpis_kategoria']], array('blog/kategoria/'.$ModelStrona['wpis_kategoria'])).'</p>';
	// }
}
	echo "<br /><br />";

	$this->widget('CLinkPager', array(
		'pages'=>$Strony,
		));
	//echo '</div>';
?>
