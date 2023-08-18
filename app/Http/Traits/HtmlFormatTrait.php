<?php
namespace App\Http\Traits;
use App\Models\Student;
trait HtmlFormatTrait {
    
    public function formatPrice($price, $bold=true) {
        $price  = explode(".", round($price,2));
        if (!isset($price[1])){
            $price[1] = "00";
        }
        $price[1]=str_pad($price[1],2,'0',STR_PAD_RIGHT);
        $p = ($bold) ? "<span class='font-bold'>" : "<span class='font-base'>";
        $p.=  $price[0]."<sup>".$price[1]."</sup>"; 
        $p.="</span>";
        return $p;
    }
}