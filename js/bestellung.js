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
    var stringShowListOrder = "";
    var sumPreis = 0.00;
    Warenkopf.forEach(function(value){
        sumPreis += value.preis;
        stringShowListOrder += value.name + " x " + value.numberOfOrder + "<br/>";
    });
    document.getElementById("waren-korb").innerHTML = stringShowListOrder;
    document.getElementById("total-preis").innerHTML = sumPreis;
}

function setWareninKopf(thisDom){
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
    Warenkopf.pop();
    CaculationPreisAndUpdateCarts();
}

let clearCartsDomId = document.getElementById("warenkorb-leeren");
clearCartsDomId.onclick = function () {
    Warenkopf = [];
    CaculationPreisAndUpdateCarts();
}
    



