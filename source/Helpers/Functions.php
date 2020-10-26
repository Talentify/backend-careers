<?php

namespace Source\Helpers;

class Functions
{
    public $validTableDB;
    const  PUBLISHEDJOB    = 'pub';
    const  FINISHEDJOB     = 'fsh';
    const  PAUSEDJOB       = 'psd';
    const  PERMISSIONADMIN = '1';
    const  PERMISSIONUSER  = '3';
    public static $arrayConstantsJobsUser;

    public function formValidateTable($tableRules, $tableData)
    {
        $columnsRequired = [];

        foreach($tableRules as $coluna => $rules){
            foreach($rules as $r){
                if($r['required'] != false){
                    if(empty($tableData[$coluna])){
                        $columnsRequired['Dados Obrigátorios'][] = $coluna;
                    }
                    if(!array_key_exists($coluna, $tableData)){
                        $requiredKeys['Elemento Obrigatório'][] = $coluna;
                    } else {
                        self::typeValidate($r['type'], $tableData[$coluna], $coluna);
                    }
                }
            }
        }

        if(!empty($requiredKeys)){
            self::mountReturnJson($requiredKeys, 'error');
        }

        if(!empty($columnsRequired)){
            self::mountReturnJson(['formValidade' => $columnsRequired], 'error');
        }

        if(!empty($tableRules) || !empty($tableData)){
            self::verefyFinalTable($tableRules, $tableData);
        }

        return true;
    }

    public function setValueType($type, $value)
    {

        switch ($type){
            case 'string':
                return (string)$value;
                break;
            case 'integer':
                return (integer)$value;
                break;
            case 'float':
                return (float)$value;
            case 'bool':
                return (boolean)$value;
                break;
            default:
                return (string)$value;
                break;
        }
    }

    public function typeValidate($type, $value, $element)
    {

        $typeAndRule    = (object)array_combine(['type', 'rule'], explode("|", $type));
        $setValue       = self::setValueType($typeAndRule->type, $value);
        $validateType   = ((gettype($setValue) == $typeAndRule->type) ? true : false);
        $validateRule   = explode("max", $typeAndRule->rule)[1] ?? $typeAndRule->rule;
        $castTyping     = (int)$validateRule ?? (string)$validateRule;

        if($element == 'permission' || $element == 'status'){
            self::validadeValue($value, $element);
        }
        IF($validateRule == 'email'){
            IF(!filter_var($value, FILTER_VALIDATE_EMAIL)){
                self::mountReturnJson(['msg' => "Valor informado em $element, não é compativel"], 'error');
            }
        }

        if(!$validateType && $element != 'status' ){
            self::mountReturnJson(['msg' => "Tipo não compatível com o valor recebido em $element"], 'error');
        }

        if(is_int($castTyping) && $validateRule != 'email' && $validateRule != '*' ){
            if($castTyping < strlen($value)){
                self::mountReturnJson(['msg' => "Tamanho do Valor informado é maior que o aceito em  $element $validateRule"], 'error');
            }
        }
    }

    public function mountReturnJson($message,$status)
    {
        echo json_encode(['status' => $status, $message]);
        exit();
    }

    public function verefyFinalTable($tableModel, $tableDataPost)
    {
        $newTableArray = [];
        foreach($tableDataPost as $coluna => $valor){
            if(!array_key_exists($coluna, $tableModel)){
                unset($tableDataPost[$coluna]);
            } else {
                $newTableArray[$coluna] = $valor;
            }
        }

        $keys = array_keys(array_diff_key($tableModel, $newTableArray));

        foreach($keys as $key){
            $newTableArray[$key] = "";
        }

        array_walk_recursive($newTableArray, function($value, $key) use(&$newTableArray){
            if($key == 'password'){
                $newTableArray[$key] = password_hash($value, PASSWORD_DEFAULT );
            }
        });

        $this->validTableDB = $newTableArray;

    }

    public function getFinalTable()
    {
        return $this->validTableDB;
    }

    public function getConstantsEnum()
    {
        return self::$arrayConstantsJobsUser = [
            self::FINISHEDJOB,
            self::PUBLISHEDJOB,
            self::PAUSEDJOB,
            self::PERMISSIONADMIN,
            self::PERMISSIONUSER
        ];
    }

    public static function validateName($name, $strict = false)
    {
        $constants = self::getConstantsEnum();

        if ($strict) {
            return array_key_exists($name, $constants);
        }

        $keys = array_map('strtolower', array_keys($constants));
        return in_array(strtolower($name), $keys);
    }

    public static function validadeValue($value, $element, $strict = true)
    {
        $values = array_values(self::getConstantsEnum());
        if(!in_array($value, $values, $strict)){
            self::mountReturnJson(['msg' => self::amountLegendError($element)], 'error');
        }
        return true;
    }

    public static function amountLegendError($element)
    {
        $tableErroLegends = [
            'status'     => ", Escolha pub = publicado, fsh = finalizado e psd para pausado ",
            'permission' => ", Escolha 1 = Administrador e 3 = Usuario "
        ];

        return $tableErroLegends[$element];
    }

}