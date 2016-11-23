/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



$(document).ready(function ()
 {
    $(".opcionesPublicacionM").click(function ()
    {
        //$(this).hide()("ul").show();
        var ul= $(this).find("#imagenOpciones");
        var img=$(this).find("#opciones");
        ul.removeClass("opcionesPublicacionM").addClass("opcionesPublicacion");
        img.removeClass("opcionesPublicacion").addClass("opcionesPublicacionLista");

        
    });
    
    $(".Notificacion").click(function ()
    {
        var li=$(this).find(".Notificacionli");
        li.toggleClass("Ocultar");
    });
    
    $(".notificacion").click(function ()
    {
        var paramidNotificacion=$(this).attr("idnotificacion");
        $.post("../Controller/ControllerNotificacion.php", {idNotificacion: paramidNotificacion} );
        
    });
    
    
    
    $("p:contains('#')").each(function()
    {
        var parrafo=$(this).text();
        var empieza =(parrafo).indexOf("#");
        var z=empieza;
        var s=(parrafo).slice(empieza,z); 
        var espacio=0;
        while((espacio!==" ")&&(espacio !== ""))
        {
            espacio=(parrafo).slice(z,z+1);
            s=(parrafo).slice(empieza,z); 
            z++;
        }
        
        parrafo=(parrafo).slice(z,(parrafo).length);
        s=(s).slice(1,z);
        var link="<a href=../PHP/BusquedaPublicacion.php?buscar=%23"+s+">#" +s+ "</a>";
        $(this).html(link+" "+parrafo);
        
    });
    
 });