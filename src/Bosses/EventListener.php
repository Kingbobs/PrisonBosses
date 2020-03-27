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
	    
        if ($item->getId() === Item::BONE && $item->getDamage() === 1) {
            if (!$item->hasCustomBlockData()) return;
            $boss = $item->getCustomBlockData()->getString("boss");
            $bone = Item::get(Item::BONE, 1, 1);
            $touch = $event->getTouchVector();
            $spawnAt = $player->add($touch->getX(), $touch->getY(), $touch->getZ());
            $entity = Entity::createEntity($boss, $player->getLevel(), Entity::createBaseNBT($spawnAt));
				if($entity !== null){
            	 $entity->setNameTag("§r§cFallen§fSkeletonHero§3: \n§a" . $this->getHealth() . " §b<-§1::§b-> §c" . $this->getMaxHealth());
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
            Item::get(434, 0, mt_rand(1, 2))->setCustomName("§r§cNome Heart"),
            Item::get(264, 0, mt_rand(5, 100))->setCustomName("§r§l§bGems"),
	    Item::get(388, 0, mt_rand(5, 100))->setCustomName("§r§l§aGems")
        ];

        $king = [
            Item::get(437, 0, mt_rand(1, 2))->setCustomName("§r§eKings §bB§fr§be§fa§bt§fh§r"),
            Item::get(450, 0, mt_rand(0, 1))->setCustomName("§r§l§eKings §l§0Soul§r"),
            Item::get(347, 0, 1)->setCustomName("§r§l§eKings §l§3Watch§r"),
            Item::get(397, 3, 1)->setCustomName("§r§3Kings Head")
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
