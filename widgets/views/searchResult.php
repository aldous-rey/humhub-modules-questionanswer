<?php
/**
 * This View shows a post inside the search
 *
 * @property Post $post is the post object
 *
 * @package humhub.modules.post
 * @since 0.5
 */

use yii\helpers\Html;
use humhub\libs\Helpers;
use yii\helpers\Url;

?>

<li>
    <?php
        $foundId = ($question->question_id) ? $question->question_id : $question->id;
    ?>
    <a href="<?php echo Url::toRoute(array('/questionanswer/question/view', 'id' => $foundId)); ?>">
        <div class="media">
            <div class="media-body">
                <strong><?php echo Html::encode($question->post_title); ?> </strong><br>
                <span class="content"><?php echo Html::encode(Helpers::truncateText($question->post_text, 150)); ?></span>
                <br />
                <?php foreach($question->tags as $tag) { ?>
                    <span class="label label-default"><?php echo Html::encode($tag->tag->tag); ?></span>
                <?php } ?>
            </div>
        </div>
    </a>
</li>