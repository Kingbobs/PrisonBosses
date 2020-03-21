<?php


namespace Bosses;


use Bosses\Entities\ForgottenKing;
use Bosses\Entities\ForgottenNome;
use pocketmine\entity\Entity;

class EntityManager extends Entity
{

    public static function init(): void
    {
        self::registerEntity(ForgottenKing::class, true, ["king"]);
        self::registerEntity(ForgottenNome::class, true, ["nome"]);
    }
}
