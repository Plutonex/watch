<?php namespace Plutonex\Watch;

Interface SubjectInterface
{
	public function getState();

	public function setState($state);

	public function attach(ObserverInterface $observer);

	public function detach(ObserverInterface $observer)

	public function notify();

	public function getObservers();
}