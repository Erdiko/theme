<?php
/**
 * Controller traits
 * Add this to any controller that uses the theme engine
 *
 * @package     erdiko/theme/traits
 * @copyright   2012-2017 Arroyo Labs, Inc. http://www.arroyolabs.com
 * @author      John Arroyo <john@arroyolabs.com>
 */
namespace erdiko\theme\traits;

trait Controller
{
    /**
     * Render 
     * Render page based off of the application and theme configs
     * At todo move to a trait, \erdiko\theme\traits\Controller
     */ 
    public function render($response, $view = null, \erdiko\theme\Engine $themeEngine = null) 
    {
        if(empty($themeEngine))
            $themeEngine = new \erdiko\theme\Engine;

        if(empty($view)) {
            $view = $themeEngine->getDefaultView();
        }
        // $this->container->logger->debug("view: {$view}");

        return $this->container->theme->render($response, $view, $themeEngine->toArray());
    }    
}