<?php namespace Plutonex\Watch;

abstract class Observer implements ObserverInterface
{

	public function __construct(SubjectInterface $subject = null)
	{
		if(! is_null($subject))
		{
			$subject->attach($this);
		}
	}

	public function update(SubjectInterface $subject)
	{
		if(method_exists($this, $subject->getState()))
		{
			call_user_func_array(array($this, $subject->getState()), array($subject));
		}
	}
}