<?php
/** op-app-skeleton-2020-nep:/ci.php
 *
 # <pre>
 # How to use: `php ci.php`
 #
 # This file does not git stash save.
 # You can inspect code before committing.
 # </pre>
 #
 * @created   2022-10-09 | op-app-skeleton-2020-nep:/asset/ci.php
 * @moved     2022-10-31 | op-module-develop:/selfcheck/action.php
 * @moved     2022-10-31 | op-app-skeleton-2020-nep:/ci.php
 * @version   2.0
 * @package   op-app-skeleton-2020-nep
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** Declare strict
 *
 */
declare(strict_types=1);

/** namespace
 *
 */
namespace OP;

/**	Execute time.
 *
 * @created
 * @moved     2019-12-12   asset:/app.php --> app:/app.php
 * @changed   2019-01-03   $st --> _OP_APP_START_
 */
define('_OP_APP_START_', microtime(true));

//	...
$exit = 0;

//	...
try {
	//	...
	include(__DIR__.'/asset/init.php');

	//	...
	Env::AppID('self-check');

	//	...
	if(!OP::Unit('CI')->Auto() ){
		$exit = __LINE__;
	}

} catch ( \Throwable $e ){
	//	...
	$message = $e->getMessage();

	//	...
	echo "\n\n";
	echo "Exception: ".$message."\n\n";
	foreach( $e->getTrace() as $trace){
        /*
		echo ' * '.OP::DebugBacktraceToString($trace)."\n";
        */
	    echo ' * ' . DebugBacktrace::Numerator($trace) . "\n";
	}
	echo "\n";

	//	...
	$exit = __LINE__;
}

//	exit
exit($exit);
