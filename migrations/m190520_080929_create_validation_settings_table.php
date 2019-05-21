<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%validation_settings}}`.
 */
class m190520_080929_create_validation_settings_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%validation_settings}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'type' => $this->integer(2)->defaultValue(1),
            'value' => $this->string(),
            'sort' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        $fields = ['title' => 'Наличия запрещенных слов','type' => \app\models\ValidationSettings::TYPE_WORLD,'value' => 'SiteAnalyst','sort' => 1,'created_at' => time(),'updated_at' => time(),];

        $this->insert('validation_settings', $fields);

        $fields['value'] = 'SiteAdmin';
        $fields['sort']++;
        $this->insert('validation_settings', $fields);

        $fields['value'] = 'Administration';
        $fields['sort']++;
        $this->insert('validation_settings', $fields);

        $fields['title'] = 'Набору регулярных выражений';
        $fields['value'] = '/(f+a+c+e+b+[o0]+[o0]+k+)/';
        $fields['type'] = \app\models\ValidationSettings::TYPE_PATTERN;
        $fields['sort']++;
        $this->insert('validation_settings', $fields);

        $fields['value'] = '/(f+(a+)?.{1,2}c+e+b+.{1,2}o+k+)/';
        $fields['sort']++;
        $this->insert('validation_settings', $fields);

        $fields['value'] = '/(f+.{1,3}b+o+[kc]+)/';
        $fields['sort']++;
        $this->insert('validation_settings', $fields);

        $fields['title'] = 'Наличия email';
        $fields['value'] = '';
        $fields['type'] = \app\models\ValidationSettings::TYPE_EMAIL;
        $fields['sort']++;
        $this->insert('validation_settings', $fields);

        $fields['title'] = 'Наличия ссылок на веб ресурсы';
        $fields['type'] = \app\models\ValidationSettings::TYPE_LINK;
        $fields['sort']++;
        $this->insert('validation_settings', $fields);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%validation_settings}}');
    }
}
