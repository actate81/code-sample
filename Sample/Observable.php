<?php
namespace Sample;

/**
 * Observable interface
 *
 * @package default
 * @author Andrew Tate
 **/
interface Observable
{
    public function attach($observerLabel, $observer);
    public function detach($observerLabel);
    public function trigger();
} 