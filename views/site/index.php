<?php
/* @var $this yii\web\View */

$this->title = 'My test project';
?>
<?php if (!empty($articles)): ?>
    <?php foreach ($articles as $article): ?>
        <?php
            $url_full_article = yii\helpers\Url::to(['view', 'id' => $article['id']]);
            $url_author_list = yii\helpers\Url::to(['author-list', 'id' => $article['author']->id]);
        ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><a href="<?=$url_full_article?>"><b><?=$article['title']?></b></a></h3>
            </div>
            <div class="panel-body">
                <?= $article['content']?>
            </div>
            <div class="panel-footer">by <a href="<?=$url_author_list?>"><?=$article['author']->first_name . ' ' . $article['author']->second_name?></a></div>
        </div>
    <?php endforeach; ?>
    <?= \yii\widgets\LinkPager::widget(['pagination' => $pages]) ?>
<?php else:?>
    <div class="panel panel-warning">
        <div class="panel-heading">
            <h3 class="panel-title"><b>There are no articles</b></h3>
        </div>
        <div class="panel-body text-muted">
            <?php if (Yii::$app->user->isGuest):?>
                <a href="<?= yii\helpers\Url::to(['signup']) ?>" class="btn btn-success">Sign Up</a>
                 Join our community and write yours.
            <?php else:?>
                <a href="#" class="btn btn-success">New article</a>
                 Write article right now.
            <?php endif;?>
        </div>
    </div>
<?php endif; ?>