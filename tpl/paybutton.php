<?php
use GDO\Payment\GDO_Order;
use GDO\PaymentCredits\Module_PaymentCredits;
use GDO\UI\GDT_Bar;
use GDO\UI\GDT_Button;
$order instanceof GDO_Order; 
?>
<?php
$user = $order->getUser();
$bar = GDT_Bar::make();
$price = $order->getPrice();
$module = Module_PaymentCredits::instance();
$button = GDT_Button::make()->label('btn_pay_credits', [$module->priceToCredits($price), $user->getCredits()]);
$button->href(href('PaymentCredits', 'Pay', '&order='.$order->getID()));
$button->icon('money');
$bar->addField($button);
echo $bar->renderCell();
