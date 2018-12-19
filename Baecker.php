<?php	// UTF-8 marker äöüÄÖÜß€
/**
 * Class PageTemplate for the exercises of the EWA lecture
 * Demonstrates use of PHP including class and OO.
 * Implements Zend coding standards.
 * Generate documentation with Doxygen or phpdoc
 *
 * PHP Version 5
 *
 * @category File
 * @package  Pizzaservice
 * @author   Bernhard Kreling, <b.kreling@fbi.h-da.de>
 * @author   Ralf Hahn, <ralf.hahn@h-da.de>
 * @license  http://www.h-da.de  none
 * @Release  1.2
 * @link     http://www.fbi.h-da.de
 */

// to do: change name 'PageTemplate' throughout this file
require_once './Page.php';

/**
 * This is a template for top level classes, which represent
 * a complete web page and which are called directly by the user.
 * Usually there will only be a single instance of such a class.
 * The name of the template is supposed
 * to be replaced by the name of the specific HTML page e.g. baker.
 * The order of methods might correspond to the order of thinking
 * during implementation.

 * @author   Bernhard Kreling, <b.kreling@fbi.h-da.de>
 * @author   Ralf Hahn, <ralf.hahn@h-da.de>
 */
class Baecker extends Page
{
    // to do: declare reference variables for members
    // representing substructures/blocks

    /**
     * Instantiates members (to be defined above).
     * Calls the constructor of the parent i.e. page class.
     * So the database connection is established.
     *
     * @return none
     */
    protected function __construct()
    {
        parent::__construct();
        // to do: instantiate members representing substructures/blocks
    }

    /**
     * Cleans up what ever is needed.
     * Calls the destructor of the parent i.e. page class.
     * So the database connection is closed.
     *
     * @return none
     */
    protected function __destruct()
    {
        parent::__destruct();
    }

    /**
     * Fetch all data that is necessary for later output.
     * Data is stored in an easily accessible way e.g. as associative array.
     *
     * @return none
     */
    protected function getViewData()
    {
        // to do: fetch data for this view from the database
        $getOrderSQLAbfrage = "SELECT * FROM orders";
        $OrdersRecords =$this->_database->query($getOrderSQLAbfrage);
        if(!$OrdersRecords){
            throw new Exception("Kein Orders ist in Datenbank");
        }
        $orders =array();
        if($OrdersRecords){
            $Record = $OrdersRecords ->fetch_assoc();
            while($Record){
                $thisOrder = array();
                $OrderId = $Record["OrderId"];
                //Order status
                $OrderStatus = $Record['OrderStatus'];
                //get All ordered Pizza
                $orderedPizzas = array();
                $orderedPizzasSQL = $this->_database->query("SELECT * FROM orderedpizza WHERE OrderId = $OrderId");
                $RecordOrderedPizza = $orderedPizzasSQL->fetch_assoc();
                While($RecordOrderedPizza){
                    //get Pizza Record
                    $pizzaId = $RecordOrderedPizza["PizzaId"];
                    $numberOfPizza = $RecordOrderedPizza["NumberOfPizza"];
                    $pizzaInformation = $this->_database->query("SELECT *  FROM pizza WHERE PizzaId = $pizzaId");
                    $RecordPizzaInfors = $pizzaInformation->fetch_assoc();
                    $pizzaName = $RecordPizzaInfors["PizzaName"];


                    $thisPizza = array();
                    $thisPizza["pizzaName"] = $pizzaName;
                    $thisPizza["numberOfPizza"] = $numberOfPizza;

                    array_push($orderedPizzas,$thisPizza);

                    $RecordOrderedPizza = $orderedPizzasSQL->fetch_assoc();
                }

                $thisOrder["OrderId"] = $OrderId;
                $thisOrder["OrderStatus"] = $OrderStatus;
                $thisOrder["orderedPizzas"] = $orderedPizzas;
                array_push($orders,$thisOrder);
                $Record = $OrdersRecords->fetch_assoc();
            }
        }
        return $orders;
    }

