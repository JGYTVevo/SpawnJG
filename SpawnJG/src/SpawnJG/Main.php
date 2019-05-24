<?php
namespace SpawnJG;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\Player;

class Main extends PluginBase implements Listener{
    public function onEnable(){
        $this->getserver()->getPluginManager()->registerEvents($this, $this);
        if(!is_dir($this->getDataFolder())){
            @mkdir($this->getDataFolder());
        }
        $config = new Config($this->getDataFolder()."config.yml", CONFIG::YAML, array(
            "SpawnMessage" => "§Teleported you successfully to Server Spawn!"
        ));
    }

    public function onCommand(CommandSender $sender, Command $command, $label, array $args) : bool{
        switch($command->getName()){
            case "spawn":
                if($sender instanceof Player){
                    $pos = $sender->getLevel()->getSpawnLocation();
                    $message = $this->getConfig()->get("SpawnMessage");
                    $sender->teleport($pos);
                    $sender->sendMessage($message);
                }else{
                    $sender->sendMessage("§cPlease run this command in-game.");
                }
                return true;
        }
    }
}
