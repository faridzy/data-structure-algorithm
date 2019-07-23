<?php

class Node {
	public $level = 1;
	public $data = NULL;
	public $left = NULL;
	public $right = NULL;

	public function __construct($data = NULL) {
		$this->data = $data;
	}
}

class BinarySearchTree {
	private $_topNode = NULL;
	private $_count = 0;
	private $_height = 1;

	
	public function insert($data = NULL) {
		$newNode = new Node($data);

		if ( $this->_topNode === NULL ) {
			$this->_topNode = &$newNode;
		} else {
			$current = $this->_topNode;

			while ( $current !== NULL ) {
				if ( $data < $current->data ) {
					$newNode->level++;

					if ( $current->left !== NULL ) {
						$current = $current->left;
					} else {
						$current->left = $newNode;
						break;
					}
				} else if ( $data > $current->data ) {
					$newNode->level++;

					if ( $current->right !== NULL ) {
						$current = $current->right;
					} else {
						$current->right = $newNode;
						break;
					}
				} else {
					return;
				}
			}
		}

		$this->_count++;
	}

	
	public function delete($data = NULL) {
		$direction = NULL;
		$parent = NULL;
		$current = $this->_topNode;

		while ( $current !== NULL ) {
			if ( $data < $current->data ) {
				if ( $current->left !== NULL ) {
					$parent = $current;
					$direction = 'left';
					$current = $current->left;
				} else {
					return FALSE;
				}
			} else if ( $data > $current->data ) {
				if ( $current->right !== NULL ) {
					$parent = $current;
					$direction = 'right';
					$current = $current->right;
				} else {
					return FALSE;
				}
			} else {
				if ( $current->left === NULL && $current->right === NULL ) {
					if ( $parent !== NULL && $direction !== NULL ) {
						$parent->$direction = NULL;
					} else {
						$this->_topNode = NULL;
					}
				} else if ( $current->right !== NULL && ($current->left === NULL || $current->right->left === NULL) ) {
					if ( $parent !== NULL && $direction !== NULL ) {
						$parent->$direction = $current->right;
					} else {
						$this->_topNode = $current->right;
					}
				} else {
					$current->data = $this->popLeftMost($current->right);
				}

				$this->_count--;

				return TRUE;
			}
		}
	}

	/**
	 * Search the tree for a given value.
	 */
	public function search($data = NULL) {
		$current = $this->_topNode;

		while ( $current !== NULL ) {
			if ( $data < $current->data ) {
				if ( $current->left !== NULL ) {
					$current = $current->left;
				} else {
					return FALSE;
				}
			} else if ( $data > $current->data ) {
				if ( $current->right !== NULL ) {
					$current = $current->right;
				} else {
					return FALSE;
				}
			} else {
				return $current;
			}
		}
	}


	public function size() {
		return $this->_count;
	}

	
	private function popLeftMost(&$node) {
		$parent = NULL;
		$current = $node;

		while ( $current->left !== NULL ) {
			$parent = $current;
			$current = $current->left;
		}

		$parent->left = NULL;
		$data = $current->data;

		return $data;
	}
}