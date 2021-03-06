<?php

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#material-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Buat PO Perjalanan Baru - Step 1 : Isi informasi Perjalanan (Update) - <?php echo $model->iDKENDARAAN->NOPOL; ?></h1>

<p class="note">Jika penerbit belum terdapat pada daftar, klik tombol Buat Penerbit</p>

<button type="button" class="btn btn-default">
	<?php echo CHtml::link('Buat Penerbit',array('/penerbit/create')); ?>
</button>

<?php 
//echo TbHtml::submitButton('Buat Penerbit', array('submit'=> array("penerbit/create")));
	//,'color' => TbHtml::BUTTON_COLOR_PRIMARY));
?>
<div class="form">

<?php 
	$form=$this->beginWidget('CActiveForm', array(
	'id'=>'perjalanan-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Kolom dengan tanda <span class="required">*</span> harus diisi.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Pilih Penerbit'); ?>
		<?php $data = CHtml::listData(Penerbit::model()->findAll(), 'ID_PENERBIT', 'NAMA_PENERBIT');
        echo $form->dropDownList($model,'ID_PENERBIT', $data); ?>
		<?php echo $form->error($model,'ID_PENERBIT'); ?>
	</div>
	<!--
	<div class="row">
		<?php echo $form->labelEx($model,'ID_ONGKOS'); ?>
		<?php echo $form->textField($model,'ID_ONGKOS'); ?>
		<?php echo $form->error($model,'ID_ONGKOS'); ?>
	</div>
	-->
	<div class="row">
		<?php echo $form->labelEx($model,'Pilih Supir / Kendaraan'); ?>
		<?php $data = CHtml::listData(Kendaraan::model()->findAll(), 'ID_KENDARAAN', 'NOPOL');
        echo $form->dropDownList($model,'ID_KENDARAAN', $data); ?>
		<?php echo $form->error($model,'ID_KENDARAAN'); ?>
	</div>

	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'Tanggal Perjalanan'); ?>
		<?php echo CHtml::activeTextField($model,'TGL_PERJALANAN', array("id"=>"TGL_PERJALANAN")); ?>
		<?php $this->widget('application.extensions.calendar.SCalendar',
			array(
				'inputField'=>'TGL_PERJALANAN',
				'ifFormat'=>'%Y-%m-%d',
		)); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'NO_SURAT_PO'); ?>
		<?php echo $form->textField($model,'NO_SURAT_PO',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'NO_SURAT_PO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'JENIS_PERINTAH'); ?>
		<?php echo $form->textField($model,'JENIS_PERINTAH',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'JENIS_PERINTAH'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Buat' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div>