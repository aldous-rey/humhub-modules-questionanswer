<?php

namespace humhub\modules\questionanswer\widgets;

use humhub\modules\reportcontent\models\ReportReasonForm;
use Yii;

/**
 * Taps into ReportContent module
 *
 * ReportContentWidget for reporting a post
 * This widget allows to report a post.
 * @package humhub.modules.reportcontent.widgets
 */

class QAReportContentWidget extends \yii\base\Widget
{

    /**
     * Content Object with SIContentBehaviour
     *
     * @var type
     */
    public $content;

    /**
     * Executes the widget.
     */
    public function run()
    {
        if ($this->content->canReportPost()) {
            return $this->render('reportSpamLink', array(
                'object' => $this->content,
                'model' => new ReportReasonForm()
            ));
        }
    }
}
?>