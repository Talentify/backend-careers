<?php
namespace Admin\Helper;

use Laminas\Mvc\Controller\Plugin\AbstractPlugin;

class FormatValue extends AbstractPlugin
{
    // Currency
    const _currencySymbol = 'R$';
    const _currencyNumDecimals = 2;
    const _currencySeparatorDec = ',';
    const _currencySeparatorMil = '.';

    // Date
    const _dateFormatToView = 'd/m/Y';
    const _dateFormatToSave = 'Y-m-d';

    // Hour
    const _hourFormatToView = 'H:i';
    const _hourFormatToSave = 'H:i:s';

    // DateTime
    const _dateTimeFormatToView = 'd/m/Y H:i:s';
    const _dateTimeFormatToViewSe = 'd/m/Y H:i';
    const _dateTimeFormatToSave = 'Y-m-d H:i:s';

    const DAYS_WEEK = [
        0 => 'Domingo',
        1 => 'Segunda-feira',
        2 => 'Terça-feira',
        3 => 'Quarta-feira',
        4 => 'Quinta-feira',
        5 => 'Sexta-feira',
        6 => 'Sabádo',
    ];

    public static function mask($val, $mask){
        $maskared = '';
        $k = 0;
        for($i = 0; $i<=strlen($mask)-1; $i++)
        {
            if($mask[$i] == '#')
            {
                if(isset($val[$k]))
                    $maskared .= $val[$k++];
            }
            else
            {
                if(isset($mask[$i]))
                    $maskared .= $mask[$i];
            }
        }
        return $maskared;
    }

    public static function formatCpfCnpj($value, $html = false){
        if (empty($value)){
            return ($html ? '<br>' : '');
        }

        if (strlen($value) == 11){
            return self::mask($value,'###.###.###-##');
        }

         return self::mask($value,'##.###.###/####-##');
    }

    public static function formatCep($value){
        if (intval($value)){
            $value = strval($value);
        }
        return self::mask($value,'#####-###');
    }

    public static function formatTelefone($value){
        if (empty($value)){
            return '';
        }

        if (strlen($value) == 10){
            return self::mask($value,'(##) ####-####');
        }

        return  self::mask($value,'(##) #####-####');
    }

    public static function formatCurrencyToView($value,$showSymbol = true) {
        if (empty($value))
            $value = 0;

        if ($showSymbol){
            return self::_currencySymbol . ' ' . number_format ( $value, self::_currencyNumDecimals, self::_currencySeparatorDec, self::_currencySeparatorMil );
        }

        return number_format ( $value, self::_currencyNumDecimals, self::_currencySeparatorDec, self::_currencySeparatorMil );
    }

    public static function formatDecimalToSave($value) {
        if (strpos ( $value, "R$" ) !== false) {
            return self::formatCurrencyToSave ( $value );
        } else if (strpos ( $value, "," ) !== false) {
            $valueFormat = str_replace ( '.', '', $value );
            $valueFormat = str_replace ( ',', '.', $valueFormat );
            return ( float ) $valueFormat;
        }

        return ( float ) $value;
    }

    public static function formatCurrencyToSave($value) {
        if (empty($value)) {
            return $value;
        }

        if (strpos($value, ',') === false){
            return $value;
        }

        $value = str_replace ( self::_currencySymbol, '', $value );
        $value = str_replace ( '.', '', $value );
        $value = str_replace ( ',', '.', $value );
        $value = str_replace ( ' ', '', $value );
        return $value;
    }

    public static function formatTimeToSave($value) {
        if (!empty($value)) {
            return $value;
        }

        return new \DateTime ( $value );
    }

    public static function formatTimeToView($value, $showSeconds = true) {
        if (empty ( $value )) {
            return '';
        }

        if ($value instanceof \DateTime) {
            if ($showSeconds){
                return $value->format ( self::_hourFormatToSave);
            }

            return $value->format ( self::_hourFormatToView);
        }

        throw new \Exception ( 'A data informada precisa ser um objeto do tipo DateTime.' );
    }

