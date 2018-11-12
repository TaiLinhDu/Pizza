let listPizza = [
    {
        name : "Pizza Margherita",
        preis : 4.00
    },
    {
        name : "Pizza Salami",
        preis : 4.5
    },
    {
        name : "Pizza Hawai",
        preis : 4.5
    },
    {
        name : "Pizza Casanova",
        preis : 5.5
    }

];
let Warenkopf = [];

listPizza.forEach( function (value,index) {
    document.getElementById("pizza-infor-"+index).innerHTML = value.name + "- "+value.preis ;
});

function setWareninKopf(event){
    var thisTextId = event.target.id;
    var thisId=thisTextId.replace("button-pizza-","")
    var elementnumberOfOrder = document.getElementById("select-pizza-" + thisId);
    var numberOfOrder = elementnumberOfOrder.options[elementnumberOfOrder.selectedIndex].value;
    var pizzaName = listPizza[thisId].name;
    var pizzaPreis = listPizza[thisId].preis;

    //console.log(document.getElementById("select-pizza-" + thisId).options[numberOfOrder.selectedIndex].value);
   if(numberOfOrder > 0){
    Warenkopf.push(
        {
            name : pizzaName,
            numberOfOrder : numberOfOrder,
            preis : pizzaPreis * numberOfOrder
        }
    );
       var stringShowListOrder = "";
       var sumPreis = 0.00;
       Warenkopf.forEach(function(value){
           sumPreis += value.preis;
           stringShowListOrder += value.name + " x " + value.numberOfOrder + "<br/>";
       });
       document.getElementById("waren-korb").innerHTML = stringShowListOrder;
       document.getElementById("total-preis").innerHTML = sumPreis;
   }
}


