## INSTALL

$ rvm use 1.9.3-p0
$ gem install jekyll


## USAGE

$ jekyll build
// => The current folder will be generated into ./_site

$ jekyll build --destination <destination>
// => The current folder will be generated into <destination>

$ jekyll build --source <source> --destination <destination>
// => The <source> folder will be generated into <destination>

$ jekyll build --watch
// => The current folder will be generated into ./_site,
//    watched for changes, and regenerated automatically.

## PUBLISH

$ cp -r _site/* ../freetofeel-master/
