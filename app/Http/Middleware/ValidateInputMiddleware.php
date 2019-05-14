<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/18
 * Time: 下午5:14
 */

namespace App\Http\Middleware;

use Closure;
use App\Support\ValidateRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\ValidationHttpException;


class ValidateInputMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        $actionName = $this->getActionNameFromRequestUse($request);
        $id = $this->getIdInPath($request);

        $validateRule = new ValidateRule();

        $validator = Validator::make($request->all(), $validateRule->getRule($actionName, $id));
        if ($validator->fails()) {
            $result = [];
            $messages = $validator->errors()->toArray();

            if ($messages) {
                foreach ($messages as $field => $errors) {
                    foreach ($errors as $error) {
                        $result[] = [
                            'field' => $field,
                            'value' => $request->get($field),
                            'code' => $error,
                        ];
                    }
                }
            }

            foreach ($result as $v){
                if (! \is_string($v['value'])) {
                    $v['value'] = json_encode($v['value']);
                }
                // $msg[] = $v['field'].'='.$v['value'].','.$v['code'];
                $msg[] = $v['code'].', '.$v['field'].'='.$v['value'];
            }
            throw new ValidationHttpException(implode('; ',$msg));
        }
        //存在则进行验证
        return $next($request);
    }

    protected function getIdInPath($request)
    {
        $segments = $request->segments();

        foreach ($segments as $segment) {
            if (is_numeric($segment)) {
                return intval($segment);
            }
        }

        return '';
    }

    protected function getActionNameFromRequestUse($request)
    {
        //验证入参
        $actionName = $request->route()->getAction()['uses'];
        $actionName  = str_replace(array('App\Http\Controllers\Api\V1\\', 'Controller'), '', $actionName);
        $actionName  = explode('@', $actionName);
        $actionName[0] = lcfirst($actionName[0]);
        $actionName  = implode('.', $actionName);

        return $actionName;
    }

}
