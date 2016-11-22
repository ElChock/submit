/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


    var listRazon="";
    var listDenuncia="";
    var html1="";

$(document).ready(function()
{
    

    LlamarRazon();


    
});
function LlamarRazon ()
{
    $.ajax({
    type:"get",
    url:"../Controller/ControllerRazon.php?razon=1",
    async:false,
    contentType: "application/json; charset=utf-8",
    dataType: 'json',
    success:function(data)
        {
            listRazon=data;
            LlamarDenuncia();           
        } 
    });
}
    
    function LlamarDenuncia()
    {
        $.ajax({
        type:"get",
        url:"../Controller/ControllerDenuncia.php?denuncia=5",
        async:false,
        contentType: "application/json; charset=utf-8",
        dataType: 'json',
        success:function(data)
            {
                listDenuncia=data;
                ImprimirDenuncia();
            }
        });
    }
    
    function ImprimirDenuncia()
    {
     
        for(var i=0;i<listDenuncia.length;i++)
        {
            html1+="<li class=PostDenuncia><div class=PerfilPost>";
            html1+="<a class=ProfilePicturePost><img src=data:image/jpeg;base64,"+listDenuncia[i].usuario.fotoPerfil+" alt=Profile Picture></a>";
            html1+="<p class=NombrePerfilPost>"+listDenuncia[i].usuario.nombre+"</p></div>";
            html1+="<p class=TituloPost>"+ listDenuncia[i].publicacion.titulo +"</p>";
            if(listDenuncia[i].publicacion.tipoContenido =="mp4")
            {
                html1+="<video controls><source src="+ listDenuncia[i].publicacion.path +" type=video/mp4> Este browser no acepta videos</video>";
            }
            else
            {
                html1+="<img src="+listDenuncia[i].publicacion.path+" alt=Publicacion>";
            }
            html1+="<div class=FormulacioDenuncia><form action=../Controller/ControllerDenuncia.php method=post ><label>Razon</label>";
            html1+="<select name=razon >";
            for(var j=0;j<listRazon.length;j++)
            {
                html1+="<option value="+listRazon[j].idRazon+" >"+listRazon[j].descripcion+"</option>";
            }
            html1+="</select>";
            html1+="<input type=hidden name=idUsuario value="+listDenuncia[i].publicacion.idUsuario+" >";
            html1+="<input type=hidden name=idPublicacion value="+listDenuncia[i].publicacion.idPublicacion+" >";
            html1+="<label>Bloquear hasta</label><input type=date name=fecha id=Salto ><label>Bloquear permanentemente</label><input type=checkbox value=s name=permanente ><input type=text name=comentario placeholder=Comentario min=3 max=200><input type=submit name=bloquear value=Bloquear><input type=submit name=rechazar value=Rechazar></form></div></li>";
            
            
            $(html1).appendTo("#denuncia");
            html1="";
        }
        
           
    }