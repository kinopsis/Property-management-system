<?
namespace app\modules\user\controllers;

header('Access-Control-Allow-Origin: *');
 
use app\modules\user\models\User;
use app\modules\user\models\LoginForm;
use app\modules\main\models\ContactForm;
use app\modules\user\models\PasswordChangeForm;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\ContentNegotiator;
use yii\web\Response;
use yii\web\Controller;
use Yii;
 
class UserRestController extends Controller
{   


public function behaviors() {

    

   $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
            'only' => ['dashboard'],
        ];

    $behaviors['contentNegotiator'] = [
        'class' => ContentNegotiator::className(),
        'formats' => [
            'application/json' => Response::FORMAT_JSON,
        ],
    ];

    $behaviors['corsFilter'] = [
         'class' => \yii\filters\Cors::className(),               
    ];


    $behaviors['access'] = [
        'class' => AccessControl::className(),
        'only' => ['dashboard'],
        'rules' => [
            [
                'actions' => ['dashboard'],
                'allow' => true,
                'roles' => ['@'],
            ],
        ],
    ];
    return $behaviors;
}
    public function actionLogin()
    {


        $model = new LoginForm();
        if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && $model->login()) {
            return ['access_token' => Yii::$app->user->identity->getAuthKey()];
        } else {
            $model->validate();
            return $model;
        }
    }

    public function actionDashboard()
    {
        $response = [
            'username' => Yii::$app->user->identity->username,
            'access_token' => Yii::$app->user->identity->getAuthKey(),
        ];
        return $response;
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                $response = [
                    'flash' => [
                        'class' => 'success',
                        'message' => 'Thank you for contacting us. We will respond to you as soon as possible.',
                    ]
                ];
            } else {
                $response = [
                    'flash' => [
                        'class' => 'error',
                        'message' => 'There was an error sending email.',
                    ]
                ];
            }
            return $response;
        } else {
            $model->validate();
            return $model;
        }
    }
}