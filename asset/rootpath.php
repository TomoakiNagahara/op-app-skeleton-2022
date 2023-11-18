<?php
/** op-app-skeleton-2020-nep:/asset/rootpath.php
 *
 * @created   2022-10-30
 * @version   1.0
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


//	Git root.
/* Does not work linux.
$git = include(__DIR__.'/unit/git/include/search_path.php');
$git_root = $git ? trim(`{$git} rev-parse --show-superproject-working-tree --show-toplevel | head -1`): '';
*/
/*
if( file_exists( $git_root = dirname(__DIR__).'/.git/' ) ){
	$git_root = dirname($git_root);
}else if( file_exists( $git_root = dirname($git_root).'/.git/' ) ){
	$git_root = dirname($git_root);
}else{
	echo __FILE__.' #'.__LINE__;
	exit(1);
}
*/

//	__DIR__ is real path. Not alias.
$asset_root = __DIR__.'/';

/*
//	app root
switch( php_sapi_name() ){
	//	CLI
	case 'cli':
		$app_root = dirname(realpath($_SERVER['SCRIPT_FILENAME']));
		$_SERVER['DOCUMENT_ROOT'] = $app_root;
		break;

	case 'cli-server':
		$app_root = $_SERVER['DOCUMENT_ROOT'];
		break;

	default:
		$app_root = dirname($_SERVER['SCRIPT_FILENAME']);
		break;
}
*/

//  Branch per each SAPI.
switch( $sapi = php_sapi_name() ){
    //  Web Servers
    case 'fpm-fcgi':
    case 'apache2handler':
        //  App root.
        if( empty($_SERVER['APP_ROOT']) ){
            $_SERVER['APP_ROOT'] = dirname($_SERVER['SCRIPT_FILENAME']).'/';
        }
        break;

        //  CLI
    case 'cli':
        //  App root.
        if( empty($_SERVER['APP_ROOT']) ){
            //  Get current directory.
            $pwd = $_SERVER['PWD'];
            do{
                //  Find the directory where app.php file exists.
                if( file_exists( $pwd . '/app.php' ) ){
                    //  Found.
                    break;
                }
                //  Trim to upper directory.
                $pwd = dirname($pwd);
            }while( $pwd !== '/' );
            //  Assignment.
            $_SERVER['APP_ROOT'] = $pwd;
        }

        //  Document root.
        if( empty($_SERVER['DOCUMENT_ROOT']) ){
            $_SERVER['DOCUMENT_ROOT'] = $_SERVER['APP_ROOT'];
        }
        break;

    default:
        echo __FILE__ .' #'. __LINE__ . ' - ';
        exit("Undefined SAPI. ($sapi)");
}

//  App root
$app_root = $_SERVER['APP_ROOT'];

//	Document root
$doc_root = $_SERVER['DOCUMENT_ROOT'];

//  Git root
if( file_exists("{$app_root}/.git") ){
    $git_root = $app_root;
}else if( file_exists(dirname($app_root).'/.git') ){
    $git_root = dirname($app_root);
}else{
    exit('Does not found .git directory.('.__FILE__.')');
}

//	Real path --> alias path
if( strpos($asset_root, realpath(dirname($doc_root))) === 0 ){
	$asset_root = str_replace(realpath(dirname($doc_root)), dirname($doc_root), $asset_root);
}

//	Entry each root directory.
RootPath('git'      , $git_root                 );
RootPath('real'     , realpath($git_root)       );
RootPath('doc'      , $doc_root                 );
RootPath('app'      , $app_root                 );
RootPath('asset'    , $asset_root               );
RootPath('op'       , $asset_root.'core'        );
RootPath('core'     , $asset_root.'core'        );
RootPath('unit'     , $asset_root.'unit'        );
RootPath('layout'   , $asset_root.'layout'      );
RootPath('template' , $asset_root.'template'    );
