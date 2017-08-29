<?php
use GDO\Payment\Order;
use GDO\PaymentCredits\Module_PaymentCredits;
use GDO\Template\GDT_Bar;
use GDO\UI\GDT_Button;
$order instanceof Order; 
?>
<?php
$user = $order->getUser();
$bar = GDT_Bar::make();
$price = $order->getPrice();
$module = Module_PaymentCredits::instance();
$button = GDT_Button::make()->label('btn_pay_credits', [$module->priceToCredits($price), $user->getCredits()]);
$button->href(href('PaymentCredits', 'Pay', '&order='.$order->getID()));
$button->icon('attach_money');
$bar->addField($button);
echo $bar->renderCell();
