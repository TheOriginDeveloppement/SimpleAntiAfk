<?php


namespace afk\task;

use afk\Loader;
use afk\mgr\AfkManager;
use pocketmine\player\Player;
use pocketmine\scheduler\CancelTaskException;
use pocketmine\scheduler\Task;
use pocketmine\Server;
use pocketmine\utils\Config;

class AfkTask extends Task{


    public function onRun(): void
    {
            foreach (AfkManager::$afk as $pdata){
                $player = Server::getInstance()->getPlayerExact($pdata["player"]);
                $config = new Config(Loader::getInstance()->getDataFolder()."config.yml",Config::YAML);
                $data = $config->getAll();
                $time = $pdata["time"];
                if($player instanceof Player){

                    if(time() - $time < $data["afktime"]){
                        $timer = time() - $time;
                        $rest = $data["afktime"] - $timer;
                        if($rest === 30){
                           
                            $player->sendMessage($data["warning"]);
                        }
                    }else{
                        AfkManager::removeAfk($player);
                        $player->getNetworkSession()->disconnect($data["message"]);
                    }
                }
            }

    }
}