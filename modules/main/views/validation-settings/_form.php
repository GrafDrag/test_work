<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ValidationSettings */
/* @var $form yii\widgets\ActiveForm */

$this->registerJs("vs.typeChange();", yii\web\View::POS_READY);
?>
<script>
    var vs = {
        typeChange: function () {
            if ($('#validationsettings-type').length > 0) {
                var type = $('#validationsettings-type').val(),
                    value_field = $('.field-validationsettings-value');

                if (
                    type === '<?= \app\models\ValidationSettings::TYPE_LINK; ?>' ||
                    type === '<?= \app\models\ValidationSettings::TYPE_EMAIL; ?>'
                ) {
                    value_field.css('display', 'none');
                } else {
                    value_field.css('display', 'block');
                }
            }
        }
    };
</script>
<div class="validation-settings-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'type')->dropDownList($model->types, ['onchange' => 'vs.typeChange();']) ?>

            <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'sort')->textInput() ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
