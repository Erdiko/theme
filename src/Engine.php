<?php
/**
 * Erdiko Theme Engine
 *
 * Prep data for easy and efficient theme rendering
 *
 * @package     erdiko\theme
 * @copyright   2012-2017 Arroyo Labs, Inc. http://www.arroyolabs.com
 * @author      John Arroyo <john@arroyolabs.com>
 */
namespace erdiko\theme;

class Engine
{
    protected $themeData = array();

    public function __construct($controller)
    {
        // Or we could read (require) the theme.php file directly
        $this->themeData['theme'] = \erdiko\theme\Config::get($controller->getThemeSettings());

        $this->themeData['page'] = [];
    }

    public function __set(string $name, $value)
    {
        $this->themeData['page'][$name] = $value;
    }

    public function __get(string $name)
    {
        if(isset($this->themeData['page'][$name]))
            return $this->themeData['page'][$name];
        else
            return null;
    }

    public function __isset(string $name)
    {
        return isset($this->themeData[$name]);
    }

    /**
     * Get theme data
     *
     * @return array $themeData
     */
    public function getData()
    {
        return $this->themeData;
    }

    /**
     * Get theme data as an array
     * @todo determine best way to deal with array
     *
     * @return array $themeData
     */
    public function toArray(): array
    {
        return $this->getData();
    }

    /**
     * Set theme config data
     *
     * @param string $themeData
     */
    public function setThemeField(string $name, $value)
    {
        $this->themeData['theme'][$name] = $value;
    }

    public function getThemeField(string $name)
    {
        if(isset($this->themeData['theme'][$name]))
            return $this->themeData['theme'][$name];
        else
            return null;
    }

    public function setApplicationField(string $name, $value)
    {
        $this->themeData['application'][$name] = $value;
    }

    public function getApplicationField(string $name)
    {
        if(isset($this->themeData['application'][$name]))
            return $this->themeData['application'][$name];
        else
            return null;
    }

    /**
     * Add additional meta fields
     * @param array $meta
     */
    public function addMeta(array $meta)
    {
        if(isset($this->themeData['application']['meta'])) {
            $this->themeData['application']['meta'] =
                array_replace($this->themeData['application']['meta'], $meta);
        } else {
            $this->themeData['application']['meta'] = $meta;
        }
    }

    public function getDefaultView()
    {
        if(isset($this->themeData['theme']['view']))
            $view = $this->themeData['theme']['view'];
        else
            $view = "default.html";

        return $view;
    }
}
