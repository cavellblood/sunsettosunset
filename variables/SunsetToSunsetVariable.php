<?php
/**
 * Sunset to Sunset plugin for Craft CMS
 *
 * Sunset to Sunset Variable
 *
 * @author    Cavell L. Blood
 * @copyright Copyright (c) 2017 Cavell L. Blood
 * @link      https://cavellblood.com
 * @package   SunsetToSunset
 * @since     1
 */

namespace Craft;

class SunsetToSunsetVariable
{

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return craft()->sunsetToSunset->getMessage();
    }

    /**
     * @return mixed
     */
    public function getBannerMessage()
    {
        return craft()->sunsetToSunset->getBannerMessage();
    }

    /**
     * @return mixed
     */
    public function getClosingTime()
    {
        return craft()->sunsetToSunset->getClosingTime();
    }

    /**
     * @return mixed
     */
    public function getOpeningTime()
    {
        return craft()->sunsetToSunset->getOpeningTime();
    }

    /**
     * @return mixed
     */
    public function getBannerCssPosition()
    {
        return craft()->sunsetToSunset->getBannerCssPosition();
    }

    /**
     * @return mixed
     */
    public function getBannerCssBackgroundColor()
    {
        return craft()->sunsetToSunset->getBannerCssBackgroundColor();
    }

    /**
     * @return mixed
     */
    public function getSimulateTime()
    {
        return craft()->sunsetToSunset->getSimulateTime();
    }

    /**
     * @return mixed
     */
    public function getTemplate()
    {
        return craft()->sunsetToSunset->getTemplate();
    }

    /**
     * @return string
     */
    public function getPluginName()
    {
        return craft()->plugins->getPlugin('sunsettosunset')->getName();
    }
}