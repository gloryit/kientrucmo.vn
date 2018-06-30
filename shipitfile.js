'use strict';

const commander = require('commander');
const chalk = require('chalk');

module.exports = function (shipit) {
    shipit.initConfig({
        dev: {
            servers: 'root@192.168.1.250',
            key: '~/.ssh/dev.pem',
            deployTo: '/data/www/iconicjob.vn',
        },
        production: {
            servers: 'ec2-user@54.255.223.36',
            key: '~/.ssh/amazon.pem',
            deployTo: '/var/www/html/kientrucmo.vn',
            branch: 'master'
        }
    });

    commander.option('-b, --branch [branch]','Branch to deploy')
        .parse(process.argv);

    function fetch() {
        shipit.log(chalk.yellow('Fetching origin...'));

        return shipit.remote('git fetch origin -p', {cwd: shipit.config.deployTo})
            .then(function() {
                shipit.log(chalk.green('Fetch origin done!'));

                _printSeparator();
            })
    }

    function checkTargetBranch() {
        shipit.log(chalk.yellow('Checking target branch \"' + _getTargetBranch() + '\" ...'));

        return shipit.remote('git branch -r | grep ' + _getTargetBranch(), {cwd: shipit.config.deployTo})
            .then(function() {
                shipit.log(chalk.green('Check target branch \"' + _getTargetBranch() + '\" done!'))
            })
    }

    function reset() {
        shipit.log(chalk.yellow('Resetting the working tree...'));

        return shipit.remote('git add -A && sudo git reset --hard', {cwd: shipit.config.deployTo})
            .then(function () {
                shipit.log(chalk.green('Reset working tree done!'));

                _printSeparator();
            });
    }

    function checkout() {
        shipit.log(chalk.yellow('Checking out to \"' + _getTargetBranch() + '\" branch...'));

        return shipit.remote('git checkout ' + _getTargetBranch(), {cwd: shipit.config.deployTo})
            .then(function() {
                shipit.log(chalk.green('Checkout to \"' + _getTargetBranch() + '\" branch done!'));

                _printSeparator();
            });
    }

    function prepareComposerPackages() {
        shipit.log(chalk.yellow('Checking composer.json, composer.lock to newest version and run composer install...'));

        return shipit.remote('git checkout origin/' + _getTargetBranch() + ' -- composer.json composer.lock'
            + ' && cp composer.json tmp/'
            + ' && cp composer.lock tmp/'
            + ' && composer install -d tmp/'
            , {cwd: shipit.config.deployTo})
            .then(function() {
                shipit.log(chalk.green('Preparing composer packages done!'));

                _printSeparator();
            });
    }

    function composerInstall() {
        shipit.log(chalk.yellow('Running composer install'));

        return shipit.remote('composer install', {cwd: shipit.config.deployTo})
            .then(function() {
                shipit.log(chalk.green('Running composer install is done!'));

                _printSeparator();
            });
    }

    function pull() {
        shipit.log(chalk.yellow('Pulling \"'+ _getTargetBranch() + '\" branch...'));

        return shipit.remote('git pull origin ' + _getTargetBranch(), {cwd: shipit.config.deployTo})
            .then(function() {
                shipit.log(chalk.green('Pull \"' + _getTargetBranch() + '\" branch done!'));

                _printSeparator();
            })
    }

    function updateDefinesFile() {
        shipit.log(chalk.yellow('Updating defines.php file...'));

        let bootstrap_file = _isProduction() ? 'defines.production.php' : 'defines.development.php';

        return shipit.remote('cp config/' + bootstrap_file + ' config/defines.php', {cwd: shipit.config.deployTo})
            .then(function() {
                shipit.log(chalk.green('Update defines.php done!'));

                _printSeparator();
            })
    }

    function deleteCache() {
        shipit.log(chalk.yellow('Deleting cache...'));

        return shipit.remote('bin/cake cache clear_all', {cwd: shipit.config.deployTo})
            .then(function() {
                shipit.log(chalk.green('Delete cache done!'));

                _printSeparator();
            });
    }

    function restartPhpFpm() {
        if(_isProduction()) {
            shipit.log(chalk.yellow('Restarting PHP-FPM...'));

            return shipit.remote('sudo service php-fpm restart')
                .then(function() {
                    shipit.log(chalk.green('Restart PHP-FPM done!'));

                    _printSeparator();
                });
        } else {
            return shipit.local('echo "Bypass restarting PHP-FPM assets on development."');
        }
    }

    function reloadCrontabConfig() {
        // Code here
        return true;
    }

    function _getTargetBranch() {
        return commander.branch || shipit.config.branch;
    }

    function _isProduction() {
        return shipit.options.environment === 'production' || shipit.options.environment === 'alpha';
    }

    function _printSeparator() {
        shipit.log('----------------------------------------------------');
    }

    shipit.task('deploy', function() {
        if( !_isProduction() && !commander.branch) {
            return shipit.log(chalk.red('Please choose branch to deploy! (Add option: -b deployed-branch-name)'));
        }

        return fetch()
            .then(checkTargetBranch)
            .then(reset)
            .then(prepareComposerPackages)
            .then(reset)
            .then(checkout)
            .then(pull)
            .then(composerInstall)
            .then(updateDefinesFile)
            .then(deleteCache)
            .then(restartPhpFpm);
    });
};
