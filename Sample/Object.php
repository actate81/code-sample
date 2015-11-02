<?php
namespace Sample;

/**
 * Object
 *
 * This is the base object for the code sample.
 *
 * @package default
 * @author Andrew Tate
 **/
class Object implements Observable
{
    protected $data;
    protected $observers = array();

    /**
     * setData
     *
     * @param  array $data
     * @return void
     **/
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * getData
     * 
     * @return array $this->data
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * processData
     *
     * Runs through the data set and applies some additional processing.
     * 
     * @return void
     */
    public function processData()
    {
        /**
         * I used an anonymous function for the purpose of showing how this may be used
         * with array_map. Another way of doing this would be to call one of the objects method.
         * e.g. array_map(array($this, 'processDataRow'), $this->data)
         */
         $this->data = array_map(
            function ($value) {
                return 'I am ' . $value;
            }, $this->data);

         $this->trigger();
    }

    /**
     * attach
     *
     * Attach an observer object.
     * 
     * @param  string $observerLabel
     * @param  Sample\Observer $observer
     * @return void
     */
    public function attach($observerLabel, $observer)
    {
        $this->observers[$observerLabel] = $observer;
    }

    /**
     * detach
     *
     * Detach the given Observer.
     * 
     * @param  string $observerLabel
     * 
     * @return void
     */
    public function detach($observerLabel)
    {
        unset($this->observers[$observerLabel]);
    }

    /**
     * trigger
     *
     * Trigger the attached observers.
     * 
     * @return void
     */
    public function trigger()
    {
        foreach($this->observers as $valObserver) {
            $valObserver->trigger();
        }
    }
}