    /**
     * First the necessary data is fetched and then the HTML is
     * assembled for output. i.e. the header is generated, the content
     * of the page ("view") is inserted and -if avaialable- the content of
     * all views contained is generated.
     * Finally the footer is added.
     *
     * @return none
     */
    protected function generateView()
    {
        $orders = $this->getViewData();
        $this->generatePageHeader('to do: change headline');
        // to do: call generateView() for all members
        // to do: output view of this page
        echo <<<BAECKER
            <section class="infor-form-full">
                <div class="infor-form my-container">
                    <div class="text-center py-2 border-bottom-0">
                        <span class="header-container-text" >Bäcker</span>
                    </div>
BAECKER;
        foreach ($orders as $order){
            $orderId = $order["OrderId"];
            $OrderStatus = (int)$order["OrderStatus"];
            $pizzas = $order["orderedPizzas"];

            echo <<<FORM
                 <form class="text-center" action="#" id="form-kunden" accept-charset="UTF-8" method="post">
                        <div class="flex-container">
                            <div><strong>Bestellung $orderId</strong></div>
                                <div>
FORM;
            foreach ($pizzas as $pizza){
                $pizzaName =  $pizza["pizzaName"];
                $numberOfPizza = $pizza["numberOfPizza"];
                echo <<<PIZZA
                   $pizzaName X $numberOfPizza <br />
PIZZA;
            }
            switch ($OrderStatus){
                case 0:
                    echo <<<INFORMATION
                        </div>
                        <div>
                                    <span style="padding: 2px">Bestellt</span>
                                    <input type="radio" name="OrderStatus" onclick="this.form.submit()" value="Bestellt_$orderId" checked>
                                </div>
                                <div>
                                    Im Ofen
                                    <input type="radio" name="OrderStatus" onclick="this.form.submit()" value="ImOfen_$orderId">
                                </div>
                                <div>
                                    Fertig
                                    <input type="radio" name="OrderStatus" onclick="this.form.submit()" value="Fertig_$orderId">
                                </div>
                              </div>
                        </form>
                
INFORMATION;
                    break;
                case 1:
                    echo <<<INFORMATION
                        </div>
                        <div>
                                    <span style="padding: 2px">Bestellt</span>
                                    <input type="radio" name="OrderStatus" onclick="this.form.submit()" value="Bestellt_$orderId" >
                                </div>
                                <div>
                                    Im Ofen
                                    <input type="radio" name="OrderStatus" onclick="this.form.submit()" value="ImOfen_$orderId" checked>
                                </div>
                                <div>
                                    Fertig
                                    <input type="radio" name="OrderStatus" onclick="this.form.submit()" value="Fertig_$orderId">
                                </div>
                              </div>
                        </form>
INFORMATION;
                    break;
                case 2:
                case 3:
                case 4:
                    echo <<<INFORMATION
                            </div>
                            <div>
                                        <span style="padding: 2px">Bestellt</span>
                                        <input type="radio" name="OrderStatus" onclick="this.form.submit()" value="Bestellt_$orderId" >
                                    </div>
                                    <div>
                                        Im Ofen
                                        <input type="radio" name="OrderStatus" onclick="this.form.submit()" value="ImOfen_$orderId" >
                                    </div>
                                    <div>
                                        Fertig
                                        <input type="radio" name="OrderStatus" onclick="this.form.submit()" value="Fertig_$orderId" checked>
                                    </div>
                                  </div>
                            </form>
INFORMATION;
                    break;

            }


        }
        echo <<<END
                        </div>
            </section>
END;
        $this->generatePageFooter();
    }

    /**
     * Processes the data that comes via GET or POST i.e. CGI.
     * If this page is supposed to do something with submitted
     * data do it here.
     * If the page contains blocks, delegate processing of the
     * respective subsets of data to them.
     *
     * @return none
     */
    protected function processReceivedData()
    {
        parent::processReceivedData();
        // to do: call processReceivedData() for all members
        if( isset($_POST["OrderStatus"])){
            $orderStatusAndOrderId = $_POST["OrderStatus"];
            list($orderStatus,$orderIdStr) = explode('_',$orderStatusAndOrderId);
            if($orderStatus == null || $orderIdStr == null){
                throw new Exception ("Order Status oder Order Id nicht identifiziert !");
            }
            $orderId = (int)$orderIdStr;
            $status = 0;
            if($orderStatus == "ImOfen"){
                $status = 1;
            }else if( $orderStatus == "Fertig"){
                $status = 2;
            }
            $SQLAbfrage = "UPDATE orders SET "." OrderStatus = $status WHERE "." OrderId = $orderId  ";
            $this->_database->query($SQLAbfrage);
        }
    }

    /**
     * This main-function has the only purpose to create an instance
     * of the class and to get all the things going.
     * I.e. the operations of the class are called to produce
     * the output of the HTML-file.
     * The name "main" is no keyword for php. It is just used to
     * indicate that function as the central starting point.
     * To make it simpler this is a static function. That is you can simply
     * call it without first creating an instance of the class.
     *
     * @return none
     */
    public static function main()
    {
        try {
            $page = new Baecker();
            $page->processReceivedData();
            $page->generateView();
        }
        catch (Exception $e) {
            header("Content-type: text/plain; charset=UTF-8");
            echo $e->getMessage();
        }
    }
}

// This call is starting the creation of the page.
// That is input is processed and output is created.
Baecker::main();

// Zend standard does not like closing php-tag!
// PHP doesn't require the closing tag (it is assumed when the file ends).
// Not specifying the closing ? >  helps to prevent accidents
// like additional whitespace which will cause session
// initialization to fail ("headers already sent").
//? >