/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


    $( ".emirate-name" ).click(function() {
        var val = $(this).val();
         $(".brand-name").closest('button').addClass("active");
    $.ajax({  
    type: 'GET',  
    url: 'index.php?r=emirates/store', 
    data: { id: val },
    success: function(response) {
       $('#store-details').html(response);
      
    }
});
    });
    
    $(".brand-name").click(function(){
        var val=$(this).val();
        $(this).toggleClass("active");
        if(val==1)
        $(".smartbaby").toggleClass("btn-disable");
        if(val==3)
        $(".eternity").toggleClass("btn-disable");
        
    });