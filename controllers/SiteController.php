<?php

namespace app\controllers;

use app\models\Article;
use app\models\ArticleTag;
use app\models\Category;
use app\models\Tag;
use Yii;
use yii\base\BaseObject;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    public $layout = 'main';
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
        $data = Article::getAll();

        $popularArticles = Article::getPopularArticles();
        $recentArticles = Article::getRecentArticles();
        $categories = Category::find()->all();

        return $this->render('index', [
            'articles' => $data['articles'],
            'pagination' => $data['pagination'],
            'popularArticles' => $popularArticles,
            'recentArticles' => $recentArticles,
            'categories' => $categories
        ]);
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
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * One post reading.
     *
     * @return string
     */
    public function actionSingle($id)
    {
        $article = Article::findOne($id);
        $tags = Tag::find()->where(['id' => $article->articleTags->tag_id])->all();
        $popularArticles = Article::getPopularArticles();
        $recentArticles = Article::getRecentArticles();
        $categories = Category::find()->all();

        return $this->render('single', [
            'article' => $article,
            'tags' => $tags,
            'popularArticles' => $popularArticles,
            'recentArticles' => $recentArticles,
            'categories' => $categories
        ]);
    }

    /**
     * Displays category page.
     *
     * @return string
     */
    public function actionCategory($id)
    {
        $data = Category::getArticlesByCategory($id);
        $popularArticles = Article::getPopularArticles();
        $recentArticles = Article::getRecentArticles();
        $categories = Category::find()->all();
        return $this->render('category', [
            'articles' => $data['articles'],
            'pagination' => $data['pagination'],
            'popularArticles' => $popularArticles,
            'recentArticles' => $recentArticles,
            'categories' => $categories
        ]);
    }
}
