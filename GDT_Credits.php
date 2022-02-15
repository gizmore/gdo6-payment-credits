<?php
namespace GDO\PaymentCredits;

use GDO\DB\GDT_Int;
use GDO\User\GDO_User;

/**
 * Credit field.
 * @author gizmore
 */
final class GDT_Credits extends GDT_Int
{
	protected function __construct()
	{
		parent::__construct();
		$this->icon('money');
	}
	
	public function maxToUserCredits(GDO_User $user=null)
	{
		$user = $user ? $user : GDO_User::current();
		return $this->max($user->getCredits());
	}
	
}
