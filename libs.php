<?php
declare(strict_types=1);

/**
 * @template T
 * @template-extends Varien_Data_Collection<T>
 */
class Abstract_Collection extends Varien_Data_Collection
{
    public function addFilter(string $field, mixed $value, string $conditionType = 'eq'): self
    {
        return $this;
    }
}

/**
 * @extends Abstract_Collection<Model_Delivery>
 */
class Delivery_Collection extends Abstract_Collection
{
    public function addFilter(string $field, mixed $value, string $conditionType = 'eq'): self
    {
        return $this;
    }
}

class Model_Delivery extends Model_Abstract
{
    /**
     * @throws Exception
     */
    public function doSomething(string $thing): DateTimeInterface
    {
        return new DateTime($thing);
    }
}
