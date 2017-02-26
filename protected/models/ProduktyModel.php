<?php 	

class ProduktyModel extends CFormModel
{
	public $produkt_nazwa;
	public $produkt_opis;
	public $produkt_cena;
	public $produkt_data_dodania;
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
			array('produkt_nazwa', 'produkt_cena', 'required'),
			array('produkt_nazwa', 'lenght', 'max' => 255),
		);
	}

	/**
	 * @return array customized attribute labels (name=&gt;label)
	 */
	public function attributeLabels()
	{
		return array(
			'produkt_id' => 'ID',
			'produkt_nazwa' => 'Nazwa produktu',
			'produkt_opis' => 'Opis produktu',
			'produkt_cena' => 'Cena',
			'produkt_data_dodania' => 'Data dodania',
		);
	}

	public function PobierzProdukty()
	{
		$WybierzProdukty = Yii::app()->db->createCommand('SELECT produkty.idProdukty, nazwa, opis, cena, data_dodania, url FROM produkty INNER JOIN obrazy ON produkty.idProdukty = obrazy.idProdukty');
		$DaneProduktow = $WybierzProdukty->query();

		return $DaneProduktow;
	}

	public function WybierzProdukt($id)
	{
		$WybierzProdukt = Yii::app()->db->createCommand('SELECT produkty.idProdukty, nazwa, opis, cena, data_dodania, url FROM produkty INNER JOIN obrazy ON produkty.idProdukty = obrazy.idProdukty WHERE produkty.idProdukty = :ProduktId');
		$WybierzProdukt->bindValue(':ProduktId', $id, PDO::PARAM_INT);
		$DaneProduktu = $WybierzProdukt->queryAll();

		return $DaneProduktu;
	}

	public function LiczWszystkieProdukty()
	{
		$LiczProdukty = Yii::app()->db->createCommand('SELECT count(idProdukty) AS IleProduktow FROM produkty');
		$IloscProduktow = $LiczProdukty->queryScalar();

		return $IloscProduktow;
	}

	public function WybierzProdukty($LimitNaStrone,  $ObecnaStrona)
	{
		$WybierzProdukty  =  Yii::app()->db->createCommand('SELECT produkty.idProdukty, nazwa, opis, cena, data_dodania, url FROM produkty INNER JOIN obrazy ON produkty.idProdukty = obrazy.idProdukty ORDER BY produkty.idProdukty DESC LIMIT :ZacznijOd , :UstawLimit');
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