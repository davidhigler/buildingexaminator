<?php

namespace App\Bag\Application\Arcgis;

use Exception;
use Throwable;

class ArcgisException extends Exception
{
    public function __construct($message = null, $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function __toString(): string
    {
        $message = __CLASS__ . ": {$this->message}";
        if ($this->getPrevious() !== null) {
            $message .= " {" . $this->getPrevious()->getMessage() . "}";
        }
        $message .= "\n";

        return $message;
    }
}