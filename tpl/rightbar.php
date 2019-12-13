<?php
use GDO\UI\GDT_Bar;
use GDO\UI\GDT_Link;
use GDO\User\GDO_User;
$navbar instanceof GDT_Bar;
$user = GDO_User::current();
if ($user->isAuthenticated())
{
	$link = GDT_Link::make()->label('link_credits', [$user->getCredits()])->href(href('PaymentCredits', 'OrderCredits'));
	$navbar->addField($link);
}

if ($user->isAdmin())
{
	$link = GDT_Link::make()->label('link_grant_credits')->href(href('PaymentCredits', 'GrantCredits'));
	$navbar->addField($link);
}
