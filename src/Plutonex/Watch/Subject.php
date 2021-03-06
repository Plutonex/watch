<?php namespace Plutonex\Watch;

abstract class Subject implements SubjectInterface
{
	protected $observers = array();

	protected $state = null;

	protected $count = array();


	public function getState()
	{
		return $this->state;
	}


	public function setState($state)
	{
		$this->state = $state;
		$this->notify();
	}


	public function attach(ObserverInterface $observer, $priority = 1)
	{
        if (array_search($observer, $this->observers) === false) {
            $this->observers[$priority][] = $observer;
        }
	}


	public function detach(ObserverInterface $observer)
	{
		if(!empty($this->observers))
		{
			foreach($this->observers as $priority => $observers)
			{
				$index = array_search($observer, $this->observers[$priority]);

				if($index !== false)
				{
					unset($this->observer[$priority][$index]);
				}
			}
		}
	}


	public function notify()
	{
		if(! empty($this->observers))
		{
			foreach($this->observers as $priority => $observers)
			{
				foreach($observers as $observer)
				{
					$observer->update($this);			
				}
			}
		}
	}


	public function getObservers()
	{
		return $this->observers;
	}

	public function numObserversSent($state)
	{
		if(isset($this->count[$state]))
		{
			return $this->count[$state];
		}
		
		return 0;
	}

	public function count()
	{
		$state = $this->getState();

		if(isset($this->count[$state]))
		{
			$this->count[$state] = $this->count[$state] + 1;

		} else
		{
			$this->count[$state] = 1;
		}
	}
}