<?php
namespace GDO\PaymentCredits\Method;

use GDO\Core\Method;
use GDO\Payment\GDO_Order;
use GDO\PaymentCredits\Module_PaymentCredits;
use GDO\User\GDO_User;
use GDO\Util\Common;
use GDO\Core\Website;
use GDO\Payment\Module_Payment;
/**
 * Pay with own gwf credits.
 * @author gizmore
 * @version 5.0
 */
final class Pay extends Method
{
	public function showInSitemap() { return false; }
	public function isAlwaysTransactional() { return true; }
	
	public function execute()
	{
		$user = GDO_User::current();
		$module = Module_PaymentCredits::instance();
		
				# Check
		if ( (!($order = GDO_Order::getById(Common::getRequestString('order', '0')))) ||
			 ($order->isPaid()) || (!$order->isCreator($user)) )
		{
			return $this->error('err_order')->addField(
				$order ? $order->redirectFailure() : Website::redirect(href(GDO_MODULE, GDO_METHOD)));
		}
		
		# Pay?
		$price = $order->getPrice();
		$credits = $module->priceToCredits($price);
		if ($user->getCredits() < $credits)
		{
			$response = $this->error('err_no_credits', [$order->displayPrice(), $credits, $user->getCredits()]);
			return $response->addField($order->redirectFailure());
		}
		
		$order->saveVar('order_xtoken', $module->getTransferPurpose($order));

		# Pay and Exec
		$user->increase('user_credits', -$credits);
		
		return Module_Payment::instance()->onExecuteOrder($module, $order);
	}
}
