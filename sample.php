<?php
require "bootstrap.php";

$sampleObject = Sample\Factory::create('sampleObject');

$observer = Sample\Factory::create('sampleObserver');
$observer->setVerbose(true);

$sampleObject->attach('processObserver', $observer);

$inputArray = array('here', 'there', 'everywhere');

$sampleObject->setData($inputArray);

$sampleObject->processData();

print_r("DATA PROCESSED ONCE\n");

var_dump($sampleObject->getData());

$sampleObject->processData();
print_r("DATA PROCESSED TWICE\n");

var_dump($sampleObject->getData());

$sampleObject->detach('processObserver');

$sampleObject->processData();
print_r("DATA PROCESSED THREE TIMES\n");

var_dump($sampleObject->getData());

print_r("OBSERVER ONLY COUNTED PROCESSING TWICE\n");
print_r($observer->getProcessCount() . "\n");

try {
    Sample\Factory::create('noClass');
} catch (Sample\FactoryException $e) {
    print_r("HANDLING THE FACTORY EXCEPTION\n");
    print_r('MESSAGE: ' . $e->getMessage() . "\n");
}
