<?php
/**
 * Created by PhpStorm.
 * User: AleksM
 * Date: 15.12.2018
 * Time: 19:37
 */

$this->title = 'Author articles';
?>
<?php if (!empty($articles)): ?>
    <?php foreach ($articles as $article): ?>
        <?php $url_full_article = yii\helpers\Url::to(['view', 'id' => $article['id']]); ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><a href="<?=$url_full_article?>"><b><?=$article['title']?></b></a></h3>
            </div>
            <div class="panel-body">
                <?= $article['content']?>
            </div>
        </div>
    <?php endforeach; ?>
    <?= \yii\widgets\LinkPager::widget(['pagination' => $pages]) ?>
<?php endif; ?>