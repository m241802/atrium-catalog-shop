var app = angular.module('catsApp', []);
app.controller('catsListCtrl', function($scope, $http) {    
    $scope.custom = false;   
    $scope.startLoop = function(className, http_p) {         
        var wrapp_attrs = document.getElementsByClassName(className);
        var attrs = [];
        for (var i = 0; i < wrapp_attrs.length; i++) {
            attrs[i] = wrapp_attrs[i].value;
        }; 
            $http.post('/' + http_p + '-not-in', { attrs }).success(function(response) {
            if(http_p=='images') {
                $scope.listImages = $scope.listImages === true ? false: true;
                $scope.imgs = response; 
            }      
            else if(http_p=='attrs') {
                $scope.listAttrs = $scope.listAttrs === true ? false: true;
                $scope.attrs = response; 
            }
            else if(http_p=='cats') {
                $scope.listCats = $scope.listCats === true ? false: true;
                $scope.cats = response; 
            }  
        });
    } 
    $scope.addItem = function (item, out_dir) {
        //get button 'in-gallery' by click
        var itm = item.target;
        //get parent 'li' by button 'in-gallery'
        var p_itm = itm.parentNode;
        //remove button 'in-gallery'
        itm.remove();
        //create button 'out-gallery'
        var add = document.createElement('span');
        var att = document.createAttribute("ng-click");
        var att_d = document.createAttribute("ng-disabled");
        var cla = document.createAttribute("class");
        att.value = "removeImage($event)";   
        att_d.value = "checked";   
        cla.value = "out-gallery";
        add.setAttributeNode(att);
        add.setAttributeNode(att_d);
        add.setAttributeNode(cla);
        var txt = document.createTextNode("-");
        add.appendChild(txt);
        //copy image in gallery post  
        p_itm.parentNode.appendChild(add);  
        p_itm.appendChild(add); 
        //copy parent 'li' button 'in-gallery'      
        var cln = p_itm.cloneNode(true);
        //insert parent 'li' selector 'selected-images'
        var list = document.getElementById(out_dir);
        list.insertBefore(cln, list.lastChild);
        //remove copy parent 'li' button 'in-gallery'
        p_itm.remove();
    }     
});
/*app.controller('imgListCtrl', function($scope) {    
    $scope.removeImage = function (obj2) { 
        //get button 'out-gallery' by click 
        alert(obj2);      
        var itm2 = obj2.target;
        alert(itm2);
        //get parent 'li' by button 'out-gallery'
        var p_itm2 = itm2.parentNode;
        //remove button 'out-gallery'
        itm.remove();
        //create button 'out-gallery'
        var out2 = document.createElement('span');
        var att2 = document.createAttribute("ng-click");
        var cla2= document.createAttribute("class");
        att2.value = "addImage($event)";        
        cla2.value = "in-gallery";
        out2.setAttributeNode(cla2);
        out2.setAttributeNode(att2);        
        var txt2 = document.createTextNode("+");
        out2.appendChild(txt2);
        //copy image in gallery post  
        p_itm2.parentNode.appendChild(out2);  
        p_itm2.appendChild(out2); 
        //copy parent 'li' button 'out-gallery'      
        var cln2 = p_itm2.cloneNode(true);
        //insert parent 'li' selector 'selected-images'
        var list2 = document.getElementById("gallery");
        list2.insertBefore(cln2, list2.lastChild);
        //remove copy parent 'li' button 'out-gallery'
        p_itm2.remove();
    }  
});*/