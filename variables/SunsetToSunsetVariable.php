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
     */
    public function getMessage()
    {
        return craft()->sunsetToSunset->getMessage();
    }

    public function getClosingTime()
    {
        return craft()->sunsetToSunset->getClosingTime();
    }

    public function getOpeningTime()
    {
        return craft()->sunsetToSunset->getOpeningTime();
    }

    public function getBannerCssPosition()
    {
        return craft()->sunsetToSunset->getBannerCssPosition();
    }

    public function getBannerCssBackgroundColor()
    {
        return craft()->sunsetToSunset->getBannerCssBackgroundColor();
    }

    public function getSimulateTime()
    {
        return craft()->sunsetToSunset->getSimulateTime();
    }

    public function getTemplate()
    {
        return craft()->sunsetToSunset->getTemplate();
    }

    public function getPluginName()
    {
        return craft()->plugins->getPlugin('sunsettosunset')->getName();
    }
}