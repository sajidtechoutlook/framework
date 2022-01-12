var $
var app = angular.module('mod', []);

app.controller('sale_form_ctr', ['$scope', '$rootScope', function($scope, $rootScope){
    $scope.bills_array = new Array();
    $scope.arr_tmp = new Array();
    $scope.arr_form = new Array();
    $scope.arr_form.gross_total = 0;
    $scope.arr_form.qty_total = 0;
    $scope.arr_form.total = 0;
    $scope.arr_form.gst_total = 0;
    $scope.arr_form.balance = 0;
    $scope.arr_form.bill_total = 0;
    $scope.arr_form.amount_paid = 0;
    $scope.arr_form.discount_desc = '';
    $scope.arr_form.discount = 0;
    $scope.arr_form.discountinpercent = 0;
    $scope.arr_form.extrachargesdesc = "";
    $scope.arr_form.exchrgs = 0;
    $scope.arr_form.saletax = 0;
    $scope.arr_form.fileno = '';
    $scope.arr_form.customer = '';
    $scope.arr_form.phoneno = '';
    $scope.arr_form.saleman_id = 0;
    $scope.arr_form.payment_type = 0;
    $scope.arr_form.prev_balance = 1200;
    $scope.arr_form.dt = getCurrentDateTime();
    
    $scope.sr = 1;
    $scope.id = 0;
    $scope.arr_form.billarray = new Array();

    $scope.setPrevBalance = function (){
        $scope.arr_form.prev_balance = 12;
    }
    $scope.addRow = function (){
        $scope.arr_tmp = new Array();
        if($('#product_barcode_search').val() != ''){
            for(var i = 0; i < products.length; i++)
            {
                if(products[i].productcode == $('#product_barcode_search').val())
                {
                    $('#product_search').val(products[i].desc);
                }
            }
        }
        if($('#product_search').val() == '') return false;
        $scope.$arr = {
            sr: $scope.sr++, 
            item: $('#product_search').val(), 
            quantity: $('#qty').val(),
            qty_packs: $('#qty_packs').val(),
            price: $('#price').val(),
            discount: $('#discount').val(),
            quantity_packs: $('#quantity_packs').val(),
            
            subtotal: $('#price').val() * $('#qty').val()
        };
        angular.forEach($scope.arr_form.billarray, function(value, key) {
            if(value.item == $('#product_search').val()){
                value.quantity = parseFloat(value.quantity) + parseFloat($('#qty').val());
                $scope.arr_tmp.push(value);
                $scope.already_exists = true;
            }else{
                $scope.arr_tmp.push(value);
            }
            $scope.$arr.sr = $scope.$arr.sr+1;
        });
        if($scope.already_exists == true){
            $scope.arr_form.billarray = $scope.arr_tmp;
        }else{
            $scope.arr_form.billarray.push($scope.$arr);
        }
        // $scope.arr_form.billarray.push($scope.$arr);
        // if ($scope.arr_form.billarray.length == 0){
        //     $scope.arr_form.billarray.push($scope.$arr);
        // }
        // alert($scope.arr_form.billarray.length);
        
        $scope.updateForm();
        $scope.already_exists = false;
        $('#product_search').focus();
        $('#product_barcode_search').focus();
    }
    $scope.deleteRow = function (index){
        $scope.sr = 1;
        $scope.arr_tmp = new Array();
        angular.forEach($scope.arr_form.billarray, function(value, key) {
            value.sr = $scope.sr;
            if(value.item != index){
                $scope.arr_tmp.push(value);
                $scope.sr++;
            }
        });
        $scope.arr_form.billarray = $scope.arr_tmp;
        $scope.updateForm();
        $('#product_search').focus();
        $('#product_barcode_search').focus();
    }
    $scope.updateForm = function(){
        $('#product_barcode_search').val(""),
        $('#product_search').val(""),
        $('#qty').val(1),
        $('#qty_packs').val(""),
        $('#price').val(""),
        $('#discounts').val(""),
        $('#sale_discount').val("");
        $scope.arr_form.gross_total = 0;
        if(!$scope.arr_form.gst_total > 0) $scope.arr_form.gst_total = 0; else parseFloat($scope.arr_form.gst_total);
        if(!$scope.arr_form.balance > 0) $scope.arr_form.balance = 0; else parseFloat($scope.arr_form.balance);
        if(!$scope.arr_form.saletax > 0) $scope.arr_form.saletax = 0; else parseFloat($scope.arr_form.saletax);
        if(!$scope.arr_form.bill_total > 0) $scope.arr_form.bill_total = 0; else parseFloat($scope.arr_form.bill_total);
        if(!$scope.arr_form.amount_paid > 0) $scope.arr_form.amount_paid = 0; else parseFloat($scope.arr_form.amount_paid);
        if(!$scope.arr_form.discount > 0) $scope.arr_form.discount = 0; else parseFloat($scope.arr_form.discount);
        if(!$scope.arr_form.discountinpercent > 0) {
            $scope.arr_form.discountinpercent = 0; 
        }else {
            parseFloat($scope.arr_form.discountinpercent);
            $scope.arr_form.discount = parseFloat();
        }
        if(!$scope.arr_form.exchrgs > 0) $scope.arr_form.exchrgs = 0; else parseFloat($scope.arr_form.exchrgs);

        $scope.arr_tmp = new Array();
        $scope.$count = 1;
        $scope.arr_form.qty_total = 0;
        angular.forEach($scope.arr_form.billarray, function(value, key) {
            value.sr = $scope.$count++;
            if(!value.discount > 0) value.discount = 0;
            value.subtotal = parseFloat(value.quantity * (value.price - value.discount));
            $scope.arr_tmp.push(value);
            $scope.arr_form.gross_total += parseFloat(value.subtotal);
            $scope.arr_form.qty_total += parseFloat(value.quantity);
        });
        if($scope.arr_form.discountinpercent > 0) {
            parseFloat($scope.arr_form.discountinpercent);
            $scope.arr_form.discount = parseFloat(parseFloat($scope.arr_form.gross_total) / 100 * parseFloat($scope.arr_form.discountinpercent));
        }
        $scope.arr_form.billarray = $scope.arr_tmp;
        $scope.arr_form.gst_total = parseFloat(parseFloat($scope.arr_form.gross_total) / 100 * parseFloat($scope.arr_form.saletax));
        $scope.arr_form.bill_total = parseFloat($scope.arr_form.gross_total) + parseFloat($scope.arr_form.gst_total) + parseFloat($scope.arr_form.exchrgs) - parseFloat($scope.arr_form.discount);
        $scope.arr_form.balance = parseFloat($scope.arr_form.bill_total) - parseFloat($scope.arr_form.amount_paid) + parseFloat($('#prev_balance').html());
    }

    
    $scope.completeTheSale = function(){
        $scope.updateForm();
        window.print();
        //reloadProducts();
        $scope.arr_form_tmp = new Array();

        $bill_data = {
            'gross_total': $scope.arr_form.gross_total,
            'total': $scope.arr_form.total,
            'gst_total': $scope.arr_form.gst_total,
            'balance': $scope.arr_form.balance,
            'bill_total': $scope.arr_form.bill_total,
            'amount_paid': $scope.arr_form.amount_paid,
            'discount_desc': $scope.arr_form.discount_desc,
            'discount': $scope.arr_form.discount,
            'discountinpercent': $scope.arr_form.discountinpercent,
            'extrachargesdesc': $scope.arr_form.extrachargesdesc,
            'exchrgs': $scope.arr_form.exchrgs,
            'saletax': $scope.arr_form.saletax,
            'fileno': $scope.arr_form.fileno,
            'customer': $('#customer').val(),
            'phoneno': $('#phoneno').val(),
            'saleman_id': $scope.arr_form.saleman_id,
            'payment_type': $scope.arr_form.payment_type,
            
            'dt': $scope.arr_form.dt
        };
        $scope.arr_form_tmp = {'bill_data': $bill_data, 'bill_items': $scope.arr_form.billarray};
        $scope.bills_array = getCookie('ya_bills');
        if($scope.bills_array.length < 1){
            $scope.bills_array = new Array();
        }else{
            //alert($scope.bills_array);
            console.log($scope.bills_array);
        }
        $scope.bills_array.push($scope.arr_form_tmp);
        setCookie('ya_bills', $scope.bills_array, 360);
        //$response = saveBillToServer($scope.arr_form_tmp);
        $scope.startNewSale();
        //alert($scope.bills_array.length);
        $scope.sendDataToServer();
    }
    
    $scope.startNewSale = function(){
        //$scope.bills_array = new Array();
        $scope.arr_tmp = new Array();
        $scope.arr_form = new Array();
        $scope.arr_form.gross_total = 0;
        $scope.arr_form.total = 0;
        $scope.arr_form.gst_total = 0;
        $scope.arr_form.balance = 0;
        $scope.arr_form.bill_total = 0;
        $scope.arr_form.amount_paid = 0;
        $scope.arr_form.discount_desc = '';
        $scope.arr_form.discount = 0;
        $scope.arr_form.discountinpercent = 0;
        $scope.arr_form.extrachargesdesc = "";
        $scope.arr_form.exchrgs = 0;
        $scope.arr_form.saletax = 0;
        $scope.arr_form.fileno = '';
        $scope.arr_form.customer = '';
        $scope.arr_form.phoneno = '';
        $scope.arr_form.saleman_id = 0;
        $scope.arr_form.payment_type = 0;
        $scope.arr_form.dt = getCurrentDateTime();
        
        $scope.sr = 1;
        $scope.id = 0;
        $scope.arr_form.billarray = new Array();
    }
    
    $scope.sendDataToServer = function(){
        $scope.bills_array = getCookie('ya_bills');
        //console.log(getCookie('ya_bills'));
        deleteCookie('ya_bills');
        $('#bills_to_sync').html('Synching <sup>('+$scope.bills_array.length+')</sup>');
        //console.log(getCookie('ya_bills'));
        if($scope.bills_array.length > 0){
            $.ajax({
                type: 'POST',
                data: {postdata: JSON.stringify($scope.bills_array), ses_userid: 1},
                // contentType: "application/json",
                url: '<?php echo getApiUrl('save_the_sales').'&t='.time();?>',                      
                complete: function(res) {
                    if(res.readyState == 4 && res.responseText == 'Done'){
                        $scope.bills_array = new Array();
                        console.log('synced');
                        console.log(res.responseText);
                        //$('#bills_to_sync').html('');
                        $('#bills_to_sync').html('Synching <sup>('+$scope.bills_array.length+')</sup>');
                    }else{
                        setCookie('ya_bills', $scope.bills_array, 360);
                        console.log('not synced');
                        console.log(res.responseText);
                    }
                }
            });
            roGetNextInvoiceID();
        }
    }
    $scope.syncServer = function(){
        setTimeout(function() { 
            if(delayCompleted()){
                $scope.sendDataToServer();
                $scope.syncServer();
            }
        }, delay);
    }
    roGetNextInvoiceID();
    $scope.sendDataToServer();
    $scope.syncServer();
}]);