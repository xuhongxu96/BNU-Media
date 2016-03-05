<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Interview */

$this->title = '编辑新闻采访: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '新闻采访', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="interview-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
