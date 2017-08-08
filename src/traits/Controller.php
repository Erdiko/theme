<?php
/**
 * Controller traits
 * Add this to any controller that uses the theme engine.
 * Will work with Erdiko and Slim, have not tested in other frameworks.
 *
 * @package     erdiko/theme/traits
 * @copyright   2012-2017 Arroyo Labs, Inc. http://www.arroyolabs.com
 * @author      John Arroyo <john@arroyolabs.com>
 */
namespace erdiko\theme\traits;

trait Controller
{
    protected $theme = null;

    /**
     * Get theme
     * Get the theme Engine object, instantiate object if null
     */
    protected function getThemeEngine()
    {
        if($this->theme === null)
            $this->theme = new \erdiko\theme\Engine( $this->container->get('settings')['theme'] );

        return $this->theme;
    }

    /**
     * Render
     * Render page based off of the application and theme configs
     * @todo use DI container to grab the theme Engine
     */
    protected function render($response, string $view = null, \erdiko\theme\Engine $theme = null)
    {
        if(empty($theme))
            $theme = $this->getThemeEngine();

        if(empty($view)) {
            $view = $theme->getDefaultView();
        }

        // Debug
        $this->container->logger->debug("view: {$view}");

        return $this->container->theme->render($response, $view, $theme->toArray());
    }
}
