<?php

namespace app\controllers;

use app\models\Article;
use app\models\NewArticleForm;
use app\models\Profile;
use app\models\ProfileForm;
use app\models\SignupForm;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $query = Article::find()->select('id, title, content, user_id')->orderBy('id DESC');
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 10]);
        $articles = $query->offset($pages->offset)->limit($pages->limit)->asArray()->all();

        foreach ($articles as &$article)
        {
            // Get author
            $article['author'] = Profile::findOne($article['user_id']);

            // Limit text
            if (strlen($article['content']) > 500)
            {
                // truncate string
                $stringCut = substr($article['content'], 0, 500);
                $endPoint = strrpos($stringCut, ' ');

                //if the string doesn't contain any space then it will cut without word basis.
                $article['content'] = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                $article['content'] .= '... ';
            }
        }
        return $this->render('index', compact('articles', 'pages'));
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Signup action.
     */
    public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionProfile()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $id = Yii::$app->user->id;
        $profile = Profile::findOne($id);
        $model = new ProfileForm();
        $model->first_name = $profile->first_name;
        $model->second_name = $profile->second_name;
        $model->photo = $profile->photo;
        if ($model->load(Yii::$app->request->post()) && $model->profile($profile)) {
            return $this->goBack();
        }

        return $this->render('profile', compact('model'));
    }

    public function actionView()
    {
        $id = Yii::$app->request->get('id');
        $article = Article::findOne($id);
        if (empty($article)) throw new \yii\web\HttpException(404, 'Article not found...');
        $author = Profile::findOne($article->user_id);
        return $this->render('view', compact('article', 'author'));
    }

    public function actionAuthorList()
    {
        $id = Yii::$app->request->get('id');
        $query = Article::find()->where(['user_id' => $id])->select('id, title, content, user_id')->orderBy('id DESC');
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 10]);
        $articles = $query->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        cutArticlesContent($articles);

        return $this->render('author-list', compact('articles', 'pages'));
    }

    public function actionNewArticle()
    {
        $model = new NewArticleForm();
        return $this->render('new-article', compact('model'));
    }
}

function cutArticlesContent(&$articles)
{
    foreach ($articles as &$article)
    {
        if (strlen($article['content']) > 500)
        {
            // truncate string
            $stringCut = substr($article['content'], 0, 500);
            $endPoint = strrpos($stringCut, ' ');

            //if the string doesn't contain any space then it will cut without word basis.
            $article['content'] = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
            $article['content'] .= '... ';
        }
    }
}
