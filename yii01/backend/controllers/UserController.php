<?php

namespace backend\controllers;

use app\components\ApiCaller;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class UserController extends Controller
{
    public function actionCreate()
    {
        $data = [
            'name' => 'exampleUser',
            'email' => 'examplePass@gmail.com',
            'password' => 'examplePass'
        ];
        $headers = [
            'Content-Type: application/x-www-form-urlencoded',
            'authorization: 1|8s1N2AHcYaTeGYojjzoqeAbtkg8z7VL1HPl2iGtHd7f22928'
        ];
        try {
            $response = ApiCaller::call('POST', 'http://localhost:8072/api/users', $data, $headers);
            echo $response;
        } catch (\Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
//        return $this->render('create', ['model' => $model]);
    }


    public function actionIndex()
    {
        $tenants = Tenant::find()->all();
        return $this->render('index', ['tenants' => $tenants]);
    }

    public function actionCreate۱()
    {
        $model = new Tenant();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->uuid]);
        }
        return $this->render('create', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->uuid]);
        }
        return $this->render('update', ['model' => $model]);
    }

    public function actionView($id)
    {
        return $this->render('view', ['model' => $this->findModel($id)]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Tenant::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
