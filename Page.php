<?php	// UTF-8 marker äöüÄÖÜß€
/**
 * Class Page for the exercises of the EWA lecture
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
 
/**
 * This abstract class is a common base class for all 
 * HTML-pages to be created. 
 * It manages access to the database and provides operations 
 * for outputting header and footer of a page.
 * Specific pages have to inherit from that class.
 * Each inherited class can use these operations for accessing the db
 * and for creating the generic parts of a HTML-page.
 *
 * @author   Bernhard Kreling, <b.kreling@fbi.h-da.de> 
 * @author   Ralf Hahn, <ralf.hahn@h-da.de> 
 */

abstract class Page
{
    // --- ATTRIBUTES ---

    /**
     * Reference to the MySQLi-Database that is
     * accessed by all operations of the class.
     */
    protected $_database = null;//new MySQLi($host,$user, $pwd, "asiapizza");
    protected $sessionId = null;
    // --- OPERATIONS ---
    
    /**
     * Connects to DB and stores 
     * the connection in member $_database.  
     * Needs name of DB, user, password.
     *
     * @return none
     */
    protected function __construct()
    {
        $host = "localhost";
        $user = "root";
        $pdw = "";
        $this->_database = new MySQLi($host,$user,$pdw,"asiapizza" ) /* to do: create instance of class MySQLi */;

        // Verbindung prüfen:
        if (mysqli_connect_errno())
            throw new Exception("Connect failed: ".mysqli_connect_error());
        if (!$this->_database->set_charset("utf8"))
            throw new Exception("Charset failed: ".$this->_database->error);
    }
    
    /**
     * Closes the DB connection and cleans up
     *
     * @return none
     */
    protected function __destruct()    
    {
        $this->_database->close();
        // to do: close database
    }
    
    /**
     * Generates the header section of the page.
     * i.e. starting from the content type up to the body-tag.
     * Takes care that all strings passed from outside
     * are converted to safe HTML by htmlspecialchars.
     *
     * @param $headline $headline is the text to be used as title of the page
     *
     * @return none
     */
    protected function generatePageHeader($headline = "") 
    {
        $headline = htmlspecialchars($headline);
        header("Content-type: text/html; charset=UTF-8");
        echo <<<HEADER
        <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <title>Bestellung</title>
                <link rel="stylesheet" href="style.css">
                <!-- Bootstrap CSS -->
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            </head>
            <body >
            <header class="header-center shop-name-text">
                <span class="background-shop-name">Asia Pizza</span>
            </header>
            <nav class="header-center padding-for-header">
                <button class="header-text" onclick="location.href='Index.php'">Übersicht</button>
                <button class="header-text" onclick="location.href='Bestellung.php'">Bestellung</button>
                <button class="header-text" onclick="location.href='Kunden.php'">Kunden</button>
                <button class="header-text" onclick="location.href='Baecker.php'">Bäcker</button>
                <button class="header-text" onclick="location.href='Fahrer.php'">Fahrer</button>
            </nav>
HEADER;

        // to do: output common beginning of HTML code 
        // including the individual headline
    }

    /**
     * Outputs the end of the HTML-file i.e. /body etc.
     *
     * @return none
     */
    protected function generatePageFooter() 
    {
        // to do: output common end of HTML code
        echo <<<FOOTER
        </body>
        <footer >
            <span id="footerSlogan" style="color: #ffffff; opacity:0.3; font-size:14px">© 2018 Tai Linh Du. All Rights Reserved  </span>
        </footer >
        </html>   
FOOTER;

    }

    /**
     * Processes the data that comes via GET or POST i.e. CGI.
     * If every page is supposed to do something with submitted
     * data do it here. E.g. checking the settings of PHP that
     * influence passing the parameters (e.g. magic_quotes).
     *
     * @return none
     */
    protected function processReceivedData() 
    {
        session_start();
        //set Cookie
        if(isset($_COOKIE['Language']) && isset($_COOKIE['Version']) && isset($_COOKIE['warenkorb']) ){
            if( session_status() == PHP_SESSION_ACTIVE ){
                //do nothing
            }else{
                //set new session
                //throw new Exception("already cookie , but no session");
                //ini_set('session.gc_maxlifetime', 3600);
               // session_set_cookie_params(3600);
                //session_start();
                session_regenerate_id(true);
                //$_SESSION['OrderId'] = null;
                //$_SESSION['warenkorb'] = null;
            }

        }
        else{
            setcookie("Language", "PHP");
            setcookie("Version", "7.0");
            setcookie("warenkorb", "");

            //set new session
            //ini_set('session.gc_maxlifetime', 3600);
            //session_set_cookie_params(3600);
            //session_start();
            session_regenerate_id(true);
            //$_SESSION['OrderId'] = null;
            //$_SESSION['warenkorb'] = null;
            //throw new Exception("No Cookie, No Session");

        }
        if (get_magic_quotes_gpc()) {
            throw new Exception
                ("Bitte schalten Sie magic_quotes_gpc in php.ini aus!");
        }
    }
} // end of class

// Zend standard does not like closing php-tag!
// PHP doesn't require the closing tag (it is assumed when the file ends). 
// Not specifying the closing ? >  helps to prevent accidents 
// like additional whitespace which will cause session 
// initialization to fail ("headers already sent").