    public static function formatDateToView($value, $isDate = true) {
        if (!$isDate){
            return date('d/m/Y', strtotime($value));
        }

        if (empty($value)) {
            return '';
        }

        if ($value instanceof \DateTime) {
            return $value->format ( self::_dateFormatToView );
        }

        throw new \Exception ( 'A data informada precisa ser um objeto do tipo DateTime.' );
    }

    public static function formatDateToSave($value, $isDate = true) {
        if (empty($value)){
            return '';
        }

        $ex = explode('-', $value);
        if (count($ex) == 3){
            if ($isDate){
                return new \DateTime ( $value );
            }

            return $value;
        }

        $value = str_replace ( ' ', '', $value );
        $date = substr ( $value, 6, 4 );
        $date .= '-' . substr ( $value, 3, 2 );
        $date .= '-' . substr ( $value, 0, 2 );

        if ($isDate){
            return new \DateTime ( $date );
        }

        return $date;
    }

    public function formatDateToSaveSemDateTime($value) {
        $value = str_replace ( ' ', '', $value );
        $date = substr ( $value, 6, 4 );
        $date .= '-' . substr ( $value, 3, 2 );
        $date .= '-' . substr ( $value, 0, 2 );
        return $date;
    }

    public static function formatDateTimeToView($value, $showSeconds = true) {
        if (empty ( $value )) {
            return '';
        }

        if ($value instanceof \DateTime) {
            if ($showSeconds){
                return $value->format (self::_dateTimeFormatToView );
            }else{
                return $value->format ( self::_dateTimeFormatToViewSe );
            }
        }

        throw new \Exception ( 'A data informada precisa ser um objeto do tipo DateTime.' );
    }

    public static function formatDateTimeToSave($value, $isDate = true) {
        if (empty($value)){
            return $value;
        }

        $ex = explode('-', $value);
        if (count($ex) == 3){
            return new \DateTime ( $value );
        }

        $date = substr ( $value, 6, 4 );
        $date .= '-' . substr ( $value, 3, 2 );
        $date .= '-' . substr ( $value, 0, 2 );
        $date .= ' ' . substr ( $value, 11, 8 );
        if ($isDate){
            return new \DateTime ( $date );
        }
        return $date;
    }

    public function formatDateTimeToSaveString($value) {
        if (empty ( $value )) {
            return '';
        }

        if ($value instanceof \DateTime) {
            return $value->format ( self::_dateTimeFormatToSave );
        }

        throw new \Exception ( 'A data informada precisa ser um objeto do tipo DateTime.' );
    }

    public function formatDateTimeToSaveSemDateTime($value)
    {
        if (!empty ($value)) {
            $date = substr($value, 6, 4);
            $date .= '-' . substr($value, 3, 2);
            $date .= '-' . substr($value, 0, 2);
            $date .= ' ' . substr($value, 11, 8);
            return $date;
        } else {
            return $value;
        }
    }

    public static function formatDate($date, $outputFormat) {
        if ($date instanceof \DateTime) {
            return $date->format($outputFormat);
        }

        return date($outputFormat, strtotime($date));
    }

    public static function formatHourToView($date, $showSeconds = false, $isTime = true) {
        if (empty ( $date )) {
            return '00:00';
        }

        if (!$isTime){
            if ($showSeconds){
                return date('H:i:s', strtotime($date));
            }

            return date('H:i', strtotime($date));
        }

        if ($date instanceof \DateTime) {
            if ($showSeconds) {
                return $date->format(self::_hourFormatToSave );
            }

            return $date->format (self::_hourFormatToView);
        }

        throw new \Exception ( 'A data informada precisa ser um objeto do tipo DateTime.' );
    }

    public static function cleanField($field, array $characters = array()) {
        $search = array (
            '.',
            '-',
            '/',
            '\\',
            '(',
            ')',
            ' '
        );

        if (count ( $characters )) {
            foreach ( $characters as $character ) {
                $search [] = $character;
            }
        }

        $field = str_replace ( $search, '', $field );
        return $field;
    }

