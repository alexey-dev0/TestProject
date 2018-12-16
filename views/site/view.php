<?php
/**
 * Created by PhpStorm.
 * User: AleksM
 * Date: 15.12.2018
 * Time: 18:36
 */

$this->title = $article->title;
$url_author_list = yii\helpers\Url::to(['author-list', 'id' => $author->id]);
?>

<div class="page-header">
    <h2><?=$article->title?> <small>by <a href="<?=$url_author_list?>"><?=$author->first_name . ' ' . $author->second_name?></a></small></h2>
</div>
<div class="panel-body">
    <?=$article->content?>
</div>