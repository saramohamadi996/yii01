<?php

namespace backend\models;

use yii\db\ActiveRecord;

class Post extends ActiveRecord
{
    public function rules()
    {
        return [
            [['title', 'content', 'data_add'], 'required'],
            ['data_add', 'integer']
        ];
    }
}