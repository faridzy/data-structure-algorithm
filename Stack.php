<?php

class Stack 
{
	private $stack =[];

	public function size() 
	{
		return count($this->stack);
	}

	public function top() 
	{
		return end($this->stack);
	}

	public function push($value = NULL) 
	{
		array_push($this->stack, $value);
	}

	public function pop() 
	{
		return array_pop($this->stack);
	}

	public function isEmpty() 

	{
		return empty($this->stack);
	}
}