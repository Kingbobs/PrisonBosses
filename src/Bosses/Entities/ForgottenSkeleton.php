<?php


namespace Bosses\Entities;


use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\Item;

class ForgottenSkeleton extends BossEntity
{

    public const NETWORK_ID = self::SKELETON;
    /** @var float $width */
    public $width = 1.75;
    /** @var float $height */
    public $height = 4;


    public function initEntity(): void{
        parent::initEntity();
        $this->setNameTag("§r§cFallen§fSkeletonHero§3: \n§a" . $this->getHealth() . " §b<-§1::§b-> §c" . $this->getMaxHealth());
        $this->setNameTagAlwaysVisible(true);
        $this->setMaxHealth(300);
        $this->setHealth(300);
        $armor = $this->getArmorInventory();
        $helmet = Item::get(Item::DIAMOND_HELMET);
        $helmet->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), 7));
        $helmet->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 8000));
        $armor->setHelmet($helmet);
        $chestplate = Item::get(Item::IRON_CHESTPLATE);
        $chestplate->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), 3));
        $chestplate->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 10000));
        $armor->setChestplate($chestplate);
        $leggings = Item::get(Item::IRON_LEGGINGS);
        $leggings->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), 5));
        $leggings->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 9000));
        $armor->setLeggings($leggings);
        $boots = Item::get(Item::IRON_BOOTS);
        $boots->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), 7));
        $boots->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 7000));
        $armor->setBoots($boots);
    }

    public function getName(): string{
        return "Forgotten Skeleton";
    }
}
