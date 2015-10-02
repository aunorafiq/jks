<?php
/* @var $this OngkosController */
/* @var $model Ongkos */

$this->breadcrumbs=array(
	'Ongkoses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Ongkos', 'url'=>array('index')),
	array('label'=>'Manage Ongkos', 'url'=>array('admin')),
);
?>

<h1>Pilih Tujuan dan Ongkos</h1>

<?php
	echo TbHtml::submitButton('Buat Tujuan/Ongkos Baru', array('submit'=> array("/ongkos/create3","perj"=>$_GET['id']),'color' => TbHtml::BUTTON_COLOR_PRIMARY));
 	echo '<p></p>';
 $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'ongkos-grid',
	'type' => TbHtml::GRID_TYPE_HOVER,
	'dataProvider'=>$model->search2(),
	'filter'=>$model,
	'columns'=>array(

		array(
			'header'=>'No',
			'value'=>'$data->ID_ONGKOS',
			),
		array(
			'header'=>'Satuan',
			'value'=>'$data->iDSATUAN->SATUAN',
			),
		array(
			'header'=>'Tujuan',
			'value'=>'$data->TUJUAN'
			),
		array(
			'header'=>'Harga',
			'value'=>'$data->HARGA'
			),
		array(
				'header'=>'Edit', 'type'=>'raw', 'value'=>'CHtml::link(\'edit\', array(\'ongkos/update2\', \'id\'=>$data->ID_ONGKOS,\'perj\'=>$_GET[\'id\']))'
			),
		array(
				'header'=>'Aksi', 'type'=>'raw', 'value'=>'CHtml::link(\'pilih\', array(\'ongkos/insert\', \'id\'=>$data->ID_ONGKOS,\'perj\'=>$_GET[\'id\']))'
			)
	),
));

 ?>