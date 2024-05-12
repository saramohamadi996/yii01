<?php

namespace backend\controllers;

use Yii;
use app\models\Tenant;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class TenantController extends Controller
{
    public function actionIndex()
    {
        $tenants = Tenant::find()->all();
        return $this->render('index', ['tenants' => $tenants]);
    }

    public function actionCreate()
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
