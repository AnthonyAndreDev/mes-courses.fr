/* Fonction menu déroulant pour mobile : */ 

function burger(){


  console.log("Bonjour les amis");

  let iconeBurger=document.getElementById("burger")

  if(iconeBurger.attributes[1].value="/assets/img/logo_burger.svg") {
    iconeBurger.attributes[1].value="/assets/img/logo_cross.svg"
  }

  console.log(iconeBurger.attributes[1].value);

}