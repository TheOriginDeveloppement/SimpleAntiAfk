<?php

namespace afk\event;

use afk\mgr\AfkManager;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\player\PlayerQuitEvent;

class EventListener implements Listener{

    public function onQuit(PlayerQuitEvent $ev){
        $player = $ev->getPlayer();
        AfkManager::removeAfk($player);
    }

    public function onMove(PlayerMoveEvent $ev){
        $player = $ev->getPlayer();
        AfkManager::addToAfk($player);
    }
}