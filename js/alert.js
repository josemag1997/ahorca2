
        function myFunction() {
            
                document.getElementById("myText").disabled = false;
                
        }



    var inicio=0;
    var timeout=0;
 
    function empezarreiniciar(elemento) {
        if(timeout==0)
        {
            // empezar el cronometro
 
            elemento.value="Reiniciar";
 
            // Obtenemos el valor actual
            inicio=new Date().getTime();
 
            // Guardamos el valor inicial en la base de datos del navegador
            localStorage.setItem("inicio",inicio);
 
            // iniciamos el proceso
            funcionando();
            myFunction();
        }else{
            // detemer el cronometro
 
            elemento.value="Empezar";
            clearTimeout(timeout);
        
            // Eliminamos el valor inicial guardado
            localStorage.removeItem("inicio");
            timeout=0;
            //myFunction1();
            window.location.reload(); 
            myFunction();

        }

           
    }

     function stop(){
            clearTimeout(timeout);
        
            // Eliminamos el valor inicial guardado
            localStorage.removeItem("inicio");
            timeout=0;
            clearTimeout(timeout);
            clearTimeout(inicio);
            

        }
 
    function funcionando()
    {
        // obteneos la fecha actual
        var actual = new Date().getTime();
 
        // obtenemos la diferencia entre la fecha actual y la de inicio
        var diff=new Date(actual-inicio);
 
        // mostramos la diferencia entre la fecha actual y la inicial
        var result=LeadingZero(diff.getUTCHours())+":"+LeadingZero(diff.getUTCMinutes())+":"+LeadingZero(diff.getUTCSeconds());
        document.getElementById('crono').innerHTML = result;
 
        // Indicamos que se ejecute esta función nuevamente dentro de 1 segundo
        timeout=setTimeout("funcionando(); myFunction();",1000);

        if (diff.getUTCMinutes()==2) {
            alert("Acabo tú Tiempo.");
            stop();
            
                document.getElementById("myText").disabled;
            

        }
    }
 
    /* Funcion que pone un 0 delante de un valor si es necesario */
    function LeadingZero(Time)
    {
        return (Time < 10) ? "0" + Time : + Time;
    }
 
    window.onload=function()
    {
        if(localStorage.getItem("inicio")!=null)
        {
            // Si al iniciar el navegador, la variable inicio que se guarda
            // en la base de datos del navegador tiene valor, cargamos el valor
            // e iniciamos el proceso.
            if (inicio==2) {alert("hola");}
            inicio=localStorage.getItem("inicio");
            document.getElementById("boton").value="Reiniciar";
            funcionando();
        }
    }

function perder() {
    alert('¡Has perdido!'); 
    clearTimeout(timeout);

    clearTimeout(inicio);
    


}

function gnast(){
alert('Felicidades has ganado');

            clearTimeout(timeout);

}