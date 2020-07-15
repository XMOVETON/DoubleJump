<?php

namespace felony13twelve\doublejump;

use pocketmine\event\Listener;

// events player
use pocketmine\event\player\PlayerToggleFlightEvent;
use pocketmine\event\player\PlayerJoinEvent;

/**
 * Class EventHandler
 * @package felony13twelve\doublejump
 *
 * @author  <felony13twelve@gmail.com> <Tg:@felony13twelve>
 * @version 1.0.0
 */
class EventHandler implements Listener {

    public function onJoinPlayer (PlayerJoinEvent $event) {
        $player = $event->getPlayer();

        if ($player->isSurvival()) {
            $player->setAllowFlight(true);
        }
    }

    public function onToggleFlight (PlayerToggleFlightEvent $event) {
        $player = $event->getPlayer();
        
        if ($player->isSurvival()) {
            $player->setFlying(false);

            $jump = $player->getDirectionVector()->multiply(DoubleJump::getInstance()->getJump());

            $player->setMotion($jump);
            $event->setCancelled();
        }
    }
}