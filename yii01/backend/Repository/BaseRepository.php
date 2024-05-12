<?php

namespace backend\components;

use yii\db\ActiveRecord;
use yii\web\NotFoundHttpException;

class BaseRepository
{
    protected $modelClass;

    public function __construct($modelClass)
    {
        $this->modelClass = $modelClass;
    }

    public function findModel($id)
    {
        $model = call_user_func([$this->modelClass, 'findOne'], $id);
        if ($model !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function createModel($attributes)
    {
        $model = new $this->modelClass();
        $model->attributes = $attributes;
        if ($model->save()) {
            return $model;
        }
        return null;
    }

    public function updateModel($id, $attributes)
    {
        $model = $this->findModel($id);
        $model->attributes = $attributes;
        if ($model->save()) {
            return $model;
        }
        return null;
    }

    public function deleteModel($id)
    {
        $model = $this->findModel($id);
        if ($model) {
            return $model->delete();
        }
        return false;
    }
}
