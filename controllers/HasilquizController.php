<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Hasil;
use yii\data\Pagination;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;
use yii\web\Response;
use yii\web\UnauthorizedHttpException;

class HasilquizController extends Controller {

	// public function init()
 //    {
 //        $this->layout = 'hasil';
 //    }

	public function beforeAction($action) {
        if (parent::beforeAction($action)) {
            $this->checkLogin();
            return true;
        }

        return false;
    }

	public function actionIndex(){
        $query = Hasil::getHasilquis();
        $countQuery = count($query);
        
        $provider = new ArrayDataProvider([
			    'allModels' => $query,
			    'pagination' => [
			        'pageSize' => 10,
			    ],
			]);
        return $this->render('index', [
                    'dataProvider' => $provider
        ]);
    }

    protected function checkLogin() {
        if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
            $this->authenticate();
        }

        $user = $_SERVER['PHP_AUTH_USER'];
        $pass = $_SERVER['PHP_AUTH_PW'];
        if ($user == 'admines' && $pass == 'esid') {
            return true;
        } else {
            self::authenticate();
        }
    }

    protected function authenticate() {
        header('WWW-Authenticate: Basic realm="Authentication System"');
        $error = "You must enter a valid login ID and password to access this resource\n";
        throw new UnauthorizedHttpException($error);
    }

}