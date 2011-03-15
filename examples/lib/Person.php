<?php

namespace foo\bar
{
    use foo\bar\Person\PhoneNumber;

    class Person
    {
        /**
         * @var string
         */
        public $name;

        /**
         * @var int
         */
        public $id;

        /**
         * @var string
         */
        public $email;

        /**
         * @var array {@link PhoneNumber}
         */
        public $phoneNumber = array();
    }
}

namespace foo\bar\Person
{
    class EnumPhoneType
    {
        const MOBILE = 0;

        const HOME = 1;

        const WORK = 2;
    }

    class PhoneNumber
    {
        /**
         * @var string
         */
        public $number;

        /**
         * @var int
         */
        public $phoneType = EnumPhoneType::HOME;
    }
}