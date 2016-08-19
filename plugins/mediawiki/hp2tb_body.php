<?php

class HPtoTB {
    public static function sendNotification( $article, $user, $content, $summary,
        $isMinor, $isWatch, $section, $flags, $revision, $status, $baseRevId ) {

        $token = "TELEGRAM-BOT-TOKEN-HERE";
        $chatID = "SOME-TELEGRAM-ID-HERE";
        
        $link2article = "YOUR-DOMAIN-HERE" . "/index.php/Special:RecentChanges";#$article->getTitle()->getLinkURL();
        $msg = "New edit at wiki.%0A%0A"
            . "*User*: " . $user . "%0A"
            . "*Article*: " . $article->getTitle() . "%0A%0A"
            . $link2article;
        
        $ch = curl_init("https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chatID . "&text=" . $msg . "&parse_mode=Markdown&disable_web_page_preview=true");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
        curl_exec($ch);
        curl_close ($ch);

        return true;

    }
}
