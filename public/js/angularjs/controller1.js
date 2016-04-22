var app = angular.module('catsApp', []);
app.controller('catsListCtrl', function($scope, $http) {    
    $scope.custom = false;
    $scope.startLoopCats = function() {	
        var cats = $('.cats-produst').map(function(i,v) {
		    return $(this).val();
		}).toArray();
	    $scope.customCats = $scope.customCats === true ? false: true;	
		$http.post('/cats-not-in', { cats }).success(function(response) {
		    $scope.cats = response;
		});
    }
    $scope.startLoopImages = function() {
        var obj_id = $("#id-element").val();
        var curent_url = window.location.href;
        if (curent_url.indexOf('admin/shop')!=0) {
        	var tab = 0;
        }
        else if (curent_url.indexOf('admin/category')!=0) {
        	var tab = 1;
        }
	    $scope.customImages = $scope.customImages === true ? false: true;
		$http.post('/images-not-in', { obj_id, tab }).success(function(response) {
		    $scope.imgs = response;
		});
    }
    $scope.items = items;

    $scope.addImage = function (e) {
        var itm = e.srcElement;        
        var p_itm = itm.parentNode; 
        alert(itm);
        var cln = p_itm.cloneNode(true);
        var list = document.getElementById("selected-images");
        list.insertBefore(cln, list.lastChild);
        p_itm.remove();
    }
});