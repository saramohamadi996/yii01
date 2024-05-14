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
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $name = $request->post('name');
        $model = [
            'name' => $name,
        ];
        $currentData = $this->getDataFromApi($id);
        if ($currentData === false) {
            Yii::$app->session->setFlash('error', 'Failed to fetch current data from the API.');
            return $this->redirect(['index', 'dev_id' => $id]);
        }
        $updatedData = array_merge($currentData, $model);
        try {
            $jsonData = json_encode($updatedData);
            Yii::error("JSON being sent: " . $jsonData);
            $response = ApiCaller::call('PUT', 'https://172.16.14.190:4000/api/confd/1.0/tenants', $jsonData, [
                'Content-Type: application/json; charset=UTF-8',
                'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJhZG1pbiIsImV4cCI6MTcxNTY5MjYzNn0.HwgGDet7BYGBNf2hHyLAToRFLibv9wWYbTRxdeWGNvc',
                'Accept: */*'
            ]);
            $result = json_decode($response, true);
            if ($result) {
                Yii::$app->session->setFlash('success', 'Updated successfully.');
                return $this->redirect(['index', 'dev_id' => $dev_id]);
            } else {
                Yii::$app->session->setFlash('error', 'Failed to update the device.');
            }
        } catch (\Exception $e) {
            Yii::error("Failed to call API: " . $e->getMessage(), METHOD);
            Yii::$app->session->setFlash('error', 'API call failed: ' . $e->getMessage());
        }
        return $this->render('_form.php', [
            'model' => $model,
        ]);
    }

    private function getDataFromApi($id)
    {
        try {
            var_dump( ApiCaller::call('GET', 'http://localhost:8072/api/users/' . $id));die();
            $response = ApiCaller::call('GET', 'http://localhost:8072/api/users/' . $id);
            return json_decode($response, true);
        } catch (\Exception $e) {
            Yii::error("Failed to fetch data from API: " . $e->getMessage());
            return false;
        }
    }


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

    public function actioUpdate($id)
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
