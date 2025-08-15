<?php
declare(strict_types=1);

try {

    $collection1 = Mage::getSingleton('delivery_collection'); // GOOD: Delivery_Collection|object|false
    $collection1->addFilter('foo', 'bar');                  // GOOD

    // Direct call to templated method returns Varien_Object, should be Model_Delivery
    $delivery0 = $collection1->getItemById(123);               // FAIL: Should be Model_Delivery but is Varien_Object
    echo $delivery0->doSomething('foo');                        // FAIL: Should be GOOD
    echo $delivery0->doSomething('foo')->format('Y-m-d');       // FAIL: No type hinting


    // Implicit iterator returns unknown type
    foreach ($collection1 as $delivery1) {                            // FAIL: Should be Model_Delivery but is unknown
        echo $delivery1->doSomething('foo');                          // FAIL: Should be error: Argument '1' passed to echo() is expected to be of type string, DateTimeInterface given
        echo $delivery1->doSomething('foo')->format('Y-m-d');         // FAIL: No type hinting
    }
    // Explicit iterator returns unknown type
    foreach ($collection1->getIterator() as $delivery2) {             // FAIL: Should be Model_Delivery but is mixed
        echo $delivery2->doSomething('foo');                          // FAIL: Should be error: Argument '1' passed to echo() is expected to be of type string, DateTimeInterface given
        echo $delivery2->doSomething('foo')->format('Y-m-d');         // FAIL: No type hinting
    }

    // Works without calling getIterator() when using direct class instantiation (no override)
    $collection2 = new Delivery_Collection();
    $delivery3 = $collection2->getItemById(123);               // GOOD: Model_Delivery
    $delivery3->doSomething('foo');                             // GOOD
    foreach ($collection2 as $delivery4) {                           // GOOD: Model_Delivery
        echo $delivery4->doSomething('foo');                    // GOOD: Error is expected: Method '__toString' is not implemented for '\DateTimeInterface'
        echo $delivery4->doSomething('foo')->format('Y-m-d'); // GOOD
    }

} catch (Exception $e) { }