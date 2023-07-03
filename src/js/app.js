document.addEventListener('DOMContentLoaded', function(){
    eventListeners();
    darkMode();
});


const eventListeners = ()=>{

    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click',responsiveNavigation);
}

const responsiveNavigation = ()=>{
    
    const navegation = document.querySelector('.navegation');

      /* 
      if(navegation.classList.contains('show')) {
        
          navegation.classList.remove('show');
      }else{
        navegation.classList.add('show');
      }*/
      navegation.classList.toggle('show');
}


const darkMode = ()=>{

    //--------CAMBIAR AL MODO OSUCRO SEGUN LO CONF DEL SISTEMA OPERATIVO
    const  darkModePreference = window.matchMedia('(prefers-color-scheme: dark)');

        if(darkModePreference.matches){
             document.body.classList.add('dark-mode');
        }else{
             document.body.classList.remove('dark-mode');
        }

       darkModePreference.addEventListener('change',function(){
        
 	          if(darkModePreference.matches){
                   document.body.classList.add('dark-mode');
              }else{
                 document.body.classList.remove('dark-mode');
              }
      });
    //------------------------- 
    const darkButton =  document.querySelector('.dark-mode-button');

    darkButton.addEventListener('click',function () {
        document.body.classList.toggle('dark-mode');
    });
}

