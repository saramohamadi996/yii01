<?php

namespace backend\controllers;

use app\components\ApiCaller;
use backend\components\BaseRepository;
use backend\models\Product;
use backend\models\ProductSearch;
use yii\web\Controller;
use Yii;
use yii\web\NotFoundHttpException;


class ProductController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', ['model' => $model]);
    }

//    public function actionCreate()
//    {
//        $model = new Product();
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        }
//        return $this->render('create', ['model' => $model]);
//    }


    public function actionCreate()
    {
        $model = [
            'name' => 'exampleUser',
            'email' => 'examplePass@gmail.com',
            'password' => 'examplePass'
        ];
        $headers = [
            'Content-Type: application/x-www-form-urlencoded',
            'Authorization: Bearer 1|8s1N2AHcYaTeGYojjzoqeAbtkg8z7VL1HPl2iGtHd7f22928'
        ];
        $curl = curl_init('http://localhost:8072/api/users');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($model));
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($curl);
        if ($error = curl_error($curl)) {
            curl_close($curl);
            return $this->render('create', ['model' => $model, 'error' => $error]);
        }
        curl_close($curl);
        return $this->render('create', ['model' => $model, 'response' => $response]);
    }


//    public function actionCreate()
//    {
//        $model = [
//            'name' => 'exampleUser',
//            'email' => 'examplePass@gmail.com',
//            'password' => 'examplePass'
//        ];
//        $headers = [
//            'Content-Type: application/x-www-form-urlencoded',
//            'authorization: 1|8s1N2AHcYaTeGYojjzoqeAbtkg8z7VL1HPl2iGtHd7f22928'
//        ];
//        try {
//            $response = ApiCaller::call('POST', 'http://localhost:8072/api/users', $model, $headers);
//            echo $response;
//        } catch (\Exception $e) {
//            echo 'Error: ' . $e->getMessage();
//        }
//        return $this->render('create', ['model' => $model]);
//    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', ['model' => $model]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    public function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}


//class ProductController extends Controller
//{
//    public function actionCreate()
//    {
//        $data = [
//            'name' => 'exampleUser',
//            'email' => 'examplePass@gmail.com',
//            'password' => 'examplePass'
//        ];
//        var_dump($data);die();
//        $headers = [
//            'Content-Type: application/x-www-form-urlencoded',
//            'authorization: 1|8s1N2AHcYaTeGYojjzoqeAbtkg8z7VL1HPl2iGtHd7f22928'
//        ];
//        try {
//            $response = ApiCaller::call('POST', 'http://localhost:8072/api/users', $data, $headers);
//            echo $response;
//        } catch (\Exception $e) {
//            echo 'Error: ' . $e->getMessage();
//        }
////        return $this->render('create', ['model' => $model]);
//    }
//
//}
