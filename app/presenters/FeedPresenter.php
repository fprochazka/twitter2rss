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



	protected function startup()
	{
		parent::startup();
//		Debugger::$productionMode = TRUE;
	}



	public function renderTimeline()
	{

	}



	public function renderFavorites()
	{
		$this->template->title = 'Favorites of @' . $this->twitter->getUser()->screen_name;
		$this->template->tweets = $this->twitter->getFavorites();
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
			return $text;
		});
	}

}
