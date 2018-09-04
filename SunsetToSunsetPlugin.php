<?php
/**
 * Sunset to Sunset plugin for Craft CMS
 *
 * Keep the hours of the Sabbath holy.
 *
 * @author    Cavell L. Blood
 * @copyright Copyright (c) 2017 Cavell L. Blood
 * @link      https://cavellblood.com
 * @package   SunsetToSunset
 * @since     1
 */

namespace Craft;

class SunsetToSunsetPlugin extends BasePlugin
{
    /**
     * @return mixed
     */
    public function init()
    {
        // Get sunset details
        $plugin = craft()->sunsetToSunset;
        $request = craft()->request;

        $template = $plugin->getTemplate();
        $requestUrl = $request->url;
        $urlMatchTemplate = ($requestUrl === $template);

        $beforeSabbath = date('U') < $plugin->getClosingTime() && date('U') > $plugin->getShowMessageTime();
        $duringSabbath = date('U') >= $plugin->getClosingTime() && date('U') <= $plugin->getOpeningTime() && date('w') >= $plugin->getClosingDayNumber();
        $afterSabbath  = date('U') > $plugin->getOpeningTime() && date('w') >= $plugin->getOpeningDayNumber();

        if ($request->isSiteRequest()) {

            // Before Sabbath
            if ( $beforeSabbath )
            {
                // Render Template
                craft()->templates->hook('sunsetToSunsetRender', function()
                {
                    $template = craft()->sunsetToSunset->render();

                    return $template;
                });
            }

            // During Sabbath and not on Sabbath URL
            if ( $duringSabbath && !$urlMatchTemplate ) 
            {
                $request->redirect($template, true, 302);
            }

            // After Sabbath
            if ( $afterSabbath ) 
            {
                // If site is open redirect and on message template
                if ( $request->isSiteRequest() && $urlMatchTemplate ) {
                    $request->redirect('/', true, 302);
                }
            }
        }
    }

    /**
     * @return mixed
     */
    public function getName()
    {
         return Craft::t('Sunset to Sunset');
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return Craft::t('Keep the hours of the Sabbath holy.');
    }

    /**
     * @return string
     */
    public function getDocumentationUrl()
    {
        return 'https://github.com/cavellblood/craft-sunsettosunset/blob/master/README.md';
    }

    /**
     * @return string
     */
    public function getReleaseFeedUrl()
    {
        return 'https://raw.githubusercontent.com/cavellblood/craft-sunsettosunset/master/releases.json';
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return '1.0.0';
    }

    /**
     * @return string
     */
    public function getSchemaVersion()
    {
        return '1';
    }

    /**
     * @return string
     */
    public function getDeveloper()
    {
        return 'Cavell L. Blood';
    }

    /**
     * @return string
     */
    public function getDeveloperUrl()
    {
        return 'https://cavellblood.com';
    }

    /**
     * @return bool
     */
    public function hasCpSection()
    {
        if(craft()->config->get('showCpSection', 'sunsettosunset') === true)
        {
            return true;
        }

        return false;
    }

    /**
     * Hook Register CP Routes
     */
    public function registerCpRoutes()
    {
        return array(
            'sunsettosunset' => ['action' => "sunsetToSunset/message/index"],
            'sunsettosunset/location' => ['action' => "sunsetToSunset/location/index"],
        );
    }

    /**
     * @return array
     */
    protected function defineSettings()
    {
        return array(
            'latitude' => array(AttributeType::String, 'label' => 'Latitude', 'default' => ''),
            'longitude' => array(AttributeType::String, 'label' => 'Longitude', 'default' => ''),
            'timezone' => array(AttributeType::String, 'label' => 'Time Zone', 'default' => ''),
            'gaurd' => array(AttributeType::Number, 'label' => 'Guard', 'default' => '30'),
            'message' => array(AttributeType::Mixed, 'label' => 'Message', 'default' => ''),
            'showMessageTime' => array(AttributeType::Number, 'label' => 'Show Message Time', 'default' => '180'),
            'templateRedirect' => array(AttributeType::String, 'label' => 'Template Redirect', 'default' => ''),
        );
    }

    /**
     * @return mixed
     */
    public function getSettingsHtml()
    {
       return craft()->templates->render('sunsettosunset', array(
           'settings' => $this->getSettings()
       ));
    }

    /**
     * Get Settings URL
     */
    public function getSettingsUrl()
    {
        return 'sunsettosunset';
    }

}