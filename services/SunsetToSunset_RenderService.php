<?php
/**
 * Sunset to Sunset plugin for Craft CMS
 *
 * SunsetToSunset Service
 *
 * @author    Cavell L. Blood
 * @copyright Copyright (c) 2017 Cavell L. Blood
 * @link      https://cavellblood.com
 * @package   SunsetToSunset
 * @since     1
 */

namespace Craft;

class SunsetToSunset_RenderService extends BaseApplicationComponent
{
    public function render($params)
    {
        $plugin = craft()->plugins->getPlugin('sunsettosunset');
        $settings = $plugin->getSettings();

        $oldTemplatesPath = craft()->path->getTemplatesPath();
        $newTemplatesPath = craft()->path->getPluginsPath().'sunsettosunset/templates/';
        craft()->path->setTemplatesPath($newTemplatesPath);

        $vars = array(
            'bannerMessage' => $settings->attributes['bannerMessage'],
            'closingTime' => $plugin->getClosingTime()
        );

        $html = craft()->templates->render('frontend/message', $vars);
        craft()->path->setTemplatesPath($oldTemplatesPath);

        echo $html;
    }
}