<?php

namespace app\controllers\geo;

use app\models\City;
use Yii;
use yii\web\Controller;
use yii\web\Response;

/**
 * CityController implements the CRUD actions for City model.
 */
class CityController extends Controller
{
    public function actionList($regionId)
    {
        Yii::$app->response->format = Response::FORMAT_XML;
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
        }
        return City::find()
            ->select(['cityId', 'title'])
            ->where(['regionId' => $regionId])
            ->orderBy(['title' => SORT_ASC])
            ->asArray()
            ->all();
    }
}
