var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

!function ($) {
	var salesForce = function() {
		
		function salesForce(element, options){
			this.$element = element;
			this.options = $.extend({}, salesForce.defaults, options);
			this.sessionId = '{!$Api.Session_ID}';
			
			this.getToken();
		}
		
		_createClass(salesForce, [{
			key: 'getToken',
			value: function getToken() {
	
				var _this = this,
					token = '00Do0000000H4WG!ARAAQK0FPQvI3kikVMjrTY9cCOFOjY3l4155PBEF2LFrNGw47Frs2aX4rUFwsGbFuWo0uPIqli4SofpZIW8EKTAN3eoUb75y';

				$.ajax({
					'type': 'GET',
					'url': _this.options.rootEndpoint,
					'headers': {
						'Authorization': "Bearer " + token,
						'Content-Type': 'application/json'
					},
					'success': function (result) {
						accessToken = result.access_token;
						console.log('Got the Token');
					},
					'error': function (XMLHttpRequest, textStatus, errorThrown) {
						//Process error actions
						console.log('Error: ' + errorThrown);
						console.log(XMLHttpRequest.status + ' ' + XMLHttpRequest.statusText);
						return false;
					}
				});
				
			}
		}, {
			key: 'getMembers',
			value: function getMembers() {
				//query/?q=Select+name,PhotoUrl+from+Contact+where+MTF_Member__c=true				
			}
		}]);
	
		salesForce.defaults = {
			clientID: 250,
			clientSecret: 150,
			rootEndpoint: '//na17.lightning.force.com/services/data/v37.0',
			authEndpoint: '//login.salesforce.com/services/oauth2/authorize',
			tokenEndpoint: 'https://login.salesforce.com/services/oauth2/token'
		}
		
		return salesForce;
	}();

	var salesForce = new salesForce;

}(jQuery);
/*
	var salesForce = function( element, options ) {
		var rootEndpoint = '//na17.lightning.force.com/services/data/v37.0',
			authEndpoint = '//login.salesforce.com/services/oauth2/authorize',
			tokenEndpoint = 'https://login.salesforce.com/services/oauth2/token';
			
		this.options = $.extend({}, defaults, this.$element.data(), options);
		
		this.getToken();
	}
	
	function _init() {
		console.log(accessToken);
	}
	
	function getToken() {
	    alert ('Inside function getToken');
	    var url_base = 'https://login .salesforce.com/services/oauth2/token';
	    var requestPayload = {
	        'grant_type': 'password',
	        'client_id': myClientId,
	        'client_secret': clientSecret,
	        'username': username,
	        'password': 'passwordtoken'
         }
          $.ajax({
            'url': url_base,
            'type': 'POST',
            'content-Type': 'x-www-form-urlencoded',
            'dataType': 'json',
            'headers': {
                'charset': 'UTF-8',
                'Accept': 'application/json'
              },
            'data': requestPayload,
            'success': function (result) {
            accessToken = result.access_token;
            alert ('Got the Token');
            },
            'error': function (XMLHttpRequest, textStatus, errorThrown) {
                //Process error actions
                alert('Error: ' + errorThrown);
                alert(XMLHttpRequest.status + ' ' + XMLHttpRequest.statusText);
                return false;
              }
		});
	}

	$.ajax({
		type: 'GET',
		url: requestURL,
		headers: {
			'Authorization' : 'Bearer '+accessToken,
			'Content-Type' : 'application/json'
		},
		dataType: 'json',
		success:function(data){
	        console.log("success");
	    },
	    error: function(data) { 
	        console.log("fail");
	    } 
	});
*/
