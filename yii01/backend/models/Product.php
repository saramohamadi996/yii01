<?php

namespace backend\models;

use yii\db\ActiveRecord;

class Product extends ActiveRecord
{
    public static function tableName()
    {
        return 'product';
    }

    public function rules()
    {
        return [
            [['name', 'price','description'], 'required'],
            ['price', 'number'],
            ['name', 'string', 'max' => 255]
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'name',
            'price' => 'price',
            'description' => 'description',
        ];
    }
}