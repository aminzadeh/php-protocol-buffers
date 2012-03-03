<?php

namespace protobuf;

class Mapper
{
    public function fromArray(object $object, array $data)
    {
        foreach ($data as $field => $value) {
            if (property_exists($object, $field)) {
                $object->$field = $value;

            } else {
                $setter = 'set' . ucfirst($field);
                if (method_exists($object, $setter)) {
                    $object->$setter($value);
                }
            }
        }
    }

    /**
     * @param object $object
     * @return array
     */
    public function toArray(object $object)
    {
        $data = array();
        foreach ($object as $field => $value) {
            $data[$field] = $value;
        }
        return $data;
    }
}

