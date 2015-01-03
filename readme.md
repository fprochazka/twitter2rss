fprochazka/twitter2rss
=============

This application creates RSS feeds from your user profile.
It's just a quickly hacked prototype using a great lib [dg/twitter-php](https://github.com/dg/twitter-php).


If you like this project and wanna help, [there are few issues](https://github.com/fprochazka/twitter2rss/issues?q=is%3Aopen+is%3Aissue+label%3A%22help+wanted%22) you might wanna look into :)


Installing
----------

- Just clone this repository
- Run `composer install`
- Create empty `app/config/config.local.neon`
- Fill in `twitter` parameters, that you can get by creating your Twitter application [apps.twitter.com](https://apps.twitter.com/). Don't forget to create access token.
- Profit


Feature: favorites
------------------

- Your last 200 favorite tweets are converted to RSS feed and cached for 5 minutes
- If the tweet contains image, it's added at the end of the tweet as `<img>` so it shows up in the feed directly
- If the tweet contains links, the first link is used as "item link". This is great for https://feedbin.com/, which has ["inline readability" feature](https://twitter.com/feedbin/status/347495751531778048), you can use to convert the target page to readable article. So if somebody tweets some link, you just click the button and you're now reading the article, inside the feedbin, instead of the tweet.
