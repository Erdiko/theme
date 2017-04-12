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
            $themeConfig = static::getTheme($config['theme']['namespace']);
        } else {
            throw new \Exception("No theme specified, cannot load config");
        }
        
        return [$name => $config, 'theme' => static::mergeDefaults($themeConfig, $config)];
    }

    public function mergeDefaults($themeConfig, $config)
    {
        if(!empty($config['theme']['defaults']))
            $themeConfig = array_replace_recursive($themeConfig, $config['theme']['defaults']);

        return $themeConfig;
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