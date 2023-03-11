<?php
/** op-app-skeleton-2020-nep:/asset/rootpath.php
 *
 * @created   2022-10-30
 * @version   1.0
 * @package   op-app-skeleton-2020-nep
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** namespace
 *
 */
namespace OP;

//	Git root.
$git = include(__DIR__.'/unit/git/include/search_path.php');
$git_root = $git ? trim(`{$git} rev-parse --show-superproject-working-tree --show-toplevel | head -1`): '';

//	__DIR__ is real path. Not alias.
$asset_root = __DIR__.'/';

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

//	Document root
$doc_root = $_SERVER['DOCUMENT_ROOT'];

//	Real path --> alias path
if( strpos($asset_root, realpath(dirname($doc_root))) === 0 ){
	$asset_root = str_replace(realpath(dirname($doc_root)), dirname($doc_root), $asset_root);
}

//	Entry each root directory.
RootPath('git'      , $git_root                 );
RootPath('real'     , realpath($app_root)       );
RootPath('doc'      , $doc_root                 );
RootPath('app'      , $app_root                 );
RootPath('asset'    , $asset_root               );
RootPath('op'       , $asset_root.'core'        );
RootPath('core'     , $asset_root.'core'        );
RootPath('unit'     , $asset_root.'unit'        );
RootPath('layout'   , $asset_root.'layout'      );
RootPath('template' , $asset_root.'template'    );
