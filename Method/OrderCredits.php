<?php
namespace GDO\PaymentCredits\Method;
use GDO\Form\GDT_AntiCSRF;
use GDO\Form\GDT_Form;
use GDO\Form\GDT_Submit;
use GDO\Payment\Payment_Order;
use GDO\PaymentCredits\GDO_CreditsOrder;
use GDO\PaymentCredits\Module_PaymentCredits;
use GDO\User\GDO_User;

/**
 * Order more gwf credits.
 * @author gizmore
 */
final class OrderCredits extends Payment_Order
{
	public function getOrderable()
	{
		return GDO_CreditsOrder::blank(array(
			'co_user' => GDO_User::current()->getID(),
			'co_credits' => $this->getForm()->getFormVar('co_credits'),
		));
	}
	
	public function createForm(GDT_Form $form)
	{
		$module = Module_PaymentCredits::instance();
		$gdo = GDO_CreditsOrder::table();
		$form->addFields(array(
			$gdo->gdoColumn('co_credits')->initial($module->cfgMinPurchaseCredits()),
			GDT_Submit::make(),
			GDT_AntiCSRF::make(),
		));
	}

}
