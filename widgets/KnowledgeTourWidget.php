<?php

/**
Connected Communities Initiative
Copyright (C) 2016 Queensland University of Technology
This program is free software: you can redistribute it and/or modify
it under the terms of the GNU Affero General Public License as
published by the Free Software Foundation, either version 3 of the
License, or (at your option) any later version.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU Affero General Public License for more details.
You should have received a copy of the GNU Affero General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Will show the introduction tour
 *
 * @package humhub.modules_core.tour.widgets
 * @since 0.5
 * @author andystrobel
 */
class KnowledgeTourWidget extends HWidget
{

    /**
     * Executes the widgets
     */
    public function run()
    {
        if (Yii::app()->user->isGuest)
            return;
        // Active tour flag not set
        if (!isset($_GET['tour'])) {
            return;
        }

        // Tour only possible when we are in a module
        if (Yii::app()->controller->module === null) {
            return;
        }

        // Check if tour is activated by admin and users
        if (HSetting::Get('enable', 'tour') == 0 || Yii::app()->user->getModel()->getSetting("hideTourPanel", "tour") == 1) {
            return;
        }

        $this->loadResources();

        // save current module and controller id's
        $currentModuleId = Yii::app()->controller->module->id;
        $currentControllerId = Yii::app()->controller->id;
        if ($currentModuleId == "questionanswer") {
            $this->render('/tour/guide_interface');
        } elseif ($currentModuleId == "space" && $currentControllerId == "space") {
            $this->render('tour/guide_spaces', array());
        } elseif ($currentModuleId == "user" && $currentControllerId == "profile") {
            $this->render('/tour/guide_profile', array());
        } elseif ($currentModuleId == "admin" && $currentControllerId == "module") {
            $this->render('/tour/guide_administration', array());
        } elseif ($currentModuleId == "chat" && $currentControllerId == "chat") {
            $this->render('/tour/guide_chat', array());
        }
    }

    /**
     * load needed resources files
     */
    public function loadResources()
    {
        $assetPrefix = Yii::app()->assetManager->publish(dirname(__FILE__) . '/resources', true, 0, defined('YII_DEBUG'));
        Yii::app()->clientScript->registerScriptFile($assetPrefix . '/bootstrap-tour.min.js');
        Yii::app()->clientScript->registerCssFile($assetPrefix . '/bootstrap-tour.min.css');
    }

}

?>
