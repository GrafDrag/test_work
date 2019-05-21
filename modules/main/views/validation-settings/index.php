<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\main\models\ValidationSettingsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Validation Settings');
$this->params['breadcrumbs'][] = $this->title;

$created_at = $searchModel->created_at? : null;
?>
<div class="validation-settings-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Validation Settings'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'headerOptions' => ['style' => 'width: 50px;']
            ],
            'title',
            [
                'attribute' => 'type',
                'content' => function($data) {
                    return key_exists($data->type, $data->types)? $data->types[$data->type] : false;
                },
                'filter' => \app\models\ValidationSettings::getTypes()
            ],
            'value',
            'sort',
            [
                'attribute' => 'created_at',
                'filter' => DatePicker::widget([
                    'name' => \yii\bootstrap\BaseHtml::getInputName($searchModel, 'created_at'),
                    'value' => $created_at,
                    'options' => ['class' => 'form-control', 'placeholder' => '']
                ]),
                'format' => 'date'
            ],
            //'updated_at',
            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['style' => 'width: 75px;'],
            ],
        ],
    ]); ?>


</div>
