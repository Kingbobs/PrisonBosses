<?php


namespace Bosses;

use Bosses\Commands\BossCommand;
use pocketmine\plugin\PluginBase;

class Loader extends PluginBase
{

    public function onEnable() {
        EntityManager::init();
        $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
        $this->getServer()->getCommandMap()->register("command", new BossCommand($this));
    }

}
