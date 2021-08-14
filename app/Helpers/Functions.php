<?php

namespace App\Helpers;

class Functions
{

    public static function corProgresso($progresso){
        if($progresso < 30){
            return "#f46a6a";
        }elseif($progresso < 70){
            return "#f8ed62";
        }else{
            return "#34c38f";
        }
    }

    public static function corDepartamento($departamento){
        switch($departamento){
            case 0:
                return "#8E44AD";
                break;
            case 1:
                return "#6C281A";
                break;
            case 2:
                return "#D35400";
                break;
            case 3:
                return "#2E4053";
                break;
        }
    }

    public static function corJornada($mes){
        switch($mes){
            case 0:
                return "#8E44AD";
                break;
            case 1:
                return "#6C281A";
                break;
            case 2:
                return "#D35400";
                break;
            case 3:
                return "#F4D03F";
                break;
            case 4:
                return "#3498DB";
                break;
            case 5:
                return "#1ABC9C";
                break;
            case 6:
                return "#1E8449";
                break;
        }
    }

    public static function instance()
     {
         return new Functions();
     }

}

?>