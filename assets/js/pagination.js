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
$(window).scroll(Paginate());



function Paginate()
{
    var page_id;
    
    (page_id === undefined)?page_id = 1:page_id++;
    
    var page = ["/project", "/post"];
    
    page.forEach(function(p)
    {
        console.log(p);
        if(window.location.href.indexOf(window.location.host + p ) > -1 )
        {
            if($(window).scrollTop() + $(window).height() > $(document).height() - 50) 
            {
                $.post( p + "/getpaginated/" + page_id++ + "/10", function(result){console.log(result);} );
            }
        }
    });
    
};