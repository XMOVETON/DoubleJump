<?php

namespace felony13twelve\doublejump;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

/**
 * Class DoubleJump
 * @package felony13twelve\doublejump
 *
 * @author  <felony13twelve@gmail.com> <Tg:@felony13twelve>
 * @version 1.0.0
 */
class DoubleJump extends PluginBase {

    /** @var Config $config */
    private $config = null;

    /** @var DoubleJump */
    private static $instance;

    public function onLoad () {
        self::$instance = & $this;
    }

    public function onEnable () {
        $f = $this->getDataFolder();
        if (!(is_dir($f))) 
            @mkdir($f);
        
        $this->saveResource('config.yml');
        if (!(isset($this->config))) {
            $this->config = (new Config($f . 'config.yml', Config::YAML))->getAll();
        }

        $this->getServer()->getPluginManager()->registerEvents(new EventHandler(), $this);
    }

    /**
     * @return int
     */
    public function getJump () {
        return $this->config['jump'];
    }

    /**
     * @return DoubleJump
     */
    public static function getInstance () : DoubleJump {
        return self::$instance;
    }
}