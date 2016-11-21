#!/bin/bash
suffix=".template"
branch="master"

array=(`find ./extensions -type d -mindepth 1 -maxdepth 1`)
for i in "${array[@]}"
do :
    cd $i
	echo $i
	git merge --abort
	git rebase --abort
	git stash
	git checkout -b $branch origin/$branch
	git checkout $branch
	git reset --hard origin/$branch
	git pull
	cd ../../
	echo ""
done

array=(`find ./skins -type d -mindepth 1 -maxdepth 1`)
for i in "${array[@]}"
do :
	cd $i
	echo $i
	git merge --abort
	git rebase --abort
	git stash
	git checkout -b $branch origin/$branch
	git checkout $branch
	git reset --hard origin/$branch
	git pull
	cd ../../
	echo ""
done

for line in $(find ./extensions -name "*.php$suffix"); do
	echo "Process: $line ..."
	filename=${line%$suffix}
	echo "Remove: $filename"
	rm $filename
	echo "Copy $line to $filename"
	cp $line $filename
	echo "Done"
done

php maintenance/update.php