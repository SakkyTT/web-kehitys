// const myHeading = document.querySelector("h1");
// myHeading.textContent = "Hello World!";

// let myVariable = "Bob";

// // var varVariable = "old syntax";

// /* 

// Montako riviä
// Kommenttia

// NaN -> ei tule numeerista arvoa

// */

// myVariable = "Steve";

// myVariable = myVariable + 15;
// myHeading.textContent = myVariable;

// if(2 === "2"){
//     myHeading.textContent = "ei toimi";
// }
// else if("jotakin" === "muuta"){
//     // code missing
// }

// if(2 == "2"){
//     myHeading.textContent = "toimii";
// }

// ctrl + k + c  comment
// ctrl + k + u  uncomment

// Luodaan funktio, mutta sitä ei ole vielä käytetty.
// Tässä määritellään mitä funktio voi tehdä, mutta sitä pitää erikseen kutsua.
// function multiply(num1, num2){ 
//     let result = num1 * num2;
//     return result;
// }

// alert(multiply(2, 5)); // 10

// alert(multiply(10, "moi")); // Tämä tuottaa arvon: NaN

// document.querySelector("html").addEventListener("click", () =>{
//     alert("Ouch!");
// });


// Viittaus html-dokumentin img-elementtiin.
const myImage = document.querySelector("img");

// Tallennetaan img-elementin onclick propertyyn nuoli funktio.
myImage.onclick = () => {
    // Määritellään mitä nuoli funktio tekee klikatessa.
    // Klikkaus vaihtaa kahden kuvan välillä.
    // otetaan talteen mikä kuva näkyy
    // if(kuvaA){
    //      näytä kuvaB
    // }
    // else{
    //      näytä kuvaA   
    // }

    // Otetaan talteen mikä kuva näkyy ennen clikkausta.
    const mySrc = myImage.getAttribute("src"); 

    // jos sivulla näkyy alkuperäinen kuva
    if(mySrc === "images/firefox-icon.png"){
        // Vaihdetaan kuvan src attribuutti toiseen kuvaan
        myImage.setAttribute("src", "images/firefox2.png");
    }
    else{ // Jos koodi tulee tänne asti, oli kyseessä kuva 2
        myImage.setAttribute("src", "images/firefox-icon.png");
    }
}

// otetaan talteen elementtien button ja h1 viittaukset muuttujiin.
let myButton = document.querySelector("button");
let myHeading = document.querySelector("h1");

// Luodaan funktio, jota voidaan käyttää myöhemmin.
function setUserName(){
    // Luetaan käyttäjältä nimi ja tallennetaan muuttujaan myName
    const myName = prompt("Please enter your name.");
    if(!myName){
        setUserName();
    }else{
        // Tallennetaan käyttäjän syöttämä arvo muistiin selaimeen.
        localStorage.setItem("name", myName);
        myHeading.textContent = `Mozilla is cool, ${myName}`;
        // ? oikealta puolelta, käytä shift myös.
        // ' kelpaa myös heittomerkki
    }
}

// Tarkistetaan onko nimi jo tallessa. Jos ei ole, suoritetaan nimen kysyminen.
if(!localStorage.getItem("name")){
    setUserName(); // Suoritetaan funktio, joka pyytää käyttäjän nimen.
}
// Käyttäjä on jo antanut nimen, haetaan se selaimen muistista.
else{
    // Haetaan nimi.
    const storedName = localStorage.getItem("name");
    // Päivitetään nimi otsikkoon.
    myHeading.textContent = `Mozilla is cool, ${storedName}`;
}

myButton.onclick = () =>{
    setUserName();
}

// Jos käyttäjä peruu nimen syötän, saadaan arvo null.
// null tarkoittaa, että kohdasta puuttuu arvo.

// Jos käyttäjä syöttää tyhjän boxin. Ei tule mitään näkyviin. Koska "".
