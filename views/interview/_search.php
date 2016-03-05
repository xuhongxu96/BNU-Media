<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\InterviewSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="interview-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'unit') ?>

    <?= $form->field($model, 'place') ?>

    <?= $form->field($model, 'start_time') ?>

    <?php // echo $form->field($model, 'stop_time') ?>

    <?php // echo $form->field($model, 'contact') ?>

    <?php // echo $form->field($model, 'contact_method') ?>

    <?php // echo $form->field($model, 'summary') ?>

    <?php // echo $form->field($model, 'service') ?>

    <?php // echo $form->field($model, 'others') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
