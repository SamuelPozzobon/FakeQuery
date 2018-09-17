<?php

namespace FakeQuery;

//DON'T TAKE THE OWNERSHIP, ONLY FORK!
//Let the bot begins on your server!

use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\event\Listener;
use pocketmine\event\server\QueryRegenerateEvent;
use pocketmine\utils\Config;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class Main extends PluginBase implements Listener{

public function onEnable(){
$this->getLogger()->notice("FakeQuery by Klaus");
$this->getServer()->getPluginManager()->registerEvents($this, $this);
@mkdir($this->getDataFolder(),0777,true);
$this->saveDefaultConfig();
$this->reloadConfig();
}

public function onQuery(QueryRegenerateEvent $e){
$minPlayerCount = $this->getConfig()->get("min");
$maxPlayerCount = $this->getConfig()->get("max");
$e->setPlayerCount(mt_rand($minPlayerCount,$maxPlayerCount));
$Count = $e->getPlayerCount();
$this->getLogger()->notice("Update Player Count\nNow PlayerCount : $Count");
}

public function onCommand(CommandSender $sender, Command $cmd, $label, array $arg) : bool{
if (strtolower($cmd->getName()) == 'smaxc'){
if (isset($arg[0])){
$this->getConfig()->set('max',"$arg[0]");
$this->getConfig()->save();
$sender->sendMessage("Set the maximum number of people correctly:$arg[0]");
return true;
}else{
$sender->sendMessage("Missing parameters");
}
}
if (strtolower($cmd->getName()) == 'sminc'){
if (isset($arg[0])){
$this->getConfig()->set('min',"$arg[0]");
$this->getConfig()->save();
$sender->sendMessage("Successfully set the minimum number of people:$arg[0]");
return true;
}else{
$sender->sendMessage("Missing parameters");
}
}
return true;
}

}
