pipeline {
  agent {
    docker {
      image 'yuyuko/jenkinsci-laravel-docker'
      args '--privileged=true --entrypoint /usr/sbin/init'
    }

  }
  stages {
    stage('service_start') {
      steps {
        echo 'Start the services'
        sh '''#!/usr/bin/env bash

echo "start the php-fpm service"
systemctl start php-fpm'''
      }
    }
    stage('Installing') {
      steps {
        echo 'Start to test the application'
        sh '''composer self-update
composer install

cp .env.travis .env

php artisan migrate
php artisan test:initTest'''
      }
    }
    stage('Testing') {
      steps {
        sh 'vendor/bin/phpunit -c phpunit.xml'
      }
    }
    stage('PackUP') {
      steps {
        archiveArtifacts(artifacts: 'TouHouUC', defaultExcludes: true, onlyIfSuccessful: true, excludes: '--exclude="./public/resources" --exclude="./Vagrantfile" --exclude="./.env.travis"     --exclude="./env" --exclude="./.vagrant" --exclude="./Homestead.yaml" --exclude="./.idea"     --exclude="./.git" --exclude="./vendor" ')
      }
    }
  }
  environment {
    container = 'docker'
  }
}