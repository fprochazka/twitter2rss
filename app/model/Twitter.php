<?php

namespace App;

use Kdyby;
use Nette;



/**
 * @author Filip Procházka <filip@prochazka.su>
 */
class Twitter extends Nette\Object
{

	/**
	 * @var \Twitter
	 */
	private $twitter;

	/**
	 * @var \stdClass
	 */
	private $user;



	public function __construct(\Twitter $twitter)
	{
		$this->twitter = $twitter;
	}



	public function getUser()
	{
		if ($this->user === NULL) {
			$this->user = $this->twitter->cachedRequest('account/verify_credentials');
		}

		return $this->user;
	}



	public function getRateLimitStatus()
	{
		return $this->twitter->request('application/rate_limit_status.json?resources=help,users,search,statuses', 'GET');
	}



	public function getFollowing()
	{
		return $this->getAll($this->url('friends/list.json', ['screen_name' => $this->getUser()->screen_name, 'skip_status' => 'true', 'count' => 200]), function ($response, array $results) {
			return array_merge($results, $response->users);
		});
	}



	public function getOwnLists()
	{
		$lists = $this->get('lists/ownerships.json', ['screen_name' => $this->getUser()->screen_name])->lists;
		foreach ($lists as $list) {
			$list->members = $this->getAll($this->url('lists/members.json', ['list_id' => $list->id, 'count' => 5000, 'skip_status' => 'true']), function ($response, array $results) {
				return array_merge($results, $response->users);
			});
		}

		return $lists;
	}



	public function getFavorites()
	{
		$list = $this->get('favorites/list.json', ['count' => 200, 'screen_name' => $this->getUser()->screen_name]);

		return array_map(function ($tweet) {
			$tweet->created_at = (new \DateTime($tweet->created_at))
				->setTimezone(new \DateTimeZone(date_default_timezone_get()));

			return $tweet;
		}, $list);
	}



	public function getAll($resource, \Closure $collector, $limit = NULL, $data = NULL, $cacheExpire = NULL)
	{
		$results = array();
		$cursor = '-1';

		do {
			$response = $this->get($resource, ['cursor' => $cursor], $data, $cacheExpire);

			$cursor = isset($response->next_cursor) ? $response->next_cursor : NULL;
			$results = $collector($response, $results);

		} while ($cursor && ($limit === NULL || count($results) < $limit));

		return $results;
	}



	public function get($resource, $query = array(), $data = NULL, $cacheExpire = NULL)
	{
		return $this->twitter->cachedRequest($this->url($resource, $query), $data, $cacheExpire);
	}



	public function url($resource, $query = array())
	{
		return $resource . ($query ? (strpos($resource, '?') !== FALSE ? '&' : '?') . http_build_query($query) : '');
	}

}
