<?php

namespace backend\controllers;

use backend\models\Post;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use Yii;

class PostController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Post::find(),
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => [
                    'data_add' => SORT_DESC,
                ],
            ],
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionNew()
    {
        $model = new Post;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
           $model->save();
            return $this->render('_show', ['model'=>$model]);
        } else {
            return $this->render('_form',['model'=>$model]);
        }
    }
}