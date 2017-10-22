<?php
/**
 * Sunset to Sunset plugin for Craft CMS
 *
 * SunsetToSunset Location Controller
 *
 * @author    Cavell L. Blood
 * @copyright Copyright (c) 2017 Cavell L. Blood
 * @link      cavellblood.com
 * @package   SunsetToSunset
 * @since     1
 */

namespace Craft;

class SunsetToSunset_LocationController extends BaseController
{

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     * @access protected
     */
    protected $allowAnonymous = array('actionIndex',
        );

    /**
     */
    public function actionIndex()
    {
        $settings = craft()->plugins->getPlugin('sunsetToSunset')->getSettings();
        $this->renderTemplate('sunsettosunset/location/_index', array(
            'settings' => $settings,
        ));
    }
}