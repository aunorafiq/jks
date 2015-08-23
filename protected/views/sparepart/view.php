<?php
/* @var $this SparepartController */
/* @var $model Sparepart */

$this->breadcrumbs=array(
	'Spareparts'=>array('index'),
	$model->ID_SPAREPART,
);

$this->menu=array(
	array('label'=>'List Sparepart', 'url'=>array('index')),
	array('label'=>'Create Sparepart', 'url'=>array('create')),
	array('label'=>'Update Sparepart', 'url'=>array('update', 'id'=>$model->ID_SPAREPART)),
	array('label'=>'Delete Sparepart', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_SPAREPART),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Sparepart', 'url'=>array('admin')),
);
?>

<h1>View Sparepart #<?php echo $model->ID_SPAREPART; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID_SPAREPART',
		'NAMA_BARANG',
		'HARGA_SATUAN',
		'STOK',
	),
)); ?>
