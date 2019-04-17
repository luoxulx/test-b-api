<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/17
 * Time: 下午5:31
 */

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class ValidationHttpException extends HttpException
{
    public function __construct($message = null, \Exception $previous = null, $code = 0)
    {
        if (\is_array($message)){
            $message = json_encode($message,JSON_UNESCAPED_UNICODE);
        }

        parent::__construct(422, $message, $previous, array(), $code);
    }

}
