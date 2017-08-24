<?php
namespace GDO\PaymentCredits;

use GDO\DB\GDO;
use GDO\DB\GDO_AutoInc;
use GDO\Payment\Orderable;
use GDO\Payment\PaymentModule;
use GDO\Template\GDO_Template;
use GDO\Template\Message;
use GDO\Type\GDO_Int;
use GDO\User\GDO_User;
use GDO\User\User;
/**
 * Order own credits and pay with another payment processor.
 * @author gizmore
 */
final class CreditsOrder extends GDO implements Orderable
{
	public function paymentCredits() { return Module_PaymentCredits::instance(); }
	public function getOrderCancelURL(User $user) { return url('PaymentCredits', 'OrderCredits'); }
	public function getOrderSuccessURL(User $user) { return url('PaymentCredits', 'OrderCredits'); }
	
	public function getOrderTitle(string $iso) { return t('card_title_credits_order', [$this->getCredits()]); }
	public function getOrderPrice() { return $this->paymentCredits()->creditsToPrice($this->getCredits()); }
	public function displayPrice() { return $this->paymentCredits()->displayPrice($this->getOrderPrice()); }
	public function canPayOrderWith(PaymentModule $module) { return true; }
	
	public function onOrderPaid()
	{
		$user = $this->getUser();
		$credits = $this->getCredits();
		$oldCredits = $user->getCredits();
		$user->increase('user_credits', $credits);
		$newCredits = $user->getCredits();
		return Message::message('msg_credits_purchased', [$credits, $oldCredits, $newCredits]);
	}
	
	###########
	### GDO ###
	###########
	public function gdoColumns()
	{
		return array(
			GDO_AutoInc::make('co_id'),
			GDO_User::make('co_user')->notNull(),
			GDO_Int::make('co_credits')->unsigned()->notNull()->min($this->paymentCredits()->cfgMinPurchaseCredits())->label('credits'),
		);
	}
	
	##############
	### Getter ###
	##############
	/**
	 * @return User
	 */
	public function getUser() { return $this->getValue('co_user'); }
	public function getUserID() { return $this->getVar('co_user'); }
	public function getCredits() { return $this->getVar('co_credits'); }
	
	##############
	### Render ###
	##############
	public function renderCard() { return GDO_Template::responsePHP('PaymentCredits', 'card/credits_order.php', ['gdo' => $this]); }

}
