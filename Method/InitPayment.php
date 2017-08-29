<?php
namespace GDO\PaymentCredits\Method;

use GDO\Payment\MethodPayment;
use GDO\Payment\GDO_Order;
/**
 * Pay with own gwf credits.
 * @author gizmore
 * @version 5.0
 */
final class InitPayment extends MethodPayment
{
	public function execute()
	{
		if (!($order = $this->getOrderPersisted()))
		{
			return $this->error('err_order');
		}
		return $this->renderOrder($order)->add($this->templateButton($order));
	}
	
	private function templateButton(GDO_Order $order)
	{
		return $this->templatePHP('paybutton.php', ['order' => $order]);
	}
}
