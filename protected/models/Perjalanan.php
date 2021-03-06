<?php

/**
 * This is the model class for table "perjalanan".
 *
 * The followings are the available columns in table 'perjalanan':
 * @property integer $ID_PERJALANAN
 * @property integer $ID_PENERBIT
 * @property integer $ID_ONGKOS
 * @property integer $ID_KENDARAAN
 * @property string $TGL_PERJALANAN
 * @property string $NO_SURAT_PO
 * @property string $JENIS_PERINTAH
 * @property string $RITASE
 * @property integer $TITIPAN_AWAL
 * @property integer $LEBIH
 * @property integer $KURANG
 * @property integer $AKHIR
 *
 * The followings are the available model relations:
 * @property Penerbit $iDPENERBIT
 * @property Ongkos $iDONGKOS
 * @property Kendaraan $iDKENDARAAN
 */
class Perjalanan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */

	public $from_date;
	public $to_date;

	public function tableName()
	{
		return 'perjalanan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_PENERBIT, ID_KENDARAAN, TGL_PERJALANAN, NO_SURAT_PO', 'required'),
			array('ID_PENERBIT, ID_ONGKOS, ID_KENDARAAN, RITASE, TITIPAN_AWAL, TAMBAHAN, SISA, UANG_DIBERIKAN, UANG_DIBAWA', 'numerical', 'integerOnly'=>true),
			array('NO_SURAT_PO, JENIS_PERINTAH', 'length', 'max'=>20),
			array('STATUS', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_PERJALANAN, ID_PENERBIT, ID_ONGKOS, ID_KENDARAAN, TGL_PERJALANAN, NO_SURAT_PO, JENIS_PERINTAH,from_date, to_date, RITASE, TITIPAN_AWAL, TAMBAHAN, SISA, UANG_DIBERIKAN, UANG_DIBAWA, STATUS', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'iDPENERBIT' => array(self::BELONGS_TO, 'Penerbit', 'ID_PENERBIT'),
			//'iDONGKOS' => array(self::BELONGS_TO, 'Ongkos', 'ID_ONGKOS'),
			'iDKENDARAAN' => array(self::BELONGS_TO, 'Kendaraan', 'ID_KENDARAAN'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_PERJALANAN' => 'Id Perjalanan',
			'ID_PENERBIT' => 'Id Penerbit',
			'ID_ONGKOS' => 'Id Ongkos',
			'ID_KENDARAAN' => 'Id Kendaraan',
			'TGL_PERJALANAN' => 'Tgl Perjalanan',
			'NO_SURAT_PO' => 'No Surat Po',
			'JENIS_PERINTAH' => 'Jenis Perintah',
			'RITASE' => 'Ritase',
			'TITIPAN_AWAL' => 'Titipan Awal',
			'TAMBAHAN' => 'Tambahan',
			'SISA' => 'Sisa',
			'UANG_DIBERIKAN' => 'Uang Diberikan',
			'UANG_DIBAWA' => 'Uang Dibawa',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ID_PERJALANAN',$this->ID_PERJALANAN);
		$criteria->compare('ID_PENERBIT',$this->ID_PENERBIT);
		$criteria->compare('ID_ONGKOS',$this->ID_ONGKOS);
		$criteria->compare('ID_KENDARAAN',$this->ID_KENDARAAN);
		$criteria->compare('TGL_PERJALANAN',$this->TGL_PERJALANAN,true);
		$criteria->compare('NO_SURAT_PO',$this->NO_SURAT_PO,true);
		$criteria->compare('JENIS_PERINTAH',$this->JENIS_PERINTAH,true);
		$criteria->compare('RITASE',$this->RITASE,true);
		$criteria->compare('TITIPAN_AWAL',$this->TITIPAN_AWAL);
		$criteria->compare('TAMBAHAN',$this->TAMBAHAN);
		$criteria->compare('SISA',$this->SISA);
		$criteria->compare('UANG_DIBERIKAN',$this->UANG_DIBERIKAN);
		$criteria->compare('UANG_DIBAWA',$this->UANG_DIBAWA);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
            		'defaultOrder'=>'TGL_PERJALANAN DESC',
            		),
			'pagination'=> array(
				'pageSize'=>'10'
				),
		));
	}

	public function search2()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		if (!empty($this->from_date) && empty($this->to_date))
		{
			$criteria->condition = "TGL_PERJALANAN>='$this->from_date'";
			$criteria->compare('ID_PENERBIT',$this->ID_PENERBIT);
			$criteria->compare('ID_KENDARAAN',$this->ID_KENDARAAN);
		}
		else if (empty($this->from_date) && !empty($this->to_date))
		{
			$criteria->condition = "TGL_PERJALANAN<='$this->to_date'";
			$criteria->compare('ID_PENERBIT',$this->ID_PENERBIT);
			$criteria->compare('ID_KENDARAAN',$this->ID_KENDARAAN);
		}
		else if (!empty($this->from_date) && !empty($this->to_date))
		{
			$criteria->condition = "TGL_PERJALANAN>='$this->from_date' and TGL_PERJALANAN<='$this->to_date'";
			$criteria->compare('ID_PENERBIT',$this->ID_PENERBIT);
			$criteria->compare('ID_KENDARAAN',$this->ID_KENDARAAN);
		}
		else 
			{
				$criteria->compare('ID_PENERBIT',$this->ID_PENERBIT);
				$criteria->compare('ID_KENDARAAN',$this->ID_KENDARAAN);
			}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
            		'defaultOrder'=>'TGL_PERJALANAN DESC',
            		),
			'pagination'=> array(
				'pageSize'=>'10'
				),
		));
	}


	public function namaAksi ($id, $stat_cetak, $jenis_t)

	{
		$idpeg = Yii::app()->user->id;
		$previlage = Yii::app()->db->createCommand()
		->select('ID_PREVILAGE')
		->from('pegawai')
		->where('ID_PEGAWAI=:ID_PEGAWAI',array(':ID_PEGAWAI'=>$idpeg))
		->queryScalar();
		$idpem = Yii::app()->db->createCommand()->select('ID_TIM_PEMERIKSA')->from('tim_pemeriksa')->where('ID_KETUA=:ID_KETUA or ID_SEKRETARIS=:ID_SEKRETARIS or ID_ANGGOTA_1=:ID_ANGGOTA_1 or ID_ANGGOTA_2=:ID_ANGGOTA_2 or ID_ANGGOTA_3=:ID_ANGGOTA_3',array(':ID_KETUA'=>$idpeg, ':ID_SEKRETARIS'=>$idpeg, ':ID_ANGGOTA_1'=>$idpeg, ':ID_ANGGOTA_2'=>$idpeg, ':ID_ANGGOTA_3'=>$idpeg))->queryScalar();
		$idtim = Yii::app()->db->createCommand()->select('ID_TIM_PEMERIKSA')->from('transaksi')->where('ID_TRANSAKSI=:ID_TRANSAKSI',array(':ID_TRANSAKSI'=>$id))->queryScalar();

		if ($jenis_t==1)
		{
			if  (($previlage == 1 && $stat_cetak == "BARU") ||
				($previlage == 1 && $stat_cetak == "BA") ||
				($previlage == 1 && $stat_cetak == "NODIN") ||
				($previlage == 2 && $stat_cetak == "NODIN" && $idpem==$idtim) ||
				($previlage == 3 && $stat_cetak == "NODIN" && $idpem==$idtim) ||
				($previlage == 4 && $stat_cetak == "NODIN" && $idpem==$idtim) ||
				($previlage == 11 && $stat_cetak == "NODIN" && $idpem==$idtim) ||
				($previlage == 12 && $stat_cetak == "NODIN" && $idpem==$idtim) ||
				($previlage == 3 && $stat_cetak == "TUG4") ||
				($previlage == 3 && $stat_cetak == "TANDA_TERIMA"))
				return "PROSES";
			else
				return "LIHAT";
		}

		else
		{
			if  (($previlage == 1 && ($stat_cetak == "TANDA_TERIMA" || $stat_cetak == "ADMINISTRASI")) ||
				($previlage == 3 && $stat_cetak == "TANDA_TERIMA"))
				return "PROSES";
			else
				return "LIHAT";
		}
			
	}

	public function linkAksi($id_jenis, $cetak, $namaksi, $idtrans)
	{
		$id = Yii::app()->user->id;
		$previlage = Yii::app()->db->createCommand()
		->select('ID_PREVILAGE')
		->from('pegawai')
		->where('ID_PEGAWAI=:ID_PEGAWAI',array(':ID_PEGAWAI'=>$id))
		->queryScalar();

		$foto = Transaksi::model()->findAllByAttributes(array('ID_TRANSAKSI'=>$idtrans));

		foreach ($foto as $i=>$ii)
		{
			if ($id_jenis==1)
			{
				if (file_exists(Yii::getPathOfAlias('webroot').'/images/foto_barang_masuk/'.$ii['FOTO_DOKUMEN_1']))
				{
					rename(Yii::getPathOfAlias('webroot').'/images/foto_barang_masuk/'.$ii['FOTO_DOKUMEN_1'],
					Yii::getPathOfAlias('webroot').'/images/foto_barang_masuk/'.$idtrans.'_foto_dokumen1.jpg');
					Transaksi::model()->updateByPk($idtrans,array("FOTO_DOKUMEN_1"=>$idtrans.'_foto_dokumen1.jpg'));
				}
				if (file_exists(Yii::getPathOfAlias('webroot').'/images/foto_barang_masuk/'.$ii['FOTO_DOKUMEN_2']))
				{
					rename(Yii::getPathOfAlias('webroot').'/images/foto_barang_masuk/'.$ii['FOTO_DOKUMEN_2'],
					Yii::getPathOfAlias('webroot').'/images/foto_barang_masuk/'.$idtrans.'_foto_dokumen2.jpg');
					Transaksi::model()->updateByPk($idtrans,array("FOTO_DOKUMEN_2"=>$idtrans.'_foto_dokumen2.jpg'));
				}
				if (file_exists(Yii::getPathOfAlias('webroot').'/images/foto_barang_masuk/'.$ii['FOTO_DOKUMEN_3']))
				{
					rename(Yii::getPathOfAlias('webroot').'/images/foto_barang_masuk/'.$ii['FOTO_DOKUMEN_3'],
					Yii::getPathOfAlias('webroot').'/images/foto_barang_masuk/'.$idtrans.'_foto_dokumen3.jpg');
					Transaksi::model()->updateByPk($idtrans,array("FOTO_DOKUMEN_3"=>$idtrans.'_foto_dokumen3.jpg'));
				}
			}
			else
			{
				if (file_exists(Yii::getPathOfAlias('webroot').'/images/foto_barang_keluar/'.$ii['FOTO_DOKUMEN_1']))
				{
					rename(Yii::getPathOfAlias('webroot').'/images/foto_barang_keluar/'.$ii['FOTO_DOKUMEN_1'],
					Yii::getPathOfAlias('webroot').'/images/foto_barang_keluar/'.$idtrans.'_foto_dokumen1.jpg');
					Transaksi::model()->updateByPk($idtrans,array("FOTO_DOKUMEN_1"=>$idtrans.'_foto_dokumen1.jpg'));
				}
				if (file_exists(Yii::getPathOfAlias('webroot').'/images/foto_barang_keluar/'.$ii['FOTO_DOKUMEN_2']))
				{
					rename(Yii::getPathOfAlias('webroot').'/images/foto_barang_keluar/'.$ii['FOTO_DOKUMEN_2'],
					Yii::getPathOfAlias('webroot').'/images/foto_barang_keluar/'.$idtrans.'_foto_dokumen2.jpg');
					Transaksi::model()->updateByPk($idtrans,array("FOTO_DOKUMEN_2"=>$idtrans.'_foto_dokumen2.jpg'));
				}
				if (file_exists(Yii::getPathOfAlias('webroot').'/images/foto_barang_keluar/'.$ii['FOTO_DOKUMEN_3']))
				{
					rename(Yii::getPathOfAlias('webroot').'/images/foto_barang_keluar/'.$ii['FOTO_DOKUMEN_3'],
					Yii::getPathOfAlias('webroot').'/images/foto_barang_keluar/'.$idtrans.'_foto_dokumen3.jpg');
					Transaksi::model()->updateByPk($idtrans,array("FOTO_DOKUMEN_3"=>$idtrans.'_foto_dokumen3.jpg'));
				}
			}
		}

		

		if ($id_jenis == 1 && $namaksi == "PROSES")
		{
			if($previlage == 1 && $cetak == "BARU")
			{
				return "update";
			}
			else if($previlage == 1 && $cetak == "NODIN")
			{
				return "update1a";
			}
			else if(($previlage == 2 || $previlage == 3 || $previlage == 4 || $previlage == 11 || $previlage == 12) && $cetak == "NODIN")
			{
				return "update1";
			}
			else if($previlage == 1 && $cetak == "BA")
			{
				return "update2";
			}
			else if(($previlage == 3 && $cetak == "TUG4"))
			{
				return "updatea";
			}
		}
		else if ($id_jenis == 1 && $namaksi == "LIHAT")
			return "viewdetail";
		else if ($id_jenis == 2 && $namaksi == "PROSES")
		{
			if(($cetak == "TANDA_TERIMA" || $cetak == "ADMINISTRASI") && $previlage == 1)
				return "keluarproses";
			else if ($cetak == "TANDA_TERIMA" && $previlage==3)
				return "keluarapprove";
		}
		else if ($id_jenis == 2 && $namaksi == "LIHAT")
		{
			if($previlage == 1 && ($cetak == 'TUG8' || $cetak == 'TUG9'))
				return "keluarlihatproses";
			else
				return "keluarlihat";
		}
			
	}
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Perjalanan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function hitungtotalawal($records)
	{
		$jumlah = 0;
		foreach ($records as $rekam_data) {
			$jumlah += $rekam_data->TITIPAN_AWAL;
		}
		return $jumlah;
	}

	public function hitungtotalritase($records)
	{
		$jumlah = 0;
		foreach ($records as $rekam_data) {
			$jumlah += $rekam_data->RITASE;
		}
		return $jumlah;
	}

	public function hitungtotaltambahan($records)
	{
		$jumlah = 0;
		foreach ($records as $rekam_data) {
			$jumlah += $rekam_data->TAMBAHAN;
		}
		return $jumlah;
	}

	public function hitungtotalsisa($records)
	{
		$jumlah = 0;
		foreach ($records as $rekam_data) {
			$jumlah += $rekam_data->SISA;
		}
		return $jumlah;
	}

	public function hitungtotalberi($records)
	{
		$jumlah = 0;
		foreach ($records as $rekam_data) {
			$jumlah += $rekam_data->UANG_DIBERIKAN;
		}
		return $jumlah;
	}

	public function hitungtotalbawa($records)
	{
		$jumlah = 0;
		foreach ($records as $rekam_data) {
			$jumlah += $rekam_data->UANG_DIBAWA;
		}
		return $jumlah;
	}
}
