<?php

namespace Fadhel;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\utils\TextFormat as C;

class Main extends PluginBase implements Listener{
	
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->Info(C::GREEN. "Enabled!");
		}
		
	public function onDeath(PlayerDeathEvent $event) {
		$player = $event->getPlayer();
		$player->sendMessage(C::RED . "You died!");
    $this->openMyForm($player);
		}
    public function openMyForm($player){ 
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $player, int $data = null){
            $result = $data;
            if($result === null){
                return true;
            }             
            switch($result){
                case 0:
                    $player->sendMessage(TextFormat::RED . "Exiting");                    
                break;                     
            }
            
            
            });
            $form->setTitle("§l§cYOU DIED");
            $form->setContent(" §l§e§oINFO§r§f: You §bdied!");
            $form->addButton("Exit");
            $form->sendToPlayer($player);                  
            return $form;                                            
				}
	}
