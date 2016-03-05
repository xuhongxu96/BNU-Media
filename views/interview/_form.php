<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Interview */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="interview-form">

    <div class="alert alert-success" role="alert">
        <h4>注意事项</h4>
        <ol>
            <li>新闻采访申请必须至少提前两天填写，否则不予受理。</li>
            <li>申请的媒体服务详细列出，新闻中心将根据情况安排，不列明不安排。</li>
            <li>如需专门报道请至少提前七天递交申请，或直接致电新闻中心。</li>
            <li>在此处填写，我们将记录下您的IP地址等信息，以做为验证之用，请勿填写无用信息。</li>
            <li>请注意在申请提交一个工作日之后及时查看新闻中心的审核意见。</li>
        </ol>
        <h4>新闻中心联系方式 </h4>
    </div>
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->errorSummary($model); ?>

<?php if(!$model->isNewRecord): ?>
    <hr>
<div class="bg-warning" style="border-radius: 32px; padding: 16px;">
    <h3>审核</h3>
    <?= $form->field($model, 'reply')->textarea(['maxlength' => true, 'rows' => '5']) ?>
</div>
<?php endif;?>

    <hr>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'place')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'start_time')->widget(\janisto\timepicker\TimePicker::className(), [
        'mode' => 'datetime',
        'clientOptions'=>[
            'dateFormat' => 'yy-mm-dd',
            'timeFormat' => 'HH:mm',
            'showSecond' => false,
        ]
    ]); ?>

    <?= $form->field($model, 'stop_time')->widget(\janisto\timepicker\TimePicker::className(), [
        'mode' => 'datetime',
        'clientOptions'=>[
            'dateFormat' => 'yy-mm-dd',
            'timeFormat' => 'HH:mm',
            'showSecond' => false,
        ]
    ]);?>

    <?= $form->field($model, 'contact')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_method')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'summary')->textarea(['maxlength' => true, 'rows' => '3']) ?>

    <?= $form->field($model, 'service')->textarea(['maxlength' => true, 'rows' => '3']) ?>

    <?= $form->field($model, 'others')->textarea(['maxlength' => true, 'rows' => '3']) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '确认提交申请' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success btn-block btn-lg' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
