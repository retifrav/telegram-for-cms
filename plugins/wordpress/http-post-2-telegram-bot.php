<?php
   /*
   Plugin Name: HTTP POST to Telegram bot
   Description: Sends a HTTP POST to a specified Telegram bot after any post has been published.
   Version: 0.2
   Author: retif
   Author URI: https://github.com/retifrav/telegram-for-cms
   License: MIT
   */

    // activation
    function tp2tb_plugin_install()
    {
      error_log("hp2tb - Plugin activated");
    }
    register_activation_hook(__FILE__,'tp2tb_plugin_install');

    // sent a notification about new post
    function publish_on_channel( $ID, $post ) {
      // if post is published and it's not an update
      if ($post->post_status == "publish" && $post->post_modified_gmt == $post->post_date_gmt)
      {
        // admin categories
        $admin_cats = array(111, 222);
        // news categories
        $news_cats = array(333, 444, 555, 666);
        // release categories
        $release_cats = array(777);

        // current categories
        $cats = $post->post_category;

        // exclude admin categories from notifications 
        if (empty(array_intersect($cats, $admin_cats)))
        {
            // determine hashtag
            $hashtag = "New post: ";
            if (!empty(array_intersect($cats, $release_cats))) { $hashtag = "%23release "; }
            if (!empty(array_intersect($cats, $news_cats))) { $hashtag = "%23news "; }

            try
            {
              $msg = $hashtag . get_permalink( $ID );
                //. $post->post_title . "%0A"
                //. implode(", ", $post->post_category) . "%0A"
                //. $post->post_name . "%0A"
              $ch = curl_init("https://api.telegram.org/TELEGRAM-BOT-TOKEN-HERE/sendMessage?chat_id=SOME-TELEGRAM-ID-HERE&text=" . $msg);
              curl_setopt($ch, CURLOPT_POST, 1);
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
              curl_exec($ch);
              curl_close ($ch);
            }
            catch(Exception $ex)
            {
              error_log("hp2tb - New post notification error");
            }
        }
      }
    }
    add_action( 'publish_post', 'publish_on_channel', 10, 2 );

    // send notification about new comment
    function send_to_chat($commentID, $isApproved) {
        // comment itself
        $cmmnt = get_comment($commentID);
        // post
        $pst = get_post($cmmnt->comment_post_ID);
        
        try
        {
          $chatID = SOME-TELEGRAM-ID-HERE;
          // notify about not approved to different chat
          if ($cmmnt->comment_approved != 1) { $chatID = SOME-DIFFERENT-TELEGRAM-ID-HERE; }
          // Markdown message
          $msg = "New comment to post \"_" . $pst->post_title . "_\" (" . str_replace("_", "\_", get_permalink($cmmnt->comment_post_ID)) . ")." . "%0A%0A"
            . "*Author*: " . $cmmnt->comment_author . "%0A"
            . "*Comment*: " . $cmmnt->comment_content;
          $ch = curl_init("https://api.telegram.org/TELEGRAM-BOT-TOKEN-HERE/sendMessage?chat_id=" . $chatID . "&text=" . trim(preg_replace('/\s+/', ' ', $msg)) . "&parse_mode=Markdown&disable_web_page_preview=true");
          curl_setopt($ch, CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
          curl_exec($ch);
          curl_close ($ch);
        }
        catch(Exception $ex)
        {
          error_log("hp2tb - New comment notification error");
        }
    }
    // hook up
    add_action( 'comment_post', 'send_to_chat', 10, 2 );
?>