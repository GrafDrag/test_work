<?php


namespace app\modules\main\models;


use app\components\behaviors\CustomValidationBehavior;
use yii\base\Model;

/**
 * Class Form
 * @package app\modules\main\models
 *
 * @property string $validate_input
 */
class Form extends Model
{
    public $validate_input;

    public function behaviors() {
        return [
            'customValidation' => [
                'class' => CustomValidationBehavior::class,
                'fields' => ['validate_input'],
            ]
        ];
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['validate_input'], 'required'],
        ];
    }
}