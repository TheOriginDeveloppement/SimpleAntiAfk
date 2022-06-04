<?php

namespace afk\mgr;

use pocketmine\player\Player;

class AfkManager{

    public static $afk = [];

    public static function isAfk(Player $player){
        if(isset(self::$afk[$player->getName()])){
            return true;
        }else{
            return false;
        }
    }

    public static function removeAfk(Player $player){
        if(self::isAfk($player)){
            unset(self::$afk[$player->getName()]);
        }
    }

    public static function addToAfk(Player $player){
        self::$afk[$player->getName()] = ["player"=>$player->getName(),"time"=>time()];
    }
}