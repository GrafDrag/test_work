<?php


namespace app\components\behaviors;


use app\models\ValidationSettings;
use yii\base\Behavior;
use yii\db\ActiveRecord;

class CustomValidationBehavior extends Behavior
{
    public $fields = [];

    protected $errors_list = [];

    public function events(){
        return [
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'validateFields'
        ];
    }

    public function validateFields ( $event ) {
        $res = false;

        $validators_list = ValidationSettings::find()
            ->orderBy(['sort' => SORT_ASC])
            ->all();

        if(!empty($this->fields) && is_array($this->fields) && !empty($validators_list)){
            foreach ($this->fields as $field){
                if(isset($this->owner->$field)){
                    $value = $this->owner->$field;

                    /** @var ValidationSettings $item */
                    foreach ($validators_list as $item){
                        $matches = [];
                        switch ($item->type){
                            case ValidationSettings::TYPE_WORLD:
                                $pattern = "/($item->value)/";
                                break;
                            case ValidationSettings::TYPE_PATTERN:
                                $pattern = $item->value;
                                break;
                            case ValidationSettings::TYPE_EMAIL:
                                $pattern = '/(([A-Za-z0-9]+_+)|([A-Za-z0-9]+\-+)|([A-Za-z0-9]+\.+)|([A-Za-z0-9]+\++))*[A-Za-z0-9]+@((\w+\-+)|(\w+\.))*\w{1,63}\.[a-zA-Z]{2,6}/';
                                break;
                            case ValidationSettings::TYPE_LINK:
                                $pattern = '/(?:http(s)?:\/\/)?[\w.-]+(?:\.[\w\.-]+)+[\w\-\._~:\/?#[\]@!\$&\'\(\)\*\+,;=.]+/';
                                break;
                        }

                        $result = preg_match_all($pattern, $value,$matches);

                        if($result){
                            $this->errors_list[] = \Yii::t('app', 'Validate by pattern "{name}". result: {worlds}', [
                                'name' => $item->title,
                                'worlds' => implode(', ', $matches[0])
                            ]);
                        }
                    }
                    if(!empty($this->errors_list)){
                        $this->owner->addError($field, implode('<br>', $this->errors_list));
                        $event->isValid = false;
                    }
                    $this->errors_list = [];
                }
            }
        }




        $event->isValid = false;

        //echo __FILE__ . ':' . __LINE__.' <pre>'; print_r($event);echo '</pre>';exit;

        return $res;
    }
}