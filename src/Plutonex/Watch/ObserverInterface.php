<?php namespace Plutonex\Watch;

Interface ObserverInterface
{
	public function update(SubjectInterface $subject);
}