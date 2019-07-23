<?php

class Node {
	public $data = NULL;
	public $next = NULL;

	public function __construct($data = NULL) {
		$this->data = $data;
	}
}

class LinkedList implements Iterator {
	private $_firstNode = NULL;
	private $_current = NULL;
	private $_position = 0;
	private $_count = 0;

	
	public function insertFirst($data = NULL) {
		$newNode = new Node($data);

		if ( $this->_firstNode !== NULL ) {
			$newNode->next = $this->_firstNode;
		}

		$this->_firstNode = &$newNode;

		$this->_count++;

		return TRUE;
	}

	
	public function insertLast($data = NULL) {
		if ( $this->_firstNode === NULL ) {
			$this->insertFirst($data);
		} else {
			$newNode = new Node($data);

			$current = $this->_firstNode;

			while ( $current->next !== NULL ) {
				$current = $current->next;
			}

			$current->next = $newNode;

			$this->_count++;
		}

		return TRUE;
	}

	
	public function insertAfter($query = NULL, $data = NULL) {
		$newNode = new Node($data);

		$current = $this->_firstNode;

		while ( $current->next !== NULL ) {
			$current = $current->next;

			if ( $current->data === $query ) {
				break;
			}
		}

		if ( $current !== NULL ) {
			if ( $current->next !== NULL ) {
				$newNode->next = $current->next;
			}

			$current->next = $newNode;

			return TRUE;
		}

		return FALSE;
	}

	

	public function insertBefore($query = NULL, $data = NULL) {
		$newNode = new Node($data);

		if ( $this->_firstNode !== NULL ) {
			$previous = NULL;
			$current = $this->_firstNode;

			while ( $current->next !== NULL ) {
				if ( $current->data === $query ) {
					$newNode->next = $current;
					$previous->next = $newNode;
					$this->_count++;
					break;
				}

				$previous = $current;
				$current = $current->next;
			}
		}
	}

	
	public function deleteFirst() {
		if ( $this->_firstNode !== NULL ) {
			if ( $this->_firstNode->next !== NULL ) {
				$this->_firstNode = $this->_firstNode->next;
			} else {
				$this->_firstNode = NULL;
			}

			$this->_count--;

			return TRUE;
		}

		return FALSE;
	}

	
	public function deleteLast() {
		if ( $this->_firstNode !== NULL ) {
			if ( $this->_firstNode->next === NULL ) {
				$this->_firstNode = NULL;
			} else {
				$previous = NULL;
				$current = $this->_firstNode;

				while ( $current->next !== NULL ) {
					$previous = $current;
					$current = $current->next;
				}

				$previous->next = NULL;

				$this->_count--;
			}

			return TRUE;
		}

		return FALSE;
	}

	
	public function delete($query = NULL) {
		if ( $this->_firstNode !== NULL ) {
			$previous = NULL;
			$current = $this->_firstNode;

			while ( $current->next !== NULL ) {
				if ( $current->data === $query ) {
					if ( $previous === NULL ) {
						$this->_firstNode = $current->next;
					} else {
						$previous->next = $current->next;
					}

					$this->_count--;

					return TRUE;
				}

				$previous = $current;
				$current = $current->next;
			}
		}

		return FALSE;
	}

	
	public function deleteAll($query = NULL) {
		if ( $this->_firstNode !== NULL ) {
			$previous = NULL;
			$current = $this->_firstNode;

			while ( $current->next !== NULL ) {
				if ( $current->data === $query ) {
					if ( $previous === NULL ) {
						$this->_firstNode = $current->next;
						$current = $this->_firstNode;
						continue;
					} else {
						$previous->next = $current->next;
					}

					$this->_count--;
				}

				$previous = $current;
				$current = $current->next;
			}
		}

		return FALSE;
	}

	
	public function reverse() {
		if ( $this->_firstNode !== NULL ) {
			if ( $this->_firstNode->next !== NULL ) {
				$reversed = $temp = NULL;
				$current = $this->_firstNode;

				while ( $current !== NULL ) {
					$temp = $current->next;

					$current->next = $reversed;
					$reversed = $current;

					$current = $temp;
				}

				$this->_firstNode = $reversed;
			}
		}
	}

	
	public function sort() {
		if ( $this->_firstNode !== NULL ) {
			if ( $this->_firstNode->next !== NULL ) {
				for ( $i = 0; $i < $this->_count; $i++ ) {
					$temp = NULL;
					$current = $this->_firstNode;

					while ( $current !== NULL ) {
						if ( $current->next !== NULL && $current->data > $current->next->data ) {
							$temp = $current->data;
							$current->data = $current->next->data;
							$current->next->data = $temp;
						}

						$current = $current->next;
					}
				}
			}
		}
	}

	
	public function getNthElement($n = 0) {
		if ( $this->_firstNode !== NULL && $n <= $this->_count ) {
			$current = $this->_firstNode;

			for ( $i = 0; $i < $n; $i++ ) {
				$current = $current->next;
			}

			return $current;
		}

		return FALSE;
	}

	
	public function getNthElementFromLast($n = 0) {
		if ( $this->_firstNode !== NULL && $n <= $this->_count ) {
			$current = $this->_firstNode;

			for ( $i = 0; $i < $this->_count - $n - 1; $i++ ) {
				$current = $current->next;
			}

			return $current;
		}

		return FALSE;
	}

	
	public function size() {
		return $this->_count;
	}

	
	public function rewind() {
		$this->_position = 0;
		$this->_current = $this->_firstNode;
	}

	public function current() {
		return $this->_current->data;
	}

	public function key() {
		return $this->_position;
	}

	public function next() {
		$this->_position++;
		$this->_current = $this->_current->next;
	}

	public function valid() {
		return $this->_current !== NULL;
	}
}