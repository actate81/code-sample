<?php
require "bootstrap.php";

class SampleCodeTest extends PHPUnit_Framework_TestCase
{

    /**
     * testFactory
     *
     * Tests to see if the correct object is created by the factory.
     * 
     * @return void
     */
	public function testFactory()
	{
		$sampleObject = \Sample\Factory::create('sampleObject');

		$this->assertInstanceOf('Sample\Object', $sampleObject);
	}

    /**
     * testFactoryException
     *
     * Tests to see if the exception is thrown.
     * 
     * @expectedException Sample\FactoryException
     */
    public function testFactoryException()
    {
        \Sample\Factory::create('noClass');
    }

    /**
     * testAnonymousProcessData
     *
     * Tests to see if the Sample Object processes data as expected.
     * 
     * @return void
     */
    public function testProcessData()
    {
        $sampleObject = $this->createSampleObject();
        $this->setData($sampleObject);

        $sampleObject->processData();

        $outputArray = array('I am here', 'I am there', 'I am everywhere');

        $this->assertEquals($outputArray, $sampleObject->getData());
    }

    /**
     * testObserverObject
     *
     * Tests to see if the Observer functionality works as expected.
     * 
     * @return void
     */
    public function testObserverObject()
    {
        $sampleObject = $this->createSampleObject();

        $observer = $this->createAndAttachObserver($sampleObject);

        $this->setData($sampleObject);

        $sampleObject->processData();
        $sampleObject->processData();

        $this->assertEquals(2, $observer->getProcessCount());
    }

    /**
     * testObserverDetach
     *
     * Checks to see if the observer detaches from the SampleObject sucessfully.
     * 
     * @return void
     */
    public function testObserverDetach()
    {
        $sampleObject = $this->createSampleObject();

        $observer = $this->createAndAttachObserver($sampleObject);

        $this->setData($sampleObject);

        $sampleObject->processData();

        $sampleObject->detach('processObserver');

        $sampleObject->processData();

        $this->assertEquals(1, $observer->getProcessCount());        
    }

    /**
     * createSampleObject
     *
     * Returns a SampleObject to use.
     *  
     * @return Sample\Object
     */
    protected function createSampleObject()
    {
        return \Sample\Factory::create('sampleObject');        
    }

    /**
     * setData
     *
     * Sets a sample data array for the given sample Object.
     *
     * @param  Sample\Object $sampleObject
     * 
     * @return void
     */
    protected function setData($sampleObject)
    {
        $inputArray = array('here', 'there', 'everywhere');

        $sampleObject->setData($inputArray);
    }

    /**
     * createSampleObject
     *
     * Creates and attaches an Observer object to the Sample Object. Returns the Observer object for testing purposes.
     *  
     * @return Sample\Observer
     */
    protected function createAndAttachObserver($sampleObject)
    {
        $observer = \Sample\Factory::create('sampleObserver');
        $sampleObject->attach('processObserver', $observer);

        return $observer;
    }
}