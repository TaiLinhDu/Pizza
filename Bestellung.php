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
class Bestellung extends Page
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
        $this->getViewData();
        $this->generatePageHeader('to do: change headline');
        // to do: call generateView() for all members
        // to do: output view of this page
        echo <<<BESTELLUNG
            <div class="infor-form-full">
                <div class="infor-form my-container">
                    <div class="text-center py-2 border-bottom-0">
                        <span class="header-container-text" >Bestellung</span>
                    </div>
                    <div class="row text-font">
                        <div class="col-lg "    >
                            <span class="opening-sentence">Bitte Wählen Sie Ihre Bestellung</span>
            
                            <br/>
                            <div class="row pizza-1">
                                <div class="col-lg-3 text-center with-image" >
                                    <img style="max-height: 100px;" class="rounded " src="image/Pizza1.png" alt="Pizza loading">
                                </div>
                                <div class="col-lg-4 pizza-name-position" >
                                    <span id="pizza-infor-1"></span> <i class="fa fa-euro"></i>
                                </div>
                                <div class="col-lg-1 select-pizza-position" >
                                   <select id="select-pizza-1">
                                       <option value="0">0</option>
                                       <option value="1">1</option>
                                       <option value="2">2</option>
                                       <option value="3">3</option>
                                       <option value="4">4</option>
                                       <option value="5">5</option>
                                   </select>
                                </div>
                                <div class="col-lg-4 in-warenkorb-position" >
                                    <a id="button-pizza-1" data-id="1" onclick="setWareninKopf(this)" class="btn-in-warenkorb"  >
                                        <i class="fa fa-cart-plus" style='font-size:20px'></i>
                                        <span>In Warenkorb</span>
                                    </a>
                                </div>
                            </div>
                            <br/>
            
                            <div class="row pizza-2">
                                <div class="col-lg-3 text-center with-image" style="padding-left:0px;">
                                  <img style="max-height: 100px;" src="image/single-pizza-pic.png" alt="Pizza loading">
                                </div>
                                <div class="col-lg-4 pizza-name-position" >
                                    <span id="pizza-infor-2" ></span> <i class="fa fa-euro"></i>
                                </div>
                                <div class="col-lg-1 select-pizza-position" >
                                    <select id="select-pizza-2">
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                                <div class="col-lg-4 in-warenkorb-position" >
                                    <a id="button-pizza-2" data-id="2" onclick="setWareninKopf(this)" class="btn-in-warenkorb"  >
                                        <i class="fa fa-cart-plus" style='font-size:20px'></i>
                                        <span>In Warenkorb</span>
                                    </a>
                                </div>
                            </div>
                            <br/>
            
                            <div class="row pizza-3">
                                <div class="col-lg-3 text-center with-image" >
                                    <img style="max-height: 100px;" src="image/Pizza3.png" alt="Pizza loading">
                                </div>
                                <div class="col-lg-4 pizza-name-position" >
                                    <span id="pizza-infor-3" ></span> <i class="fa fa-euro"></i>
                                </div>
                                <div class="col-lg-1 select-pizza-position">
                                    <select id="select-pizza-3">
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                                <div class="col-lg-4 in-warenkorb-position" >
                                    <a id="button-pizza-3" data-id="3" onclick="setWareninKopf(this)" class="btn-in-warenkorb"  >
                                        <i class="fa fa-cart-plus" style='font-size:20px'></i>
                                        <span>In Warenkorb</span>
                                    </a>
                                </div>
                            </div>
                            <br/>
            
                            <div class="row pizza-4">
                                <div class="col-lg-3 text-center with-image" style="padding-left: 0px;">
                                    <img style="max-height: 100px;" src="image/Pizza4.png" alt="Pizza loading">
                                </div>
                                <div class="col-lg-4 pizza-name-position" >
                                    <span id="pizza-infor-4" ></span> <i class="fa fa-euro"></i>
                                </div>
                                <div class="col-lg-1 select-pizza-position" >
                                    <select id="select-pizza-4">
                                        <option selected value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                                <div class="col-lg-4 in-warenkorb-position" >
                                    <a id="button-pizza-4" data-id="4" onclick="setWareninKopf(this)" class="btn-in-warenkorb" >
                                        <i class="fa fa-cart-plus" style='font-size:20px'></i>
                                        <span>In Warenkorb</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!--right site-->
                        <div class="col-lg">
                            <span class="opening-sentence">Ihre WarenKorb</span> <br />
                            <select id="waren-korb" size="4" class="waren-korb border border-dark">
            
                            </select>
                            <div class="row" style="padding-top: 10px;">
                                <div class="col-lg text-right">
                                    <input id="pizza-entwerden" type="button" class="btn-normal" value="Eine Pizza entwerfen">
                                </div>
                                <div class="col-lg text-left">
                                    <input id="warenkorb-leeren" type="button" class="btn-normal" value="Warenkkorb lerren">
                                </div>
                            </div>
                            <div class="preis-order">Preis <span id="total-preis"></span> <span class="fa fa-euro"></span></div> <br/>
                            <div style="padding-bottom: 10px;">
                                <span>Ihre Daten</span>
                                <div>
                                    <span>Vor Name</span> <br/>
                                    <input type="text" id="firstname"><br/>
                                    <span>Nach Name</span> <br/>
                                    <input type="text" id="lastname"><br/>
                                    <span>Strasse</span> <br/>
                                    <input type="text" id="street-name"><br/>
                                    <span>Hausnummer</span> <br/>
                                    <input type="text" id="street-number"><br/>
                                    <span>Postleizahl</span> <br/>
                                    <input type="text" id="postcode"><br/>
                                    <span>Stadt</span> <br/>
                                    <input type="text" id="city"><br/>
                                    <div class="row" style="padding-top: 10px;">
                                        <div class="col-lg text-right">
                                            <input id="senden" type="button" class="btn-senden" value="Senden" style="min-width: 140px;">
                                        </div>
                                        <div class="col-lg text-left">
                                            <input id="delete-input" type="button" class="btn-delete-all" value="Eingaben löschen">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            
                    </div>
                </div>
            </div>
            <script type = "text/javascript" src = "js/bestellung.js"></script>
BESTELLUNG;


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
        //Make sure that it is a POST request.
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
            $page = new Bestellung();
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
Bestellung::main();

// Zend standard does not like closing php-tag!
// PHP doesn't require the closing tag (it is assumed when the file ends).
// Not specifying the closing ? >  helps to prevent accidents
// like additional whitespace which will cause session
// initialization to fail ("headers already sent").
//? >