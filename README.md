# Telegram for CMS

Telegram notifications for your CMS.

Long story short: you can send notifications about updates at your website (new posts, comments) via [Telegram](https://telegram.org). It's amazingly simple, everything is done by simple [HTTP requests](https://core.telegram.org/bots/api#making-requests). So, you only need to hook up "publish" event at your CMS.

For this to work you need a [Telegram bot](https://core.telegram.org/bots#3-how-do-i-create-a-bot) (knowing his token is enough) and a [Telegram channel](https://telegram.org/blog/channels) (if you want to broadcast your notifications).

I have written simple plugins that do such thing for [Wordpress](https://wordpress.org), [MediaWiki](https://www.mediawiki.org/wiki/MediaWiki) and [Drupal](https://www.drupal.org).

## Wordpress

You need to hook you functions to [publish_post](https://codex.wordpress.org/Plugin_API/Action_Reference/publish_post) or [comment_post](https://codex.wordpress.org/Plugin_API/Action_Reference/comment_post).<br/>
Here's more detailed [article](https://retifrav.github.io/blog/2015/11/08/wordpress-plugin-telegram/) (in Russian).

## MediaWiki

You need to hook your function to [PageContentSaveComplete](https://www.mediawiki.org/wiki/Manual:Hooks/PageContentSaveComplete).<br/>
Here's more detailed [article](https://retifrav.github.io/blog/2015/11/15/mediawiki-extension-telegram/) (in Russian).

## Drupal

First you need to install the module [Hook Post Action](https://www.drupal.org/project/hook_post_action). And then implement any hook you want (`hook_entity_postsave`, for example) in submodule.<br/>
Here's more detailed [article](https://retifrav.github.io/blog/2016/08/18/telegram-notifications-for-drupal/).
