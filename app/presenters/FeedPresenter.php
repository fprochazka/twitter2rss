<?php

namespace App\Presenters;

use Kdyby;
use Nette;
use Tracy\Debugger;



/**
 * @author Filip Procházka <filip@prochazka.su>
 */
class FeedPresenter extends BasePresenter
{

	/**
	 * @var \App\Twitter
	 * @inject
	 */
	public $twitter;



	public function renderFavorites()
	{
		$this->template->title = 'Favorites of @' . $this->twitter->getUser()->screen_name;
		$this->template->tweets = $this->twitter->getFavorites('5 minutes');
		$this->setView('tweets');
	}



	protected function beforeRender()
	{
		parent::beforeRender();
		$this->setLayout(FALSE);

		$latte = $this->template->getLatte();
		$latte->addFilter('rssDate', function ($date) {
			return Nette\Utils\DateTime::from($date)->format(\Datetime::RSS);
		});
		$latte->addFilter('tweet', function ($text, $tweet) {
			$text = \Twitter::clickable($tweet);

			if (isset($tweet->extended_entities->media)) {
				foreach ($tweet->extended_entities->media as $media) {
					if ($media->type !== 'photo') {
						continue;
					}

					$text .= '<br /><br />' . Nette\Utils\Html::el('img', [
						'src' => $media->media_url_https,
						'alt' => 'pic.twitter.com/N3LU65n3fC',
						'width' => $media->sizes->large->w,
						'height' => $media->sizes->large->h
					]);
				}
			}

			return $text;
		});
	}

}
