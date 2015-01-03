fprochazka/twitter2rss
=============

This application creates RSS feeds from your user profile.
It's just a quickly hacked prototype using a great lib [dg/twitter-php](https://github.com/dg/twitter-php).


Installing
----------

- Just clone this repository
- Run `composer install`
- Create empty `app/config/config.local.neon`
- Fill in `twitter` parameters, that you can get by creating your Twitter application [apps.twitter.com](https://apps.twitter.com/). Don't forget to create access token.
- Profit


Todo
----

- simple token-parameter-based auth, so the feeds are at least a tiny bit protected
- feeds for lists
- feeds for timeline
- feeds for provided username
