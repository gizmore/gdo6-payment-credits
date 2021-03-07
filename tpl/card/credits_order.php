<?phpuse GDO\PaymentCredits\GDO_CreditsOrder;
use GDO\UI\GDT_Card;use GDO\UI\GDT_Paragraph;use GDO\UI\GDT_Label;/** @var $gdo GDO_CreditsOrder **/
$gdo instanceof GDO_CreditsOrder;
$card = GDT_Card::make();$card->title(GDT_Label::make()->label('card_title_credits_order', [$gdo->getCredits()]));$card->subtitle(GDT_Label::make()->label('card_title_credits_price', [$gdo->getCredits(), $gdo->displayPrice()]));$card->addField(	GDT_Paragraph::make()->text('card_info_credits_price', [$gdo->getCredits(), $gdo->displayPrice()])
);echo $card->render();