<?php

class Dijkstra
{
   
    protected $graph;
   
    protected $distance;
   
    protected $previous;
   
    protected $queue;
   
    public function __construct($graph)
    {
        $this->graph = $graph;
    }
    

    protected function processNextNodeInQueue(array $exclude)
    {
        // Process the closest vertex
        $closest = array_search(min($this->queue), $this->queue);
        if (!empty($this->graph[$closest]) && !in_array($closest, $exclude)) {
            foreach ($this->graph[$closest] as $neighbor => $cost) {
                if (isset($this->distance[$neighbor])) {
                    if ($this->distance[$closest] + $cost < $this->distance[$neighbor]) {
                        // A shorter path was found
                        $this->distance[$neighbor] = $this->distance[$closest] + $cost;
                        $this->previous[$neighbor] = array($closest);
                        $this->queue[$neighbor] = $this->distance[$neighbor];
                    } elseif ($this->distance[$closest] + $cost === $this->distance[$neighbor]) {
                        // An equally short path was found
                        $this->previous[$neighbor][] = $closest;
                        $this->queue[$neighbor] = $this->distance[$neighbor];
                    }
                }
            }
        }
        unset($this->queue[$closest]);
    }
    

    protected function extractPaths($target)
    {
        $paths = array(array($target));
        for ($key = 0; isset($paths[$key]); ++$key) {
            $path = $paths[$key];
            if (!empty($this->previous[$path[0]])) {
                foreach ($this->previous[$path[0]] as $previous) {
                    $copy = $path;
                    array_unshift($copy, $previous);
                    $paths[] = $copy;
                }
                unset($paths[$key]);
            }
        }
        return array_values($paths);
    }
    

    public function shortestPaths($source, $target, array $exclude = array())
    {
        // The shortest distance to all nodes starts with infinity...
        $this->distance = array_fill_keys(array_keys($this->graph), INF);
        // ...except the start node
        $this->distance[$source] = 0;
        // The previously visited nodes
        $this->previous = array_fill_keys(array_keys($this->graph), array());
        // Process all nodes in order
        $this->queue = array($source => 0);
        while (!empty($this->queue)) {
            $this->processNextNodeInQueue($exclude);
        }
        if ($source === $target) {
           
            return array(array($source));
        } elseif (empty($this->previous[$target])) {
           
            return array();
        } else {
           
            return $this->extractPaths($target);
        }
    }
}


//Example


$graph = array(
  'A' => array('B' => 9, 'D' => 14, 'F' => 7),
  'B' => array('A' => 9, 'C' => 11, 'D' => 2, 'F' => 10),
  'C' => array('B' => 11, 'E' => 6, 'F' => 15),
  'D' => array('A' => 14, 'B' => 2, 'E' => 9),
  'E' => array('C' => 6, 'D' => 9),
  'F' => array('A' => 7, 'B' => 10, 'C' => 15),
  'G' => array(),
);

$algorithm = new Dijkstra($graph);


$path = $algorithm->shortestPaths('A', 'G'); // array()

$path = $algorithm->shortestPaths('A', 'E'); 
$path = $algorithm->shortestPaths('E', 'F'); // array(array('E', 'D', 
$path = $algorithm->shortestPaths('A', 'E'); // array(array('A', 'B', 'D', 'E'))
$path = $algorithm->shortestPaths('A', 'E', array('B')); // array(array('A', 'B', 'D', 'E'))
$path = $algorithm->shortestPaths('A', 'E', array('D')); // array(array('A', 'B', 'C', 'E'))
$path = $algorithm->shortestPaths('A', 'E', array('B', 'D')); // array(array('A', 'F', 'C', 'E'))

print_r($path);