<?php
/**
 * Created by Chris.
 * Title: oop
 * Date: 03/12/2017
 * Time: 02:41
 */



require_once( INCLUDES_PATH . "new_config.php" );
require_once( INCLUDES_PATH . "functions.php" );
foreach ( glob(INCLUDES_PATH.'helpers/*.php') as $file ) {require_once ($file);}
require_once( INCLUDES_PATH . "routes/routes.php" );

	
	
	
$db   = new Classes\Core\Database();
$pdo  = new \Classes\Core\PdoDatabase();
$sess = new Classes\Core\Session();
$user = new Classes\Core\User();

$user1 = new \Classes\Core\User1();


/*echo "<pre>";
print_r($user1);
echo "</pre>";*/

/*$sql = "INSERT INTO `".$pdo->prefix."tester` (`name`, `age`, `location`, `isAlive`, `bank_bal`, `create_at`) ".
       "VALUES (:uName, :age, :loc, :alive, :bank, :cDate)";
$params[] = [':uName', 'Chs"dd"f"sdfs"ris', 'str'];
$params[] = [':age', 37, 'int'];
$params[] = [':loc', 'Belfast', 'string'];
$params[] = [':alive', true, 'bool'];
$params[] = [':bank', 222.44, 'float'];
$params[] = [':cDate', date("Y-m-d H:i:s"), 'str'];
$result = $pdo->query($sql, $params);*/


//var_dump($result);
/*$sql = "SELECT * FROM `".$pdo->prefix."tester`";
$pdo->query($sql);

var_dump($pdo->fetch());
//var_dump($pdo->query("SELECT * FROM `".$pdo->prefix."showcases`"));
	

$sql = "SELECT * FROM `".$pdo->prefix."showcases`";
$pdo->query($sql);

var_dump($pdo->fetch());*/

new Classes\RouteDispatcher($router);
?>