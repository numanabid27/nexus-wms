<?php


function amount_to_words($amount)
{
    $formatter = new \NumberFormatter("en", \NumberFormatter::SPELLOUT);

    // Ensure 2 decimal places
    $amount = number_format($amount, 2, '.', '');
    list($dirham, $fils) = explode('.', $amount);

    $words = ucfirst($formatter->format($dirham)) . " dirham";

    if ($fils > 0) {
        $words .= " and " . $formatter->format($fils) . " fils";
    }


    return $words;
}
