<?php


namespace Core\Requests;


use App\Core\Requests\AbstractRequestInterface;
use Illuminate\Foundation\Http\FormRequest;

abstract class AbstractRequest extends FormRequest implements AbstractRequestInterface
{

}
