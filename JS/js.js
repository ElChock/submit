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
    
    
 });