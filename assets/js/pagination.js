/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * This triggers a pagination event when the user is near the bottom of the page.
 * 
 * @author Marc Vouve
 * 
 */
$(window).scroll(function() {
   if($(window).scrollTop() + $(window).height() > $(document).height() - 200) {
       alert("near bottom!");
   }
});