<?php
namespace Qwerbit\User;

use Response;

class Controller extends \Controller 
{
    /**
     * Основная функция лежит в основе всех остальных ответных функций
     * 
     * Ответ в виде json формата, имеет всебе обезательные boolen поля
     * success,error а также масив сообщений
     * 
     * @param bool $success стутус результата
     * @param array|string $message список сообщений 
     * @param string $alert статус сообщения, возможны значения success|warning|danger
     * 
     * @return Array
     */
    protected function _responseJsonMessage ($success, $message = null, $status = 'danger') 
    {
        
        if (!is_array($message) and $message) 
        {
            $_message = [];
            $_message[] = ['value'=>$message,'status'=>$status];
        }
        else 
        {
            $_message = $message;
        }
        
        return [
            'success'   => ($success) ? true : false, 
            'error'     => ($success) ? false : true, 
            'message'   => $_message
        ];
    }
    
    /**
     * Ответ в виде json формата, имеет всебе обезательные boolen поля
     * success,error а также масив сообщений
     * 
     * @param bool $success стутус результата
     * @param array|string $message список сообщений 
     * @param string $alert статус сообщения, возможны значения success|warning|danger
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseJsonMessage ($success, $message = null, $status = 'danger') 
    {
        $array = $this->_responseJsonMessage($success, $message, $status);
        return Response::json($array);      
    }
    
    /**
     * расширяющея фукция responseJsonMessage добовляет к ответу поле с полями ошибками 
     * 
     * @param bool $success стутус результата
     * @param array $errorFailed поля ошибок
     * @param array|string $message список сообщений 
     * @param string $alert статус сообщения, возможны значения success|warning|danger
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseJsonErrorFailed ($success, array $errorFailed, $message = null, $alert = 'danger') 
    {
        $array = $this->_responseJsonMessage($success, $message, $alert);
        $array['error_input'] = $errorFailed;
        return Response::json($array);      
    }
}