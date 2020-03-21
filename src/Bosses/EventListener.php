<?php


namespace Bosses;


use Bosses\Entities\ForgottenKing;
use Bosses\Entities\ForgottenNome;
use pocketmine\entity\Entity;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDeathEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\item\Item;
use pocketmine\Player;

class EventListener implements Listener
{

    public function __construct(Loader $plugin){
        $this->plugin = $plugin;
    }

    public function onTap(PlayerInteractEvent $event) {
        $item = $event->getItem();
        $player = $event->getPlayer();
        if ($item->getId() === Item::BONE && $item->getDamage() === 1) {
            if (!$item->hasCustomBlockData()) return;
            $boss = $item->getCustomBlockData()->getString("boss");
            $bone = Item::get(Item::BONE, 1, 1);
            $touch = $event->getTouchVector();
            $spawnAt = $player->add($touch->getX(), $touch->getY(), $touch->getZ());
            $entity = Entity::createEntity($boss, $player->getLevel(), Entity::createBaseNBT($spawnAt));
				if($entity !== null){
            	 $entity->setNameTag("§r§l§fFallenHero: §dCrypto\n" . $entity->getHealth() . "/" . $entity->getMaxHealth());
           	 	 $entity->setNameTagAlwaysVisible(false);
            	    $entity->spawnToAll();
           		 $player->getInventory()->removeItem($bone);
				}
        }

        if ($item->getId() === Item::BONE && $item->getDamage() === 2) {
            if (!$item->hasCustomBlockData()) return;
            $boss = $item->getCustomBlockData()->getString("boss");
            $bone = Item::get(Item::BONE, 2, 1);
            $touch = $event->getTouchVector();
            $spawnAt = $player->add($touch->getX(), $touch->getY(), $touch->getZ());
            $entity = Entity::createEntity($boss, $player->getLevel(), Entity::createBaseNBT($spawnAt));
				 if($entity !== null){
             	$entity->setNameTag("§r§l§fFallenHero: §8Reaper\n" . $entity->getHealth() . "/" . $entity->getMaxHealth());
           	   $entity->setNameTagAlwaysVisible(false);
             	$entity->spawnToAll();
           		 $player->getInventory()->removeItem($bone);
 				}
        }
    }

    public function onDeath(EntityDeathEvent $event) {
        $nome = [
            Item::get(339, 22, mt_rand(1, 2))->setCustomName("§r§l§a500000Money Note"),
            Item::get(339, 23, 1)->setCustomName("§r§l§e50Token Note"),
            Item::get(351, 5, mt_rand(1, 3))->setCustomName("§r§l§fGkit Gem: §dCrypto"),
        ];

        $king = [
            Item::get(339, 20, mt_rand(1, 2))->setCustomName("§r§l§a1000000Money Note"),
            Item::get(339, 21, mt_rand(0, 1))->setCustomName("§r§l§e100Token Note"),
            Item::get(264, 1, 1)->setCustomName("§r§l§fGkit Gem: §8Reaper")
        ];
        $boss = $event->getEntity();
        $cause = $event->getEntity()->getLastDamageCause();
        if (!$cause instanceof EntityDamageByEntityEvent) return;
        $damager = $cause->getDamager();
        if (!$damager instanceof Player) return;
        if ($boss instanceof ForgottenNome) {
            $damager->getInventory()->addItem($nome[array_rand($nome)]);
        } elseif ($boss instanceof ForgottenKing) $damager->getInventory()->addItem($king[array_rand($king)]);
    }
}
