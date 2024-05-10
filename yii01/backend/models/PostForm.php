<?php

namespace backend\models;

use yii\base\Model;

class PostForm extends Model
{
    public $title;
    public $content;
    public $data_add;

    public function rules()
    {
        return [
            [['title', 'content', 'data_add'], 'required'],
            ['data_add', 'integer']
        ];
    }
}