/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(".promotion").click(function(){
    var val=$(this).val();
    var cls='promotion'.concat(val);
    $('.'+cls).toggle();
});

