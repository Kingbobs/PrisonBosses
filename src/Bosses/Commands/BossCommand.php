<?php

//Derp was here :p

namespace Bosses\Commands;

use Bosses\Loader;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\item\Item;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\StringTag;
use pocketmine\Player;

class BossCommand extends PluginCommand
{

    public function __construct(Loader $plugin){
        $this->plugin = $plugin;
        parent::__construct("boss", $plugin);
        $this->setDescription("Give a player a boss summoner");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): void{
        if(!$sender->hasPermission("betterbosses.command")){
            $sender->sendMessage("§cYou do not have permission to execute this command");
            return;
        }
        if(empty($args[0])){
            $sender->sendMessage("§7Usage: /boss (type) (player)");
            return;
        }
        $bosses = [
            "nome" => [
                "Nome",
                Item::get(Item::BONE, 1)
                    ->setCustomName("§r§fFallenHero: §dCrypto §6| §7Right-Click")
                    ->setLore([
                        "§r§3A forgotten enemy of the Universe.",
                        "§r§7Altgough he may be forgotten, that does not mean he is not powerful.",
                        "§r§4 Beware When summoning this creature",
                        "§r§C Negatvie Effects will take their tull upon you.",
                        "",
                        "§r§7(!) Right-Click to summon the §dCrypto!"
                    ])
                    ->setCustomBlockData(new CompoundTag("", [
                        new StringTag("boss", "nome")
                    ]))
            ],
            "king" => [
                "king",
                Item::get(Item::BONE, 2)
                    ->setCustomName("§r§fFallenHero: §8Reaper §6| §7Right-Click")
                    ->setLore([
                        "§r§3The Forgotten Hero From The Gods Era, Also the most powerful.",
                        "§r§4 Beware When summoning this creature",
                        "§r§C Negatvie Effects will take their tull upon you.",
                        "",
                        "§r§7(!) Right-Click to summon the §8Reaper!"
                    ])
                    ->setCustomBlockData(new CompoundTag("", [
                        new StringTag("boss", "king")
                    ]))
            ]
        ];
        if(empty($bosses[strtolower($args[0])])){
            $sender->sendMessage("§cBoss not found. List of bosses: " . implode(", ", array_keys($bosses)));
            return;
        }
        $boss = $bosses[strtolower($args[0])];
        $item = $boss[1];
        if(!empty($args[1])){
            $target = $sender->getServer()->getPlayer($args[1]);
            if (!$target instanceof Player) return;
            if(!$target->hasPlayedBefore()){
                $sender->sendMessage("§cPlayer cannot be found");
                return;
            }
            $target->getInventory()->addItem($item);
            $target->sendMessage("§7You have received a boss summoner!");
            return;
        }
        if(!$sender instanceof Player){
            $sender->sendMessage("§cUse command in-game");
            return;
        }
        $sender->getInventory()->addItem($item);
        $sender->sendMessage("§7You have received a boss summoner!");
    }

}
