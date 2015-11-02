<?php
namespace Sample;

/**
  * Sample Factory
  *
  * Creates objects as needed. This is a very simple class, kept that way for brevity. 
  * Advanced factories would be able to handle more than just simple object instantation, including 
  * injecting dependencies depending upon which object needs to be created.
  * 
  * 
  * @package default
  * @author Andrew Tate
  **/
class Factory
{
    protected static $objectList = array('sampleObject' => 'Sample\Object',
                                         'sampleObserver' => 'Sample\Observer');

    /**
     * create
     *
     * Creates a newObject depending upon the given class.
     *
     * @return mixed $newObject
     **/
    public function create($className)
    {
        $className = self::$objectList[$className];

        if (class_exists($className)) {
            return new $className();
        }

        throw new FactoryException('Class does not exist.');
    }
} 