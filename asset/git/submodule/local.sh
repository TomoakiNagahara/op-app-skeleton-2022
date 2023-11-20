
 ## op-app-skeleton-2020-nep:/asset/git/submodule/local.sh
 #
 # @created    ????
 # @version    1.0
 # @package    op-app-skeleton-2020-nep
 # @author     Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 # @copyright  Tomoaki Nagahara All right reserved.
 #

# Check command
# if !(which realpath >/dev/null 2>&1); then
#     echo "The following command is not installed: realpath";
#     exit 1;
# fi

# user name
USER_NAME=${1}

# Check argument.
if [ -z "$USER_NAME" ]; then
  echo 'Empty github accout name: sh asset/git/submodule/local.sh [YOUR ACCOUNT NAME]'
  exit 1
fi

# First, Change to local path.
sh asset/git/submodule/github.sh $USER_NAME
if [ $? -ne 0 ]; then
  exit 1
fi

# Copy backup.
cp .gitmodules .gitmodules_github

# --> sudo port install realpath
# HOME=$(realpath ~/)

# Replace
sed -i -e "s|https://github.com/${USER_NAME}/|${HOME}/repo/op/|g" .gitmodules
sed -i -e "s|/unit-|/unit/|g"          .gitmodules # old path, Retained for compatibility.
sed -i -e "s|/module-|/module/|g"      .gitmodules # old path, Retained for compatibility.
sed -i -e "s|/layout-|/layout/|g"      .gitmodules # old path, Retained for compatibility.
sed -i -e "s|/op-core.git|/core.git|g" .gitmodules
sed -i -e "s|/op-unit-|/unit/|g"       .gitmodules
sed -i -e "s|/op-module-|/module/|g"   .gitmodules
sed -i -e "s|/op-layout-|/layout/|g"   .gitmodules
sed -i -e "s|/op-webpack-|/webpack/|g" .gitmodules

# Sync
git submodule sync

# Fetch from local repository.
git submodule foreach git fetch origin

# Rebase to local/2022
git submodule foreach git rebase origin/2022

# Delete garbage files.
if [[ -e '.gitmodules-e' ]];then
  rm .gitmodules-e
fi
