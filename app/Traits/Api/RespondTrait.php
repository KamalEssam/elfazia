<?php
/**
 * Created by PhpStorm.
 * User: ATIAF
 * Date: 07/02/2018
 * Time: 10:55 ص
 */

namespace App\Traits\Api;

use App\Models\Config;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response as IlluminateResponse;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;

trait RespondTrait
{

    /**
     * @var int Status Code.
     */
    protected $statusCode = 200;

    /**
     * Getter method to return stored status code.
     *
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }
    /**
     * Setter method to set status code.
     * It is returning current object
     * for chaining purposes.
     *
     * @param mixed $statusCode
     * @return current object.
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }
    /**
     * Function to return an unauthorized response.
     *
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondUnauthorizedError($message = 'Unauthorized!')
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_UNAUTHORIZED)->respondWithError($message);
    }
    /**
     * Function to return forbidden error response.
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondForbiddenError($message = 'Forbidden!')
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_FORBIDDEN)->respondWithError($message);
    }
    /**
     * Function to return a Not Found response.
     *
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondNotFound($message = 'Not Found')
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_NOT_FOUND)->respondWithError($message);
    }

    /**
     * Function to return a Not Found response.
     *
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondUnprocessableEntity($message = 'Unprocessed Entity Request')
    {
        if(is_array($message))
        {
            $messages = implode(' ', array_flatten($message));
            $message = $messages;
        }
        return $this->setStatusCode(IlluminateResponse::HTTP_UNPROCESSABLE_ENTITY)->respondWithError($message);
    }

    /**
     * Function to return an internal error response.
     *
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondInternalError($message = 'Internal Error!')
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_INTERNAL_SERVER_ERROR)->respondWithError($message);
    }
    /**
     * Function to return a service unavailable response.
     *
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondServiceUnavailable($message = "Service Unavailable!")
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_SERVICE_UNAVAILABLE)->respondWithError($message);
    }

    /**
     * Function to return a bad request response.
     *
     * @param string $message
     * @return mixed
     */
    public function respondBadRequest($message = "Bad Request!")
    {
        if(is_array($message))
        {
            $messages = implode(' ', array_flatten($message));
            $message = $messages;
        }
        return $this->setStatusCode(IlluminateResponse::HTTP_BAD_REQUEST)->respondWithError($message);
    }
    /**
     * Function to return a Gone request response.
     *
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondGoneRequest($message = "Gone Request!")
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_GONE)->respondWithError($message);
    }
    /**
     * Function to return a Conflict request response.
     *
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondConflictRequest($message = "Conflict Request!")
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_CONFLICT)->respondWithError($message);
    }


    /**
     * Function to return a generic response.
     *
     * @param array $data Data to be used in response.
     * @param array $headers Headers to b used in response.
     * @return \Illuminate\Http\JsonResponse
     */
    public function respond($data, $headers = [])
    {

        return Response()->json($data, $this->getStatusCode(), $headers);
    }


    /**
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondWithSuccess($data = [])
    {
        $result = array();
        if ($data instanceof Model) {
            $result['result'] = $data;
        } elseif (is_array($data)) {
            $data = collect($data);
            if (!$data->has("result")) {
                $result['result'] = $data;
            } else {
                $result = $data;
            }

        } elseif($data instanceof Collection) {
            $result['result'] = $data;
        }
        //$data['success'] = true;
        if($this->auth)
        {
            $result['notificationCount'] = User::userNotification($this->user->id ,[0,1],true)->count();
        }
        $result['statusCode'] = $this->getStatusCode();
        $result['statusText'] = Response::$statusTexts[$this->getStatusCode()];
        return $this->respond($result);
    }



    /**
     * Function to return an error response.
     *
     * @param $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondWithError($message)
    {
        return $this->respond([

            'message' => $message,
            //'success' => false,
            'statusCode' => $this->getStatusCode(),
            'statusText' => Response::$statusTexts[$this->getStatusCode()],
        ]);
    }
    /**
     * Function to return an error response validation.
     *
     * @param $errors
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondWithErrorValidation($errors)
    {

        $message = "";
        foreach ($errors as $error) {
            $message .= $error;
            $message .= '\n';
        }

        //return $message;

        return $this->respond([
            'message' => $message,
            //'success' => false,
            'statusCode' => $this->getStatusCode(),
            'statusText' => Response::$statusTexts[$this->getStatusCode()],

        ]);
    }


    /**
     * @param $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondCreated($message)
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_CREATED)
            ->respond([
                'message' => $message
            ]);
    }

}