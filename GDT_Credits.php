<?php
namespace GDO\PaymentCredits;
use GDO\Type\GDT_Int;
use GDO\User\GDO_User;

final class GDT_Credits extends GDT_Int
{
    public function __construct()
    {
        $this->unsigned = true;
        $this->icon('money');

    }
    
    public function maxToUserCredits(GDO_User $user=null)
    {
        $user = $user ? $user : GDO_User::current();
        return $this->max($user->getCredits());
    }
}
