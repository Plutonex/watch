<?php namespace Plutonex\Watch;

abstract class Subject implements SubjectInterface
{
	protected $observers = array();

	protected $state = null;


	public function getState()
	{
		return $this->state;
	}


	public function setState($state)
	{
		$this->state = $state;
		$this->notify();
	}


	public function attach(ObserverInterface $observer)
	{
        if (array_search($observer, $this->observers) === false) {
            $this->observers[] = $observer;
        }
	}


	public function detach(ObserverInterface $observer)
	{
		if(!empty($this->observers))
		{
			$index = array_search($observer, $this->observers);
			if($index !== false)
			{
				unset($this->observer[$index]);
			}
		}
	}


	public function notify()
	{
		if(! empty($this->observers))
		{
			foreach($this->observers as $observer)
			{
				$observer->update($this);
			}
		}
	}


	public function getObservers()
	{
		return $this->observers;
	}
}