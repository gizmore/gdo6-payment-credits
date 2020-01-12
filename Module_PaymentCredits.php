<?php
namespace GDO\PaymentCredits;

use GDO\Payment\GDT_Money;
use GDO\Payment\Module_Payment;
use GDO\Payment\PaymentModule;
use GDO\UI\GDT_Bar;
use GDO\DB\GDT_Checkbox;
use GDO\DB\GDT_Decimal;
use GDO\Payment\GDO_Order;
/**
 * Pay with own credits.
 * Buy own credits.
 * @author gizmore
 * @license MIT
 * @since 4.0
 */
final class Module_PaymentCredits extends PaymentModule
{
	#####################
	### PaymentModule ###
	#####################
	public function makePaymentButton(GDO_Order $order=null)
	{
		$button = parent::makePaymentButton($order);
		return $button->label('buy_paymentcredits', [sitename()]);
	}
	
	##############
	### Module ###
	##############
	public function getDependencies() { return ['Payment']; }
	public function getClasses() { return ['GDO\PaymentCredits\GDO_CreditsOrder']; }
	public function onLoadLanguage() { return $this->loadLanguage('lang/credits'); }
	public function payment() { return Module_Payment::instance(); }

	##############
	### Config ###
	##############
	public function getConfig()
	{
		return array_merge(parent::getConfig(), array(
			GDT_Checkbox::make('paycreds_guests')->initial('0'),
			GDT_Decimal::make('paycreds_min_purchase')->digits(6, 2)->initial('5.00'),
			GDT_Decimal::make('paycreds_rate')->digits(1, 4)->initial('0.01'),
		));
	}
	public function cfgAllowGuests() { return $this->getConfigValue('paycreds_guests'); }
	public function cfgMinPurchasePrice() { return $this->getConfigValue('paycreds_min_purchase'); }
	public function cfgMinPurchaseCredits() { return $this->priceToCredits($this->cfgMinPurchasePrice()); }
	public function cfgConversionRate() { return $this->getConfigValue('paycreds_rate'); }
	public function cfgConversionRateToCurrency() { return $this->cfgConversionRate(); }
	public function cfgConversionRateToCredits() { return 1 / $this->cfgConversionRate(); }
	
	###############
	### Convert ###
	###############
	public function priceToCredits($price) { return floor($this->cfgConversionRateToCredits() * $price); }
	public function creditsToPrice($credits) { return round($this->cfgConversionRateToCurrency() * $credits, 2); }
	public function displayPrice($price) { return sprintf('%.02f %s', $price, GDT_Money::$CURR); }
	public function displayCreditsPrice($credits) { return $this->displayPrice($this->creditsToPrice($credits)); }
	
	###############
	### Sidebar ###
	###############
	public function hookRightBar(GDT_Bar $navbar)
	{
		$this->templatePHP('rightbar.php', ['navbar' => $navbar]);
	}
}
