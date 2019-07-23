<?php
class Queue 
{
	private $queue = [];

	public function size() 
	{
		return count($this->queue);
	}

	public function front() 
	{
		return end($this->queue);
	}

	public function back() 
	{
		return reset($this->queue);
	}

	public function push($value = NULL) 
	{
		array_unshift($this->queue, $value);
	}
	
	public function pop() 
	{
		return array_pop($this->queue);
	}

	public function isEmpty() 
	{
		return empty($this->queue);
	}
}
