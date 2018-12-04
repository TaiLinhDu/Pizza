let listPizza = [
    {
        name : "Pizza Margherita",
        preis : 4.00,
        id : 0
    },
    {
        name : "Pizza Salami",
        preis : 4.5,
        id : 1
    },
    {
        name : "Pizza Hawai",
        preis : 4.5,
        id : 2
    },
    {
        name : "Pizza Casanova",
        preis : 5.5,
        id : 3
    }

];
let Warenkopf = [];
//init infor for pizza;
listPizza.forEach( function (value,index) {
    document.getElementById("pizza-infor-"+index).innerHTML = value.name + "- "+value.preis ;
});

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
    //var thisId=id.replace("button-pizza-","");
    var elementnumberOfOrder = document.getElementById("select-pizza-" + thisId);
    var numberOfOrder =  parseInt(elementnumberOfOrder.options[elementnumberOfOrder.selectedIndex].value);
    var pizzaName = listPizza[thisId].name;
    var pizzaPreis = listPizza[thisId].preis;

    //console.log(document.getElementById("select-pizza-" + thisId).options[numberOfOrder.selectedIndex].value);
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
       CaculationPreisAndUpdateCarts();
   }
}



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
        CaculationPreisAndUpdateCarts();
    }

}

let clearCartsDomId = document.getElementById("warenkorb-leeren");
clearCartsDomId.onclick = function () {
    "use strict";
    Warenkopf = [];
    CaculationPreisAndUpdateCarts();
}
    



