<?php

    ## Функция для вывода содержимого переменной
// Распечатывает дамп переменной на экран
    public static function var_dump($obj)
    {
        echo
        "<pre>",
        self::dumperGet($obj),
        //htmlspecialchars(self::dumperGet($obj)),
        "</pre>";
    }

// Возвращает строку - дамп значения переменной в древовидной форме
// (если это массив или объект). В переменной $leftSp хранится
// строка с пробелами, которая будет выводиться слева от текста.
    public static function dumperGet(&$obj)
    {
        //$preObj = "\"<text style=\"color:#ff0000\">" . $obj . "</text>\"";
        if (is_array($obj)) {
            $type = "Array[" . count($obj) . "]";
        } elseif (is_object($obj)) {
            $type = "Object (" . get_class($obj) . ")" ;
        } elseif (gettype($obj) == "boolean") {
            return $obj ? "true" : "false";
        } else {
            return $obj;
        }
        //<text style="color:#ff0000">$obj</text>
        $buf = $type;

        for (Reset($obj); list($k, $v) = each($obj);) {
            if ($k === "GLOBALS") continue;
            $buf .= "\n'$k' => " . gettype(self::dumperGet($v)) .  " \"<text style=\"color:#ff0000\">" . self::dumperGet($v) . "</text>\"" ;
        }
        return $buf;
    }
