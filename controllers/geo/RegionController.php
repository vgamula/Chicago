<?php

namespace app\controllers\geo;

use app\models\Region;
use Yii;
use yii\web\Controller;
use yii\web\Response;

/**
 * RegionController implements the CRUD actions for Region model.
 */
class RegionController extends Controller
{
    public function actionList($countryId)
    {
        Yii::$app->response->format = Response::FORMAT_XML;
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
        }
        return Region::find()
            ->select(['regionId', 'title'])
            ->where(['countryId' => $countryId])
            ->orderBy(['title' => SORT_ASC])
            ->asArray()
            ->all();
    }
}
