<?php
/**
 * Erdiko Theme Config
 *
 * Read theme config
 *
 * @package     erdiko\theme
 * @copyright   2012-2017 Arroyo Labs, Inc. http://www.arroyolabs.com
 * @author      John Arroyo <john@arroyolabs.com>
 */
namespace erdiko\theme;


class Config extends \erdiko\Config
{
    /**
     * Get configuration
     *
     * @param string $name
     * @param string $context
     * @return array $config
     */
    public static function get(string $name = 'application', string $context = null): array
    {
        $config = parent::get($name, $context);

        if (isset($config['theme']['namespace'])) {
            $themeConfig = \erdiko\theme\Config::getTheme($config['theme']['namespace']);
        } else {
            throw new \Exception("No theme specified, cannot load config");
        }

        return [$name => $config, 'theme' => $themeConfig];
    }

    /**
     * Get configuration
     *
     * @param string $name
     * @param string $context
     * @return array $config
     */
    public static function getTheme(string $name) : array
    {
        $folder = ERDIKO_ROOT;
        $filename = $folder."/{$name}/theme.json";
        return static::getConfigFile($filename);
    }
}