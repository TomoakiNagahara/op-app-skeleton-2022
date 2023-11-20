
 ## op-app-skeleton-2020-nep:/asset/git/submodule/repo.sh
 #
 # @created    ????
 # @version    1.0
 # @package    op-app-skeleton-2020-nep
 # @author     Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 # @copyright  Tomoaki Nagahara All right reserved.
 #

# user name
USER_NAME=${1}
HOST_NAME=${2:-repo}

# Check argument.
if [ -z "$USER_NAME" ]; then
  echo 'Empty github accout name: sh asset/git/submodule/repo.sh [YOUR ACCOUNT NAME]'
  exit 1
fi

# First, Change to local path.
sh asset/git/submodule/local.sh $USER_NAME
if [ $? -ne 0 ]; then
  exit 1
fi

# Backup
cp .gitmodules .gitmodules_local

# --> sudo port install realpath
# HOME=$(realpath ~/)

# Change to remote path from local path.
sed -i -e "s|${HOME}/repo/|${HOST_NAME}:~/repo/|g" .gitmodules

# Backup
cp .gitmodules .gitmodules_$HOST_NAME

# Sync
git submodule sync
