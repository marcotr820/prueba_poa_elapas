document.addEventListener('DOMContentLoaded', (e)=>{
    var w = window;
    //******************************** LOADER
    $(window).on ('load', function (){
        $('#loader').delay(100).fadeOut('slow');
        $('#loader-wrapper').delay(250).fadeOut('slow');
    });

    /**************** Sidebar ***************/
    var titulos = document.querySelectorAll('.titulo');
    titulos.forEach((el)=>{
        el.addEventListener('click', ()=>{
            if(el.nextElementSibling){
                // console.log(el.nextElementSibling);
                el.nextElementSibling.classList.toggle('show');
                el.classList.toggle('show');
            }
        })
    });

    //*************************** aparecer el boton cuando se haga scroll ***************************
    const scrollbtn = document.querySelector('.scroll-top');
    w.addEventListener('scroll', (e)=>{
        const scrollTop = window.pageYOffset|| document.documentElement.scrollTop; /*d.documentElement.scrollTop es la forma estandar valida*/
        // console.log(w.pageYOffset+" : "+d.documentElement.scrollTop); /*cualquiera de estas 2 propiedades no devuelve el scroll que hicimos*/
        if(scrollTop > 90){
            scrollbtn.classList.remove('ocultar-btn');
        } 
        else {
            scrollbtn.classList.add('ocultar-btn');
        }
    });

    //*************************** scrollTop al hacer click en el boton *******************************
    document.addEventListener('click', (e)=>{
        if(e.target.matches('.scroll-top') || e.target.matches('.scroll-top *')) //la segunda condicion activara el scroll para los hijos internos
        {
            w.scrollTo({
                behavior:'smooth', 
                top: 0,
            })
        }
    });

    //======================== EXPANDIR EL MAIN CUANDO SE DE CLICK AL BOTON TOGGLE ========================
    //cambiamos cada click su clase del toggle y del navigation aumentando como una clase active cuando hacemos click en el boton
    const toggle = document.getElementById('toggle');
    toggle.addEventListener('click', (e)=>{
        let toggle = document.querySelector('.toggle');
        let sidebar = document.querySelector('.sidebar');
        let main = document.querySelector('.main');
        toggle.classList.toggle('active');
        sidebar.classList.toggle('active');
        main.classList.toggle('active');
    });

});

