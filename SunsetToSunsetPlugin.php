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
        $urlMatchTemplate = ($request->url === $template);

        $simulateTime = $plugin->getSimulateTime();
        $beforeSabbath = false;
        $duringSabbath = false;
        $afterSabbath = false;

        if ($simulateTime) {
            switch ($simulateTime) {
                case 'before':
                    $beforeSabbath = true;
                    break;
                case 'during':
                    $duringSabbath = true;
                    break;
                case 'after':
                    $afterSabbath = true;
                    break;
            }
        } else {
            $beforeSabbath = date('U') < $plugin->getClosingTime() && date('U') > $plugin->getShowMessageTime();
            $duringSabbath = date('U') >= $plugin->getClosingTime() && date('U') <= $plugin->getOpeningTime() && date('w') >= $plugin->getClosingDayNumber();
            $afterSabbath  = date('U') > $plugin->getOpeningTime() && date('w') >= $plugin->getOpeningDayNumber();
        }


        if ($request->isSiteRequest()) {

            // Before Sabbath
            if ( $beforeSabbath )
            {
                // Render Template
                craft()->templates->hook('sunsetToSunsetRender', function()
                {
                    return craft()->sunsetToSunset->render();
                });
            }

            // During Sabbath and not on Sabbath URL
            if ( $duringSabbath && !$urlMatchTemplate )
            {
                // Convert specific redirect urls to array
                $specificRedirectUrls = preg_split("/\r\n|\n|\r/", $plugin->getSpecificRedirectUrls());

                if (count($specificRedirectUrls)) {
                    foreach ($specificRedirectUrls as $url) {
                        if (preg_match('('. $url . ')i', $request->url)) {
                            $request->redirect($template, true, 302);
                        }
                    }
                } else {
                    $request->redirect($template, true, 302);
                }
            }

            // After Sabbath
            if ( $afterSabbath )
            {
                // If site is open and on message template redirect
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
        return 'https://github.com/cavellblood/sunsettosunset/blob/master/README.md';
    }

    /**
     * @return string
     */
    public function getPluginUrl()
    {
        return 'https://github.com/cavellblood/sunsettosunset';
    }

    /**
     * @return string
     */
    public function getReleaseFeedUrl()
    {
        return 'https://raw.githubusercontent.com/cavellblood/sunsettosunset/master/releases.json';
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return '1.3.0';
    }

    /**
     * @return string
     */
    public function getSchemaVersion()
    {
        return '1.0.0';
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
        return craft()->config->get('showCpSection', 'sunsettosunset') === true;
    }

    /**
     * Hook Register CP Routes
     */
    public function registerCpRoutes()
    {
        return array(
            'sunsettosunset' => ['action' => 'sunsetToSunset/settings'],
            'sunsettosunset/message' => ['action' => 'sunsetToSunset/settings'],
            'sunsettosunset/location' => ['action' => 'sunsetToSunset/settingsLocation'],
            'sunsettosunset/template' => ['action' => 'sunsetToSunset/settingsTemplate'],
            'sunsettosunset/advanced' => ['action' => 'sunsetToSunset/settingsAdvanced'],
        );
    }

    /**
     * @param array|BaseModel $values
     */
    public function setSettings($values)
    {
        if (!$values)
        {
            $values = array();
        }

        if (is_array($values))
        {
            // Merge in any values that are stored in craft/config/sunsettosunset.php
            foreach ($this->getSettings() as $key => $value)
            {
                $configValue = craft()->config->get($key, 'sunsettosunset');

                if ($configValue !== null)
                {
                    $values[$key] = $configValue;
                }
            }
        }

        parent::setSettings($values);
    }

    /**
     * @return array
     */
    protected function defineSettings()
    {
        return array(
            'latitude'                 => array(AttributeType::String, 'label' => 'Latitude', 'required' => true, 'default' => '41.8333925'),
            'longitude'                => array(AttributeType::String, 'label' => 'Longitude', 'required' => true, 'default' => '-88.0121473'),
            'timezone'                 => array(AttributeType::String, 'label' => 'Time Zone', 'default' => 'America/Chicago'),
            'guard'                    => array(AttributeType::Number, 'label' => 'Guard', 'default' => '30'),
            'message'                  => array(AttributeType::Mixed, 'label' => 'Full Message', 'default' => ''),
            'bannerMessage'            => array(AttributeType::String, 'label' => 'Banner Message', 'default' => ''),
            'showMessageTime'          => array(AttributeType::Number, 'label' => 'Show Message Time', 'default' => '180'),
            'templateRedirect'         => array(AttributeType::String, 'label' => 'Template Redirect', 'default' => ''),
            'specificRedirectUrls'     => array(AttributeType::Mixed, 'label' => 'Specific Redirect URLs', 'default' => ''),
            'bannerCssPosition'        => array(AttributeType::String, 'label' => 'Banner CSS Position', 'default' => 'relative'),
            'bannerCssBackgroundColor' => array(AttributeType::String, 'label' => 'Banner CSS Background Color', 'default' => ''),
            'simulateTime'             => array(AttributeType::String, 'label' => 'Simulate Time', 'default' => ''),
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