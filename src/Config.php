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


class Config
{
    /**
     * Get configuration
     *
     * @param array $settings from for theme
     */
    public static function get(array $settings): array
    {
        if (isset($settings['namespace'])) {
            $themeConfig = static::getTheme($settings['namespace']);
        } else {
            throw new \Exception("No theme specified, cannot load theme setting");
        }

        // Merge theme settings into theme config
        $themeConfig = array_replace_recursive($themeConfig, $settings);

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
        $filename = getenv("ERDIKO_ROOT")."/{$name}/theme.json";
        return static::getConfigFile($filename);
    }

    /**
     * Read JSON config file and return array
     *
     * @param string $file
     * @return array $config
     */
    public static function getConfigFile($file): array
    {
        $file = addslashes($file);
        if (is_file($file)) {
            $data = str_replace("\\", "\\\\", file_get_contents($file));
            $json = json_decode($data, true);

            if (empty($json)) {
                throw new \Exception("Config file has a json parse error, $file");
            }

        } else {
            throw new \Exception("Config file not found, $file");
        }

        return $json;
    }
}
