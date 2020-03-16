<?php
/**
 * Created by PhpStorm.
 * User: ATIAF
 * Date: 13/02/2018
 * Time: 10:40 ص
 */

namespace App\Http\Requests\API;

use App\Traits\Api\RespondTrait;
use Illuminate\Foundation\Http\FormRequest;

class APIRequest extends FormRequest
{
    use RespondTrait;

    /**
     * Get the proper failed validation response for the request.
     *
     * @param array $errors
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function response(array $errors)
    {
        return $this->respondBadRequest($errors);
    }
}
