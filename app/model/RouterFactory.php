<?php

namespace App;

use Nette,
	Nette\Application\Routers\RouteList,
	Nette\Application\Routers\Route,
	Nette\Application\Routers\SimpleRouter;


/**
 * Router factory.
 */
class RouterFactory
{

	private $productionMode;



	public function __construct($productionMode)
	{
		$this->productionMode = $productionMode;
	}



	/**
	 * @return \Nette\Application\IRouter
	 */
	public function createRouter()
	{
		$router = new RouteList();
		$flags = $this->productionMode ? Route::SECURED : 0;

		$router[] = new Route('<presenter>/<action>[/<id>]', 'Homepage:default', $flags);

		return $router;
	}

}
