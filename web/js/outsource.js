/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){
  var value = $('#mainboards-done_by');
  value.change(function(e){
    if (value.val() === 'out_source') {
      $('#mainboards-out_source_name').show();
    }
    else {
      $('#mainboards-out_source_name').hide();
    }
  })
});