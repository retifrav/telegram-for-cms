# Telegram for CMS

Telegram notifications for various PHP-based CMS.

<!-- MarkdownTOC -->

- [About](#about)
- [CMS](#cms)
    - [Wordpress](#wordpress)
    - [MediaWiki](#mediawiki)
    - [Drupal](#drupal)

<!-- /MarkdownTOC -->

## About

It is possible to send notifications about updates on your website (*new posts, comments*) via [Telegram](https://telegram.org). It's a rather easy task, as everything is done via simple [HTTP requests](https://core.telegram.org/bots/api#making-requests). So you only need to "hook-up" the "publish" event of your CMS.

For this you'll need a [Telegram bot](https://core.telegram.org/bots#3-how-do-i-create-a-bot) and a Telegram chat ID, which can be a channel, a group or a user account (*yours, most likely*).

Here I created such plugins for:

- [Wordpress](https://wordpress.org)
- [MediaWiki](https://mediawiki.org/wiki/MediaWiki)
- [Drupal](https://drupal.org)

## CMS

### Wordpress

You need to hook you functions to [publish_post](https://codex.wordpress.org/Plugin_API/Action_Reference/publish_post) or [comment_post](https://codex.wordpress.org/Plugin_API/Action_Reference/comment_post).

Here's a more detailed [article](https://decovar.dev/blog/2015/11/08/wordpress-plugin-telegram/) (*in russian*).

### MediaWiki

You need to hook your function to [PageSaveComplete](https://mediawiki.org/wiki/Manual:Hooks/PageContentSaveComplete).

Here's a more detailed [article](https://decovar.dev/blog/2015/11/15/mediawiki-extension-telegram/) (*in russian*).

### Drupal

First you need to install the module [Hook Post Action](https://drupal.org/project/hook_post_action). And then implement any hook you want (*`hook_entity_postsave`, for example*) in submodule.

Here's a more detailed [article](https://decovar.dev/blog/2016/08/18/telegram-notifications-for-drupal/).
