angular.module("app",
    [
        "ui.router",
        "ngMaterial",
        "ngResource"
    ])
    .run(function () {
        console.log("Angular is up")
    })
    .config(function ($stateProvider, $urlRouterProvider) {
        $urlRouterProvider.otherwise("/");
        $stateProvider
            .state('main', {
                url: "/",
                templateUrl: "templates/index.html",
                controller: "mainController"
            })
            .state('main.latestcomics', {
                url: "latest-comics",
                templateUrl: "templates/comics.html",
                controller: "latestController"
            })

    })
    .config(function ($mdThemingProvider) {
        $mdThemingProvider.theme('default')
            .primaryPalette('red')
    })
    .factory("comicService", function ($resource) {
        var comicService = $resource("/api/comics");

        return comicService;
    })
    .controller("mainController", function ($scope, $mdSidenav, $state) {

        $scope.goToggle = function (stateName, notToggle) {
            if (stateName) {
                $state.go(stateName);
            }

            if (!notToggle) {
                $mdSidenav("left")
                    .toggle();
            }
        };
    })
    .controller("latestController", function ($scope, $mdDialog, $mdMedia, comicService) {
        $scope.comics = comicService.query();
        $scope.openDialog = function (ev, comic) {
            $mdDialog.show({
                    controller: "dialogComicController",
                    templateUrl: 'templates/dialog-comic.html',
                    parent: angular.element(document.body),
                    targetEvent: ev,
                    clickOutsideToClose: true,
                    fullscreen: ($mdMedia('sm') || $mdMedia('xs')),
                    locals: {
                        comic: comic
                    }
                })
                .then(function (answer) {
                    $scope.status = 'You said the information was "' + answer + '".';
                }, function () {
                    $scope.status = 'You cancelled the dialog.';
                });
            $scope.$watch(function () {
                return $mdMedia('xs') || $mdMedia('sm');
            }, function (wantsFullScreen) {
                $scope.customFullscreen = (wantsFullScreen === true);
            });
        }
    })
    .controller("dialogComicController", function ($scope, comic, $mdDialog) {
        $scope.comic = comic;
        $scope.hide = function () {
            $mdDialog.hide();
        };
        $scope.cancel = function () {
            $mdDialog.cancel();
        };
        $scope.answer = function (answer) {
            $mdDialog.hide(answer);
        };
    });