<?php

class HPtoTB
{
    public static function sendNotification($wikiPage, $user, $summary, $flags, $revisionRecord, $editResult)
    {
        global $wgHPtoTBToken, $wgHPtoTBChatID; // from extension.json or LocalSettings.php

        $link2article = "https://YOUR.WIKI" . "/index.php/Special:RecentChanges";#$wikiPage->getTitle()->getLinkURL();
        $msg = "New edit at wiki!\n\n"
            . "*User*: " . $user . "\n"
            . "*Article*: " . $wikiPage->getTitle() . "\n\n"
            . $link2article;

        $ch = curl_init("https://api.telegram.org/bot" . $wgHPtoTBToken . "/sendMessage?chat_id=" . $wgHPtoTBChatID . "&text=" . urlencode($msg) . "&parse_mode=Markdown&disable_web_page_preview=true");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0); // change to 1, if you want details

        $result = curl_exec($ch);
        if( ! $result )
        {
            trigger_error(curl_error($ch));
        }

        // if `CURLOPT_RETURNTRANSFER` is `1`
        //$errors = curl_error($ch);
        //$statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        //$info = curl_getinfo($ch);

        /*
        // for those who failed to understand how MediaWiki logging works
        $fp = fopen('/tmp/some-result.txt', 'w');
        fwrite($fp, 'Errors: ' . $errors);
        fwrite($fp, PHP_EOL);
        fwrite($fp, 'Status code: ' . $statusCode);
        fwrite($fp, PHP_EOL);
        fwrite($fp, 'Took ' . $info['total_time'] . ' seconds to send a request to ' . $info['url']);
        fclose($fp);
        */

        curl_close($ch);

        return $result;
    }
}
