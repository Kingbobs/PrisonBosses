<?php


namespace Bosses\Entities;


use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\Item;

class ForgottenNome extends BossEntity
{

    public const NETWORK_ID = self::ZOMBIE_PIGMAN;
    /** @var float $width */
    public $width = 0.875;
    /** @var float $height */
    public $height = 2.0;


    public function initEntity(): void{
        parent::initEntity();
        $this->setNameTag("§r§l§fFallenHero: §dCrypto\n" . $this->getHealth() . "/" . $this->getMaxHealth());
        $this->setNameTagAlwaysVisible(true);
        $this->setMaxHealth(100);
        $this->setHealth(100);
        $armor = $this->getArmorInventory();
        $helmet = Item::get(Item::IRON_HELMET);
        $helmet->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), 5));
        $helmet->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 10000));
        $armor->setHelmet($helmet);
        $chestplate = Item::get(Item::IRON_CHESTPLATE);
        $chestplate->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), 5));
        $chestplate->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 10000));
        $armor->setChestplate($chestplate);
        $leggings = Item::get(Item::IRON_LEGGINGS);
        $leggings->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), 5));
        $leggings->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 10000));
        $armor->setLeggings($leggings);
        $boots = Item::get(Item::IRON_BOOTS);
        $boots->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), 5));
        $boots->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 10000));
        $armor->setBoots($boots);
    }

    public function getName(): string{
        return "Forgotten Nome";
    }
}
