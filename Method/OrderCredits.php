<?php
namespace GDO\PaymentCredits\Method;
use GDO\Form\GDO_AntiCSRF;
use GDO\Form\GDO_Form;
use GDO\Form\GDO_Submit;
use GDO\Payment\Payment_Order;
use GDO\PaymentCredits\CreditsOrder;
use GDO\PaymentCredits\Module_PaymentCredits;
use GDO\User\User;

/**
 * Order more gwf credits.
 * @author gizmore
 */
final class OrderCredits extends Payment_Order
{
	public function getOrderable()
	{
		return CreditsOrder::blank(array(
			'co_user' => User::current()->getID(),
			'co_credits' => $this->getForm()->getFormVar('co_credits'),
		));
	}
	
	public function createForm(GDO_Form $form)
	{
		$module = Module_PaymentCredits::instance();
		$gdo = CreditsOrder::table();
		$form->addFields(array(
			$gdo->gdoColumn('co_credits')->initial($module->cfgMinPurchaseCredits()),
			GDO_Submit::make(),
			GDO_AntiCSRF::make(),
		));
	}

}
