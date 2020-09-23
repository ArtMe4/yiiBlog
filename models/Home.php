<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "articles".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $title
 * @property string $text
 * @property string $link
 * @property string $time_add
 * @property string $ip
 * @property int|null $flag
 */
class Home extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'articles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'title', 'text'], 'required'],
            [['link'], 'string'],
            [['time_add'], 'safe'],
            [['ip', 'flag'], 'string'],
            [['name'], 'string', 'max' => 25],
            [['email'], 'string', 'max' => 40],
            [['title'], 'string', 'max' => 50],
            [['text'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'email' => 'E-mail',
            'title' => 'Заголовок статьи',
            'text' => 'Текст статьи',
            'link' => 'Ссылка на источник',
            'time_add' => function() {
                                    return gmdate('Y-m-d H:i:s');
                                },
            'ip' => function() {
                                return Yii::$app->request->userIP;
                            },
            'flag' => 'Флаг модерации',
        ];
    }
}
