<?phpuse GDO\PaymentCredits\GDO_CreditsOrder;
use GDO\UI\GDT_Card;use GDO\Payment\GDT_Money;use GDO\UI\GDT_Paragraph;/** @var $gdo GDO_CreditsOrder **/
$gdo instanceof GDO_CreditsOrder;
$user = $gdo->getUser();$card = GDT_Card::make();$card->title(t('card_title_credits_order', [$gdo->getCredits()]));$card->subtitle(t('card_title_credits_price', [$gdo->getCredits(), $gdo->displayPrice()]));$card->addFields(array(	GDT_Paragraph::make()->html(t('card_info_credits_price', [$gdo->getCredits(), $gdo->displayPrice()])),
));echo $card->render();