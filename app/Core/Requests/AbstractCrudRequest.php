<?php


namespace Core\Requests;


use App\Core\Requests\AbstractRequestInterface;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use RuntimeException;

abstract class AbstractCrudRequest extends FormRequest implements AbstractCrudRequestInterface, AbstractRequestInterface
{
    /**
     * @inheritDoc
     **/
    protected function createDefaultValidator(ValidationFactory $factory)
    {
        return $factory->make(
            $this->validationData(),
            $this->container->call([$this, $this->getDefaultValidationRuleMethodName()]),
            $this->messages(),
            $this->attributes()
        );
    }

    public function getDefaultValidationRuleMethodName(): string
    {
        /**
         * a variavel controller armazena a assinatura do metodo declarada na rota
         * Ex: App\\Http\\Controller\\Controller@create
         **/
        $controller = $this->getRouteResolver()->call($this)->action['controller'];
        /**
         * a variavel method armazena o metodo à ser chamado
         * Ex: create
         **/
        $method = Str::of($controller)->afterLast('@') . '';

        $method = $this->getValidatorMethodForControllerAction($method);
        if (method_exists($this, $method)) {
            return $method;
        }
        /** Caso não haja um validador com nome informado estora excessão**/
        throw new RuntimeException('No validator method found', 500);
    }

    /**
     * Função para retornar o metodo para validação da action do contorller
     * @param $method
     * @return string
     */
    public function getValidatorMethodForControllerAction($method): ?string
    {
        switch ($method) {
            case 'getOne':
                return 'getGetOneRules';
            case 'saveOne':
                return 'getSaveOneRules';
            case 'updateOne':
                return 'getUpdateOneRules';
            case 'deleteOne':
                return 'getDeleteOneRules';
            default:
                return 'rules';
        }
    }

    public function validateID($id)
    {
        $model = $this->getModel();
        $modelKeyName = $model->getKeyName();

        /**
         * foi definido uuid como tipo da chave então sempre validaremos o formato do uuid
         * caso seja necessário personalização basta sobrescrever o metodo. contrata noiz
         */
        if (!Str::isUuid($id)) {
            throw ValidationException::withMessages([$modelKeyName => 'Invalid UUID format']);
        }

        /**
         * Usando DI do laravel
         */
        $factory = app(ValidationFactory::class);


        $factory->validate(
            [$modelKeyName => $id],
            [$modelKeyName => 'required|exists:' . $model->getTable()]
        );
        return $id;
    }
}
