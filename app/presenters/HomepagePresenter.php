<?php

namespace App\Presenters;

use Nette;


class HomepagePresenter extends BasePresenter
{

	/**
	 * @var \App\Twitter
	 * @inject
	 */
	public $twitter;



	public function renderDefault()
	{
		\Tracy\Debugger::$maxDepth = 5;

//		$self = $this->twitter->getUser();
//		dump($self);

//		dump($this->twitter->getRateLimitStatus());

//		dump($this->twitter->getFollowing());
//		dump($this->twitter->getOwnLists());
//		dump($this->twitter->getFavorites());

	}

}
