<?php
/** op-app-skeleton-2020-nep:/asset/git/fetch.php
 *
 * Git fetch main repository and submodule repositories.
 *
 * <pre>
 * ```sh
 * php git.php asset/git/fetch.php remote=orign display=1 debug=0
 * ```
 * </pre>
 *
 * @created    2023-02-15
 * @version    1.0
 * @package    op-app-skeleton-2020-nep
 * @author     Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright  Tomoaki Nagahara All right reserved.
 */

/** Declare strict
 *
 */
declare(strict_types=1);

/** namespace
 *
 */
namespace OP;

//  ...
if(!function_exists('OP') ){
    echo "Usage: php git.php asset/git/fetch.php remote=origin display=1 debug=1\n";
    exit(__LINE__);
}

//	...
$display = OP::Request('display') ?? 1;
$_remote = OP::Request('remote')  ?? 'origin';

/* @var $git UNIT\Git */
$git = OP::Unit('Git');

//	...
$configs = $git->SubmoduleConfig();

//	...
foreach( $configs as $config ){
	//	...
	$meta = 'git:/'.$config['path'];
	$path = OP::MetaPath($meta);
	if(!chdir($path) ){
		throw new \Exception("chdir was failed. ({$meta}, {$path})");
	}
	if( $display ){ D("Change Directory: {$meta}"); }

    //  ...
    if( $_remote === '\*' ){
        $remotes = $git->Remote()->List();
    }else{
        $remotes = [$_remote];
    }

	//	...
	foreach( $remotes as $remote ){
		if( $display ){ D("Remote: {$remote}"); }
		$git->Fetch($remote);
	}
}

//	...
$meta = 'git:/';
$path = OP::MetaPath($meta);
if(!chdir($path) ){
	throw new \Exception("chdir was failed. ({$meta}, {$path})");
}
if( $display ){ D("Change Directory: {$meta}"); }

//  ...
if( $_remote === '\*' ){
    $remotes = $git->Remote()->List();
}else{
    $remotes = [$_remote];
}

//	...
foreach( $remotes as $remote ){
	if( $display ){ D("Remote: {$remote}"); }
	$git->Fetch($remote);
}
