<?php
use GDO\PaymentCredits\GDO_CreditsOrder;
$gdo instanceof GDO_CreditsOrder;
$user = $gdo->getUser();
?>
<md-card class="gdo-credits-order">
  <md-card-title>
	<md-card-title-text>
	  <span class="md-headline">
		<div><?= t('card_title_credits_order', [$gdo->getCredits()]); ?></div>
		<div class="gdo-card-subtitle"><?= t('card_title_credits_price', [$gdo->getCredits(), $gdo->displayPrice()]); ?></div>
	  </span>
	</md-card-title-text>
  </md-card-title>
  <gdo-div></gdo-div>
  <md-card-content flex>
	<div><?= t('card_info_credits_price', [$gdo->getCredits(), $gdo->displayPrice()]); ?></div>
  </md-card-content>
</md-card>
