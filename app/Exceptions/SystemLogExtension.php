<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/6/4
 * Time: 上午9:43
 */

namespace App\Exceptions;


use Symfony\Component\HttpFoundation\File\Exception\ExtensionFileException;
use Throwable;

class SystemLogExtension extends ExtensionFileException
{

    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
