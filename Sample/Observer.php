<?php
namespace Sample;

/**
 * Observer
 *
 * A simple observer to be used for this sample code.
 *
 * @package default
 * @author Andrew Tate
 **/
class Observer
{
    protected $processCount = 0;
    protected $verbose = false;

    public function getProcessCount()
    {
        return $this->processCount;
    }

    public function setVerbose($verbose)
    {
        $this->verbose = $verbose;
    }

    public function trigger()
    {
        if ($this->verbose) {
            var_dump('OBSERVER TRIGGERED: DATA IS BEING PROCESSED. THE COUNT HAS INCREASED BY ONE.');
        }

        $this->processCount++;
    }
}