<?php 
class sNode 
{ 
    public $nextPtr; // Node * 
    public $prevPtr; // Node * 
    public $currentPtr; // Value 

    function __construct($value) { 
        $this->prevPtr = NULL; 
        $this->nextPtr = NULL; 
        $this->currentPtr = $value; 
    } 

    function __destruct() { 
        $this->currentPtr = NULL; 
    } 
}; 

class DoubleLinkedLists { 
    private $currentPtr; 

    function __construct() { 
        $this->currentPtr = NULL; 
    } 

    function __destruct() { 
        $this->DeleteAll(); 
    } 

    
    public function DeleteAll() { 
        if( !$this->isEmpty() ) { 
          
            $this->currentPtr->prevPtr->nextPtr = NULL; 

           
            $tempPtr = NULL; 
            while( $this->currentPtr !== NULL ) { 
              
                $tempPtr = $this->currentPtr; 
              
                $this->currentPtr = $this->currentPtr->nextPtr; 
               
                $tempPtr = NULL; 
            } 
            // Reseting Variable 
            $this->currentPtr = NULL; 
            return true; 
        } else { 
            return false; 
        } 
    } 

   
    public function RemoveNode() { 
        if( !$this->isEmpty() ) { 
          
            if( $this->currentPtr->nextPtr === $this->currentPtr) { 
                $this->currentPtr = NULL; 
            } else { 
                $tempPtr = NULL; 
                $this->currentPtr->prevPtr->nextPtr = $this->currentPtr->nextPtr; 
                $this->currentPtr->nextPtr->prevPtr = $this->currentPtr->prevPtr; 
                $tempPtr = $this->currentPtr; 
                $this->currentPtr = $this->currentPtr->nextPtr; 
                $tempPtr = NULL; 
            } 
            return true; 
        } 
        return false; 
    } 

   
    private function isEmpty() { 
        return ($this->currentPtr === NULL); 
    } 

   
    public function getNewNode($value) { 
        $ptr = new Node($value); 
        return $ptr; 
    } 

    
    public function addNode($value) { 
        $newPtr = $this->getNewNode($value); 

        if( $this->isEmpty() ) { 
            $newPtr->prevPtr = $newPtr; 
            $newPtr->nextPtr = $newPtr; 
        } else { 
            $newPtr->nextPtr = $this->currentPtr->nextPtr; 
            $newPtr->prevPtr = $this->currentPtr; 
            $this->currentPtr->nextPtr = $newPtr; 
            $newPtr->nextPtr->prevPtr = $newPtr; 
        } 
        $this->currentPtr = $newPtr; 
    } 


    public function nextCurrent() { 
        if( !$this->isEmpty() ) { 
            $this->currentPtr = $this->currentPtr->nextPtr; 
            return true; 
        } else { 
            return false; 
        } 
    } 

   
    public function prevCurrent(){ 
        if( !$this->isEmpty() ) { 
            $this->currentPtr = $this->currentPtr->prevPtr; 
            return true; 
        } else { 
            return false; 
        } 
    } 

   
    public function &getCurrent() { 
        if( !$this->isEmpty() ) { 
            return $this->currentPtr->currentPtr; 
        } else { 
            return NULL; 
        } 
    } 
}; 
