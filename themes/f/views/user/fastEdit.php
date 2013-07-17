<?php $this->breadcrumbs=array(
    '订单号：' . $model->id,
);?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'fast-edit-fastedit-form',
    'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>

<div class="row">
    <?php echo $form->labelEx($model,'original'); ?><br />
    <?php echo $model->original; ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model,'translation'); ?>
    <?php echo $form->error($model,'translation'); ?>
    <?php echo $form->textArea($model,'translation',array('rows'=>6, 'cols'=>100, 'placeholder'=>'译文内容请填写在这里。')); ?>
</div>
<div class="row buttons">
    <?php echo CHtml::submitButton('提交译文'); ?>
</div>
<?php $this->endWidget(); ?>
</div><!-- form -->
