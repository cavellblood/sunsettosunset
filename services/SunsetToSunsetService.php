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

class SunsetToSunsetService extends BaseApplicationComponent
{
    /**
     * @return float
     */
    public function getLatitude()
    {
        $result = craft()->plugins->getPlugin('sunsetToSunset')->getSettings()->attributes['latitude'];

        return (float)$result;
    }

    /**
     * @return float
     */
    public function getLongitude()
    {
        $result = craft()->plugins->getPlugin('sunsetToSunset')->getSettings()->attributes['longitude'];

        return (float)$result;
    }

    /**
     * @return mixed
     */
    public function getTimeZone()
    {
        $result = craft()->plugins->getPlugin('sunsetToSunset')->getSettings()->attributes['timezone'];

        return $result;
    }

    /**
     * @return int
     */
    public function getGuard()
    {
        $result = craft()->plugins->getPlugin('sunsetToSunset')->getSettings()->attributes['guard'];

        return (int)$result;
    }

    /**
     * @return int
     */
    public function getShowMessageTime()
    {
        $time = craft()->plugins->getPlugin('sunsetToSunset')->getSettings()->attributes['showMessageTime'];

        // Set opening time
        $result = $this->getClosingTime() - ( $time * 60 );

        return (int)$result;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        $result = craft()->plugins->getPlugin('sunsetToSunset')->getSettings()->attributes['message'];

        return $result;
    }

    /**
     * @return mixed
     */
    public function getBannerCssPosition()
    {
        $result = craft()->plugins->getPlugin('sunsetToSunset')->getSettings()->attributes['bannerCssPosition'];

        return $result;
    }

    /**
     * @return mixed
     */
    public function getBannerCssBackgroundColor()
    {
        $result = craft()->plugins->getPlugin('sunsetToSunset')->getSettings()->attributes['bannerCssBackgroundColor'];

        return $result;
    }

    /**
     * @return mixed
     */
    public function getSimulateTime()
    {
        $result = craft()->plugins->getPlugin('sunsetToSunset')->getSettings()->attributes['simulateTime'];

        return $result;
    }

    /**
     * @return mixed
     */
    public function getTemplate()
    {
        $result = craft()->plugins->getPlugin('sunsetToSunset')->getSettings()->attributes['templateRedirect'];

        return $result;
    }

    /**
     * @return int
     */
    public function getClosingDayNumber()
    {   
        // Set day of week: zero-based index
        return 5;
    }

    /**
     * @return int
     */
    public function getOpeningDayNumber()
    {
        // Set day of week: zero-based index
        return 6;
    }

    /**
     * @return float|int
     */
    public function getClosingTime()
    {
        // Set default time zone for date_sun_info to work with
        date_default_timezone_set( $this->getTimeZone() );

        // Get closing date and time information
        $daysToClosing     = $this->getClosingDayNumber() - date('w');
        $closingDay        = strtotime( date( 'Y-m-d' ) . '+ '. $daysToClosing .' days');
        $closingDaySunInfo = date_sun_info( $closingDay, $this->getLatitude(), $this->getLongitude() );

        // Set closing time
        $result = (int)$closingDaySunInfo['sunset'] - ( $this->getGuard() * 60 );

        return $result;
    }

    /**
     * @return float|int
     */
    public function getOpeningTime()
    {
        // Set default time zone for date_sun_info to work with
        date_default_timezone_set( $this->getTimeZone() );

        // Get opening date and time information
        $daysToOpening     = $this->getOpeningDayNumber() - date('w');
        $openingDay        = strtotime( date( 'Y-m-d' ) . '+ '. $daysToOpening .' days');
        $openingDaySunInfo = date_sun_info( $openingDay, $this->getLatitude(), $this->getLongitude() );

        // Set opening time
        $result = (int)$openingDaySunInfo['sunset'] + ( $this->getGuard() * 60 );

        return $result;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function render()
    {
        $plugin = craft()->plugins->getPlugin('sunsettosunset');
        $settings = $plugin->getSettings();

        $oldTemplatesPath = craft()->path->getTemplatesPath();
        $newTemplatesPath = craft()->path->getPluginsPath().'sunsettosunset/templates/';
        craft()->path->setTemplatesPath($newTemplatesPath);

        $vars = array(
            'message' => $settings->attributes['message'],
            'openingTime' => craft()->sunsetToSunset->getOpeningTime(),
            'closingTime' => craft()->sunsetToSunset->getClosingTime()
        );

        $html = craft()->templates->render('frontend/message', $vars);
        craft()->path->setTemplatesPath($oldTemplatesPath);

        return $html;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function renderTime()
    {
        $plugin = craft()->plugins->getPlugin('sunsettosunset');
        $settings = $plugin->getSettings();

        $oldTemplatesPath = craft()->path->getTemplatesPath();
        $newTemplatesPath = craft()->path->getPluginsPath().'sunsettosunset/templates/';
        craft()->path->setTemplatesPath($newTemplatesPath);

        $vars = array(
            'message' => $settings->attributes['message'],
            'openingTime' => craft()->sunsetToSunset->getOpeningTime(),
            'closingTime' => craft()->sunsetToSunset->getClosingTime()
        );

        $html = craft()->templates->render('frontend/time', $vars);
        craft()->path->setTemplatesPath($oldTemplatesPath);

        return $html;
    }

}