<?php
use GDO\Template\GDT_Bar;
use GDO\UI\GDT_Link;
use GDO\User\User;
$navbar instanceof GDT_Bar;
$user = User::current();
if ($user->isAuthenticated())
{
	$link = GDT_Link::make()->label('link_credits', [$user->getCredits()])->href(href('PaymentCredits', 'OrderCredits'));
	$navbar->addField($link);
}
