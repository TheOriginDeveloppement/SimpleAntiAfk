<?php

namespace afk;

use afk\event\EventListener;
use afk\task\AfkTask;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class Loader extends PluginBase implements Listener{


    public static Loader $instance;

    protected function onEnable(): void
    {

        self::$instance = $this;
        $this->getServer()->getPluginManager()->registerEvents(new EventListener(),$this);
        $this->getScheduler()->scheduleRepeatingTask(new AfkTask(),20);

        if(!file_exists($this->getDataFolder()."config.yml")){
            $config = new Config($this->getDataFolder()."config.yml",Config::YAML);
            $config->setAll(["afktime"=>300,"message"=>"You have been kicked because you were inactive for too long","warning"=>"§cYou will be kicked for inactivity in 30 seconds"]);
            $config->save();
        }

    }

    public static function getInstance() : Loader{
        return self::$instance;
    }
}