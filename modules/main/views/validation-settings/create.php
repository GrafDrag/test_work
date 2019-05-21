<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ValidationSettings */

$this->title = Yii::t('app', 'Create Validation Settings');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Validation Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="validation-settings-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
