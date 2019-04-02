//Init value for Bestellung--------------------------------------------------------------------------------------------
let listPizza = [
    {
        name : "Pizza Margherita",
        preis : 4.00,
        id : 1
    },
    {
        name : "Pizza Salami",
        preis : 4.5,
        id : 2
    },
    {
        name : "Pizza Hawai",
        preis : 4.5,
        id : 3
    },
    {
        name : "Pizza Casanova",
        preis : 5.5,
        id : 4
    }

];
//get Value warenkorb from Cookie and update Design
let Warenkopf = readCookie("warenkorb");
console.log(typeof Warenkopf);
if (Warenkopf == null || Warenkopf == ""){
    Warenkopf = [];
}else{
    if(!(Warenkopf instanceof Object)){
    Warenkopf = JSON.parse(Warenkopf);
    }
    console.log(typeof Warenkopf);
    console.log(Warenkopf);
    CaculationPreisAndUpdateCarts();
}

let address = {
    firstName : document.getElementById("firstname").value,
    lastName : document.getElementById("lastname").value,
    streetName : document.getElementById("street-name").value,
    streetNumber : document.getElementById("street-number").value,
    postcode : document.getElementById("postcode").value,
    city : document.getElementById("city").value
};
//init infor for pizza
listPizza.forEach( function (value,index) {
    document.getElementById("pizza-infor-"+(index+1)).innerHTML = value.name + "- "+value.preis ;
});

function UpdateAddressInfor() {
    "use strict";
    address = {
        firstName : document.getElementById("firstname").value,
        lastName : document.getElementById("lastname").value,
        streetName : document.getElementById("street-name").value,
        streetNumber : document.getElementById("street-number").value,
        postcode : document.getElementById("postcode").value,
        city : document.getElementById("city").value
    };
    console.log(address.city);
}

function CaculationPreisAndUpdateCarts(){
    "use strict";
    var sumPreis = 0.00;
    var warenkorb =  document.getElementById("waren-korb");
    warenkorb.options.length = 0;
    Warenkopf.forEach(function(value){
        sumPreis += value.preis;
        var option = document.createElement("option");
        option.value = value.id;
        option.text = value.name +" X "  + value.numberOfOrder;
        warenkorb.add(option);
    });
    document.getElementById("total-preis").innerHTML = sumPreis;
}

function setWareninKopf(thisDom){
    "use strice";
    var thisId = thisDom.dataset.id;
    var elementnumberOfOrder = document.getElementById("select-pizza-" + thisId);
    var numberOfOrder =  parseInt(elementnumberOfOrder.options[elementnumberOfOrder.selectedIndex].value);
    var pizzaName = listPizza[thisId-1].name;
    var pizzaPreis = listPizza[thisId-1].preis;

   if(numberOfOrder > 0){
       let isWareExist = false;
       Warenkopf.forEach(function (value,index) {
           if(value.id == thisId){
               value.preis += (pizzaPreis * numberOfOrder);
               value.numberOfOrder += numberOfOrder;
               isWareExist = true;
           }
       });
       if(!isWareExist) {
           Warenkopf.push(
               {
                   name: pizzaName,
                   numberOfOrder: numberOfOrder,
                   preis: pizzaPreis * numberOfOrder,
                   id: thisId
               }
           );
       }
       setWarenkorbInCookie();
       CaculationPreisAndUpdateCarts();
   }
}


//delete one gute
let throwOneGoodDomId = document.getElementById("pizza-entwerden");
throwOneGoodDomId.onclick = function (){
    let warenkorb =  document.getElementById("waren-korb");
    let selectedOptionValue = warenkorb.options[warenkorb.selectedIndex];
    console.log(selectedOptionValue);
    console.log(warenkorb.selectedIndex);
    if(selectedOptionValue == null || selectedOptionValue == undefined) {
        alert("please choose one pizza to throw away!");
    }else{
        let wareId = warenkorb.options[warenkorb.selectedIndex].value;
        let wareIndexInWarenkorb = 0;
        Warenkopf.forEach(function (elem,index){
            if(elem.id == wareId){
                wareIndexInWarenkorb = index;
            }
        });
        Warenkopf.splice(wareIndexInWarenkorb,1);
        setCookie("warenkorb",Warenkopf)
        CaculationPreisAndUpdateCarts();
    }

};
// delete all warenkorb
let clearCartsDomId = document.getElementById("warenkorb-leeren");
clearCartsDomId.onclick = function () {
    "use strict";
    Warenkopf = [];
    setCookie("warenkorb","");
    CaculationPreisAndUpdateCarts();
};

//check address before send to server
function checkValidAddress (){
    "use strict";
    UpdateAddressInfor();
    if(address.firstName.value == "" || address.lastName.value == "" || address.streetName.value == "" || address.streetNumber == "" || address.postcode.value == "" || address.city.value == ""){
        return false;
    }
    return true;
}

//Button Senden --------------------------------------------------------------------------------------------------------
var sendenButton = document.getElementById("senden");
sendenButton.onclick = function (){
    "use strict";
    if(Warenkopf.length != null && checkValidAddress()){
        //POST via Ajax
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                if(this.responseText === "OK"){
                    setCookie("warenkorb","");
                    alert("Bestellung successfully!!");
                } else {
                    alert("Bestellung unsuccessfully!!");
                }
                
            }
        };
        xhttp.open("POST","PutToDb.php");
        //need Header type to give the php datei infor abour this information
        xhttp.setRequestHeader("Content-Type", "application/json");
        var data = {
            warenkorb : Warenkopf,
            address : address
        }
        var dataJson  = JSON.stringify(data);
        xhttp.send(dataJson);
    }else{
        alert("please fill all of informations !!");
    }
};

//delete eingabe
let deleteAllInputButton = document.getElementById("delete-input");
deleteAllInputButton.onclick = function () {
    "use strict";
    setCookie("warenkorb","");
    location.reload(true);
}
//COOKIE ----------------------------------------------------------------------------------------------------------------
function setCookie(name, value) {
    "use strict";
    var cookie = [
        name,
        '=',
        JSON.stringify(value),
        ";"
    ].join('');
    document.cookie = cookie;
    console.log(document.cookie);
}

function readCookie(name) {
    "use strict";
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0) {
            return JSON.parse(
                c.substring(nameEQ.length, c.length)
            );
        }
    }
    return null;
}

function setWarenkorbInCookie(){
    var warenkorbJson = JSON.stringify(Warenkopf);
    setCookie("warenkorb",warenkorbJson);
}
