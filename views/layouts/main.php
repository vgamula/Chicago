<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= $this->title ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $items = [
        ['label' => Yii::t('app', 'Home'), 'url' => ['/site/index']],
    ];

    if (Yii::$app->user->isGuest) {
        $items[] = ['label' => Yii::t('app', 'Registration'), 'url' => ['/site/registration']];
        $items[] = ['label' => Yii::t('app', 'Login'), 'url' => ['/site/login']];
    } else {
        if (Yii::$app->user->identity->role == \app\models\User::ROLE_ADMIN) {
            $items[] = ['label' => Yii::t('app', 'Projects'), 'url' => ['/projects/index']];
            $items[] = ['label' => Yii::t('app', 'Users'), 'url' => ['/users/index']];
            $items[] = ['label' => Yii::t('app', 'Topics'), 'url' => ['/topics/index']];
        }

        $items[] = ['label' => Yii::t('app', 'Settings'), 'items' => [
            [
                'label' => Yii::t('app', 'Change Password'),
                'url' => ['/settings/password'],
            ],
            [
                'label' => Yii::t('app', 'Change E-mail'),
                'url' => ['/settings/email'],
            ],
        ]];

        $items[] = ['label' => Yii::t('app', 'Logout ({email})', ['email' => Yii::$app->user->identity->fullName]),
            'url' => ['/site/logout'],
            'linkOptions' => ['data-method' => 'post']];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $items,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?php
        foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
            echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
        }
        ?>
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; undefined Developers | <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
