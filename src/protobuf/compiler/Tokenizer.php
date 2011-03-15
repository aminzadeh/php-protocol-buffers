<?php

namespace protobuf\compiler;

/**
 * Parse .proto file into tokens
 */
class Tokenizer
{
    const MESSAGE = 'message';

    const ENUM = 'enum';

    const PACKAGE = 'package';

    const REQUIRED = 'required';

    const OPTIONAL = 'optional';

    const REPEATED = 'repeated';

    const DOUBLE = 'double';

    const FLOAT = 'float';

    const INT32 = 'int32';

    const INT64 = 'int64';

    const UINT32 = 'uint32';

    const UINT64 = 'uint64';

    const SINT32 = 'sint32';

    const SINT64 = 'sint64';

    const FIXED32 = 'fixed32';

    const FIXED64 = 'fixed64';

    const SFIXED32 = 'sfixed32';

    const SFIXED64 = 'sfixed64';

    const BOOL = 'bool';

    const STRING = 'string';

    const BYTES = 'bytes';

    /**
     * @param string $source
     * @return array
     */
    public static function parse($source)
    {
        $source = "<?php\n" . $source;
        $tokens = token_get_all($source);
        unset($tokens[0]);
        return $tokens;
    }
}