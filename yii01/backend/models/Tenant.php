<?php

namespace app\models;

use yii\db\ActiveRecord;

class Tenant extends ActiveRecord
{
    public static function tableName()
    {
        return 'tenant';
    }

    public function rules()
    {
        return [
            [['name', 'uuid'], 'required'],
            ['name', 'string', 'max' => 255],
            ['uuid', 'string', 'max' => 36],
        ];
    }

}
