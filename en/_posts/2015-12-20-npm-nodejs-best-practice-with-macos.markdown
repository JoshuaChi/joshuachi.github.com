---

layout: post
title: "NPM NodeJS Environment Setup Best Practice with MACOS"
tags:  npm nodejs nvm macos
keywords: npm nodejs nvm macos
description: "Setup NPM NodeJS environment with MACOS."

---

### NPM Installation

#### Do not install NPM with homebrew

- [There is an extremely high correlation between "installed npm with Homebrew", and "npm is irreparably broken"](http://blog.npmjs.org/post/85484771375/how-to-install-npm)
- [Explanation of the issue](https://gist.github.com/DanHerbert/9520689)

#### Install it from official site

- List all node modules installed globally:
<pre>
	npm ls -g --depth=0
</pre>

- Delete global node_modules folder:
<pre>
	sudo rm -rf /usr/local/lib/node_modules
</pre>

- Unintall Node
<pre>
brew uninstall node
or
sudo rm /usr/local/bin/node
</pre>

- Clean symbol link to node modules globally.
<pre>
	cd  /usr/local/bin && ls -l | grep "../lib/node_modules/" | awk '{print $9}'| xargs rm
</pre>

- Install NPM
<pre>
curl -L https://www.npmjs.com/install.sh | sh
</pre>


### Node Installation

#### Install nvm
<pre>
curl -o- https://raw.githubusercontent.com/creationix/nvm/v0.29.0/install.sh | bash
</pre>

#### Switch version
<pre>
nvm install stable #Install latest stable node
nvm install 4.2.2 #Install 4.2.2 version
nvm install 0.12.7 #Install 0.12.7 version
nvm use 0 #Will switch to use v0.12.7
</pre>


#### Use a [smart .npmrc](https://blog.heroku.com/archives/2015/11/10/node-habits-2016#2-use-a-smart-npmrc)

By default, npm doesn't save installed dependencies to package.json (and you should always track your dependencies!).

If you use the --save flag to auto-update package.json, npm installs the packages with a leading carat (^), putting your modules at risk of drifting to different versions. 

One solution is installing packages like this:
<pre>
$ npm install foobar --save --save-exact
</pre>
Even better, you can set these options in ~/.npmrc to update your defaults:
<pre>
$ npm config set save=true
$ npm config set save-exact=true
$ cat ~/.npmrc
</pre>
Now, npm install foobar will automatically add foobar to package.json and your dependencies won't drift between installs!

If you prefer to keep flexible dependencies in package.json, but still need to lock down dependencies for production, you can alternatively build npm's [shrinkwrap](https://docs.npmjs.com/cli/shrinkwrap) into your workflow. 
This takes a little more effort, but has the added benefit of preserving exact versions of nested dependencies.

#### Dependencies version management
<pre>
*: Match any verion
1.1.0: Exactly match the version
~1.1.0: >=1.1.0 && < 1.2.0
^1.1.0: >=1.1.0 && < 2.0.0
</pre>


#### nrm switch NPM soruce

http://www.tuicool.com/articles/nYjqeu

##### Install

	$ npm install -g nrm

##### Usage

List all available sources

	nrm ls                                                                                                                                    

	* npm ---- https://registry.npmjs.org/
	cnpm --- http://r.cnpmjs.org/
	taobao - http://registry.npm.taobao.org/
	eu ----- http://registry.npmjs.eu/
	au ----- http://registry.npmjs.org.au/
	sl ----- http://npm.strongloop.com/
	nj ----- https://registry.nodejitsu.com/

` * ` means source you are currently using

##### Switch

Switch to use the one from taobao
<pre>
nrm use taobao                                                                                                 
</pre>
Registry has been set to: http://registry.npm.taobao.org/

#### References
- [10 Habits of a Happy Node Hacker (2016)](https://blog.heroku.com/archives/2015/11/10/node-habits-2016#2-use-a-smart-npmrc)
- [NRM switch NPM sources](https://github.com/streakq/js-tools-best-practice/blob/master/doc/node.md#nrm-快速切换-npm-源)