    public function formatDecimal($value, $numDec = null, $sepDec = null, $sepMil = null) {
        if (empty ( $numDec ))
            $numDec = self::_currencyNumDecimals;

        if (empty ( $sepDec ))
            $sepDec = self::_currencySeparatorDec;

        if (empty ( $sepMil ))
            $sepMil = self::_currencySeparatorMil;

        return number_format ( $value, $numDec, $sepDec, $sepMil );
    }

    public static function formatDecimalNoMil($value, $numDec = null, $sepDec = null) {
        if (empty ( $numDec ))
            $numDec = self::_currencyNumDecimals;

        if (empty ( $sepDec ))
            $sepDec = self::_currencySeparatorDec;

        return number_format ( $value, $numDec, $sepDec ,'');
    }

    public static function floatVal($value) {
        return floatval(number_format($value, 2,'.', ''));
    }

    public function valorPorExtenso( $valor = 0, $bolExibirMoeda = true, $bolPalavraFeminina = false )
    {

        $valor = self::formatCurrencyToSave( $valor );

        $singular = null;
        $plural = null;

        if ( $bolExibirMoeda )
        {
            $singular = array("centavo", "real", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
            $plural = array("centavos", "reais", "mil", "milhões", "bilhões", "trilhões","quatrilhões");
        }
        else
        {
            $singular = array("", "", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
            $plural = array("", "", "mil", "milhões", "bilhões", "trilhões","quatrilhões");
        }

        $c = array("", "cem", "duzentos", "trezentos", "quatrocentos","quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos");
        $d = array("", "dez", "vinte", "trinta", "quarenta", "cinquenta","sessenta", "setenta", "oitenta", "noventa");
        $d10 = array("dez", "onze", "doze", "treze", "quatorze", "quinze","dezesseis", "dezesete", "dezoito", "dezenove");
        $u = array("", "um", "dois", "três", "quatro", "cinco", "seis","sete", "oito", "nove");


        if ( $bolPalavraFeminina )
        {

            if ($valor == 1)
            {
                $u = array("", "uma", "duas", "três", "quatro", "cinco", "seis","sete", "oito", "nove");
            }
            else
            {
                $u = array("", "um", "duas", "três", "quatro", "cinco", "seis","sete", "oito", "nove");
            }


            $c = array("", "cem", "duzentas", "trezentas", "quatrocentas","quinhentas", "seiscentas", "setecentas", "oitocentas", "novecentas");


        }


        $z = 0;

        $valor = number_format( $valor, 2, ".", "." );
        $inteiro = explode( ".", $valor );

        for ( $i = 0; $i < count( $inteiro ); $i++ )
        {
            for ( $ii = strlen( $inteiro[$i] ); $ii < 3; $ii++ )
            {
                $inteiro[$i] = "0" . $inteiro[$i];
            }
        }

        // $fim identifica onde que deve se dar junção de centenas por "e" ou por "," ;)
        $rt = null;
        $fim = count( $inteiro ) - ($inteiro[count( $inteiro ) - 1] > 0 ? 1 : 2);
        for ( $i = 0; $i < count( $inteiro ); $i++ )
        {
            $valor = $inteiro[$i];
            $rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
            $rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
            $ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";

            $r = $rc . (($rc && ($rd || $ru)) ? " e " : "") . $rd . (($rd && $ru) ? " e " : "") . $ru;
            $t = count( $inteiro ) - 1 - $i;
            $r .= $r ? " " . ($valor > 1 ? $plural[$t] : $singular[$t]) : "";
            if ( $valor == "000")
                $z++;
            elseif ( $z > 0 )
                $z--;

            if ( ($t == 1) && ($z > 0) && ($inteiro[0] > 0) )
                $r .= ( ($z > 1) ? " de " : "") . $plural[$t];

            if ( $r )
                $rt = $rt . ((($i > 0) && ($i <= $fim) && ($inteiro[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " e ") : " ") . $r;
        }

        $rt = substr( $rt, 1 );

        return($rt ? trim( $rt ) : "zero");

    }
}
