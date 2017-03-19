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
    public function getThemeConfig(string $name) : array
    {
        $filename = $this->folder."{$name}/theme.json";
        return $this->getConfigFile($filename);
    }
}