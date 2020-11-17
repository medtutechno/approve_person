var app=angular.module('app',['ngRoute','ui.bootstrap','ngSanitize']);
app.config(function($routeProvider,$locationProvider){
	$routeProvider
	.when('/',{
        templateUrl:'first.php',
        controller:'homePage'
    })
    .when('/add',{
        templateUrl:'templates/addData.php',
        controller:'addPage'
    })
	.when('/manage',{
		//templateUrl:'templates/system_manage.php',
		
	})
	.otherwise({redirectTo: '/'});
	$locationProvider.hashPrefix('');
});
app.service('datauser',function(){
    this.fullname = '';
});
app.service('autoComplete',function(){
    this.autoCom = function(val){
        if(val !== '' && val !== undefined){
            return  false;
        }else{
            return  true;
        }
    }
});

app.directive('fileModel', ['$parse', function ($parse) {
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            var model = $parse(attrs.fileModel);
            var modelSetter = model.assign;

            element.bind('change', function(){
                scope.$apply(function(){
                    modelSetter(scope, element[0].files[0]);
                });
            });
        }
    };
}]);


