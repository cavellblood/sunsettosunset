<?php
/**
 * Sunset to Sunset plugin for Craft CMS
 *
 * SunsetToSunset Message Controller
 *
 * @author    Cavell L. Blood
 * @copyright Copyright (c) 2017 Cavell L. Blood
 * @link      cavellblood.com
 * @package   SunsetToSunset
 * @since     1
 */

namespace Craft;

class SunsetToSunsetController extends BaseController
{

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     * @access protected
     */
    protected $allowAnonymous = array('actionIndex',
        );

    /**
     */
    public function actionSettings()
    {
        $settings = craft()->plugins->getPlugin('sunsetToSunset')->getSettings();
        $this->renderTemplate('sunsettosunset/settings/message', array(
            'settings' => $settings,
        ));
    }

    /**
     */
    public function actionSettingsLocation()
    {
        $settings = craft()->plugins->getPlugin('sunsetToSunset')->getSettings();
        $this->renderTemplate('sunsettosunset/settings/location', array(
            'settings' => $settings,
        ));
    }

    /**
     */
    public function actionSettingsTemplate()
    {
        $settings = craft()->plugins->getPlugin('sunsetToSunset')->getSettings();
        $this->renderTemplate('sunsettosunset/settings/template', array(
            'settings' => $settings,
        ));
    }

    /**
     */
    public function actionSettingsAdvanced()
    {
        $settings = craft()->plugins->getPlugin('sunsetToSunset')->getSettings();
        $this->renderTemplate('sunsettosunset/settings/advanced', array(
            'settings' => $settings,
        ));
    }
}