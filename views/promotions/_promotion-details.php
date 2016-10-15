<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if($model->promotionDetails){
    foreach($model->promotionDetails as $detail){
        echo '<img src="'.$detail->shop->brand->logo.'">';
        echo $detail->shop->store->name;
        $col="red";
        foreach ($detail->shop->salesignages as $signage){
            
            if($signage->status=="installed"&&($col=="red"||$col=="green")){
                $col="green";
            }
            else{
                $col="orange";
            }
        }
        echo '<span><p style="border-radius: 50%;width: 20px;height: 20px;background-color:'.$col.'" ></p></span>';
    }
}
else{
    echo "no store";
}
?>
