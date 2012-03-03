<?php

return array(
    'sequence' => 'Nb',
    'namespace' => 'foo\bar',
    'type' => 'message',
    'name' => 'Person',
    'data' => array(
        array(
            'tag' => 1,
            'rule' => 'required',
            'type' => 'string',
            'name' => 'name',
        ),

        array(
            'tag' => 2,
            'rule' => 'required',
            'type' => 'int32',
            'name' => 'id',
        ),

        array(
            'tag' => 3,
            'rule' => 'optional',
            'type' => 'string',
            'name' => 'email',
        ),

        array(
            'type' => 'enum',
            'name' => 'PhoneType',
            'data' => array(
                'MOBILE' => 0,
                'HOME' => 1,
                'WORK' => 2,
            ),
        ),

        array(
            'type' => 'message',
            'name' => 'PhoneNumber',
            'data' => array(
                array(
                    'tag' => 1,
                    'rule' => 'required',
                    'type' => 'string',
                    'name' => 'number',
                ),

                array(
                    'tag' => 2,
                    'tule' => 'optional',
                    'type' => 'PhoneType',
                    'name' => 'type',
                    'opts' => array(
                        'default' => 'HOME',
                    ),
                ),
            ),
        ),

        array(
            'tag' => 4,
            'rule' => 'repeated',
            'type' => 'PhoneNumber',
            'name' => 'phone',
        ),
    ),
);