<?php
use GDO\Template\GDO_Bar;
use GDO\UI\GDO_Link;
use GDO\User\User;
$navbar instanceof GDO_Bar;
$user = User::current();
if ($user->isAuthenticated())
{
	$link = GDO_Link::make()->label('link_credits', [$user->getCredits()])->href(href('PaymentCredits', 'OrderCredits'));
	$navbar->addField($link);
}
