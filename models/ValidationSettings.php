<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "validation_settings".
 *
 * @property int $id
 * @property string $title
 * @property int $type
 * @property string $value
 * @property int $sort
 * @property int $created_at
 * @property int $updated_at
 */
class ValidationSettings extends \yii\db\ActiveRecord
{
    const TYPE_WORLD    = 1;
    const TYPE_PATTERN  = 2;
    const TYPE_LINK     = 4;
    const TYPE_EMAIL    = 3;

    public function behaviors() {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'validation_settings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sort'], 'default', 'value' => 1],
            [['title'], 'required'],
            [['value'], 'required',
                'whenClient' => 'function (attribute, value) { return $(attribute.input).is(":visible");}',
                'when' => function(){
                    if(in_array($this->type, [self::TYPE_PATTERN,self::TYPE_WORLD])){
                        return true;
                    }

                    return false;
                }
            ],
            [['type', 'sort', 'created_at', 'updated_at'], 'integer'],
            [['title', 'value'], 'string', 'max' => 255],
            ['value', function($model, $value){

                switch ($this->type){
                    case self::TYPE_WORLD:
                        if(!preg_match_all('/^([\d\w]+)$/m', $this->value)){
                            $this->addError('value', Yii::t('app', 'Enter one world'));
                        }
                        break;
                    case self::TYPE_PATTERN:
                        if(@preg_match($this->value, null) === false){
                            $this->addError('value', Yii::t('app', 'Enter valid pattern'));
                        }
                        break;
                    case self::TYPE_EMAIL:
                    case self::TYPE_LINK:
                        $this->value = '';
                        break;
                }
            }]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'type' => Yii::t('app', 'Type'),
            'value' => Yii::t('app', 'Value'),
            'sort' => Yii::t('app', 'Sort'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Get validations types
     *
     * @return array
     */
    public static function getTypes() {
        return [
            self::TYPE_WORLD    => Yii::t('app', 'Validation world'),
            self::TYPE_PATTERN  => Yii::t('app', 'Validation by pattern'),
            self::TYPE_EMAIL    => Yii::t('app', 'Search email'),
            self::TYPE_LINK     => Yii::t('app', 'Search link to website'),
        ];
    }
}
