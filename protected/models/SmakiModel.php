<?php 	

class SmakiModel extends CFormModel
{
	public $smaki_nazwa;
	public $smaki_id;
	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('smaki_nazwa', 'smaki_id', 'required'),
			array('smaki_nazwa', 'lenght', 'max' => 255),
		);
	}

	/**
	 * @return array customized attribute labels (name=&gt;label)
	 */
	public function attributeLabels()
	{
		return array(
			'smaki_id' => 'ID',
			'smaki_nazwa' => 'Nazwa produktu',
		);
	}

	public function WybierzSmakProduktu($id)
	{
		$WybierzProdukt = Yii::app()->db->createCommand('SELECT smaki.* FROM smaki, produkty_has_smaki WHERE smaki.idSmaki = produkty_has_smaki.idSmaki AND produkty_has_smaki.idProdukty IN (:ProduktId)');
		$WybierzProdukt->bindValue(':ProduktId', $id, PDO::PARAM_INT);
		$DaneProduktu = $WybierzProdukt->queryAll();

		return $DaneProduktu;
	}

	public function LiczWszystkieSmakiProduktu($id)
	{
		$LiczSmaki = Yii::app()->db->createCommand('SELECT count(smaki.idSmaki) FROM smaki, produkty_has_smaki WHERE smaki.idSmaki = produkty_has_smaki.idSmaki AND produkty_has_smaki.idProdukty IN (:ProduktId)');
		$LiczSmaki->bindValue(':ProduktId', $id, PDO::PARAM_INT);
		$IloscSmakowProduktow = $LiczSmaki->queryScalar();

		return $IloscSmakowProduktow;
	}

	public function LiczWszystkieSmaki()
	{
		$LiczSmaki = Yii::app()->db->createCommand('SELECT count(smaki.idSmaki) FROM smaki, produkty_has_smaki WHERE smaki.idSmaki = produkty_has_smaki.idSmaki AND produkty_has_smaki.idProdukty');
		$IloscSmakowProduktow = $LiczSmaki->queryScalar();

		return $IloscSmakowProduktow;
	}

	public function WybierzProdukty($LimitNaStrone,  $ObecnaStrona)
	{
		$WybierzProdukty  =  Yii::app()->db->createCommand('SELECT produkty.idProdukty, nazwa, opis, cena, url FROM produkty INNER JOIN obrazy ON produkty.idProdukty = obrazy.idProdukty ORDER BY nazwa ASC LIMIT :ZacznijOd , :UstawLimit');
		$WybierzProdukty->bindValue(':ZacznijOd', ($ObecnaStrona * $LimitNaStrone), PDO::PARAM_INT);
		$WybierzProdukty->bindValue(':UstawLimit', $LimitNaStrone, PDO::PARAM_INT);
		$DaneProduktow = $WybierzProdukty->queryAll();

		return $DaneProduktow;
	}

	public function UsunProdukt($id)
	{
		$UsunKomentarz  =  Yii::app()->db->createCommand('DELETE FROM produkty WHERE idProdukty = :ProduktId');
		$UsunKomentarz->bindValue(':ProduktId', $id, PDO::PARAM_INT);
		$UsunKomentarz->execute();
	}

	public function DodajProdukt()
	{
		$DodajKategorie = Yii::app()->db->createCommand('INSERT INTO produkty (nazwa, opis, cena, data_dodania) VALUES (:ProduktNazwa, :ProduktOpis, :ProduktCena, :ProduktData)');
		$DodajKategorie->bindValue(':ProduktNazwa', $this->produkt_nazwa, PDO::PARAM_STR);
		$DodajKategorie->bindValue(':ProduktOpis', $this->produkt_opis, PDO::PARAM_STR);
		$DodajKategorie->bindValue(':ProduktCena', $this->produkt_cena, PDO::PARAM_STR);
		$DodajKategorie->bindValue(':ProduktData', $this->produkt_data_dodania, PDO::PARAM_STR);
		$DodajKategorie->execute();
	}

	public function AktualizujProdukt($id)
	{
		$AktualizujProdukt = Yii::app()->db->createCommand('UPDATE produkty SET nazwa = :ProduktNazwa, opis = :ProduktOpis, cena = :ProduktCena, data_dodania = :ProduktData WHERE idProdukty = :ProduktId');
		
		$AktualizujProdukt->bindValue(':ProduktNazwa', $this->produkt_nazwa, PDO::PARAM_STR);
		$AktualizujProdukt->bindValue(':ProduktOpis', $this->produkt_opis, PDO::PARAM_STR);
		$AktualizujProdukt->bindValue(':ProduktCena', $this->produkt_cena, PDO::PARAM_STR);
		$AktualizujProdukt->bindValue(':ProduktData', $this->produkt_data_dodania, PDO::PARAM_STR);
		$AktualizujProdukt->bindValue(':ProduktId', $id, PDO::PARAM_INT);
		
		$AktualizujProdukt ->execute();

	}
}

?>