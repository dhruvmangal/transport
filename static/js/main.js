var odaFlag=0;

function closeNav(){
	document.getElementById('nav').style.display= 'none';
	document.body.scroll= 'yes';
	document.body.style.overflow= 'scroll';
}
function openNav(){
	document.getElementById('nav').style.display= 'block';
	document.body.scroll= 'no';
	document.body.style.overflow= 'hidden';
}

function expandForm(x){
	
	var y= x.parentElement.nextElementSibling;
	if(y.style.height=='auto'){
		y.style.height= '420px';
		x.innerHTML= '&#10097;'; 
		
	}else{
		y.style.height='auto';
		x.innerHTML='&#10096;'	;
	}
	
	
}
function closePopup(){
	document.getElementById('popup').style.display= 'none';
}
function openPopup(){
	document.getElementById('consigner-value').innerHTML=  document.getElementById('consigner').value;
				document.getElementById('consignee-value').innerHTML=  document.getElementById('consignee').value;
				document.getElementById('transport-value').innerHTML=  document.getElementById('transport').value;
				document.getElementById('cnote-value').innerHTML=  document.getElementById('cnote').value;
				document.getElementById('to-value').innerHTML=  document.getElementById('to').value;
				document.getElementById('date-value').innerHTML=  document.getElementById('datePicker').value;
				
				document.getElementById('weight-value').innerHTML=  document.getElementById('actual-weight-value').value;
				document.getElementById('inv-value').innerHTML=  document.getElementById('invValue').value;
				document.getElementById('freight-value').innerHTML=  document.getElementById('freight').value;
				document.getElementById('fuel-surcharge-value').innerHTML=  document.getElementById('fuel-value').value;
				document.getElementById('FOV-value').innerHTML=  document.getElementById('fov-value').value;
				document.getElementById('CN-value').innerHTML=  document.getElementById('cn').value;	
				document.getElementById('ODA-value').innerHTML=  document.getElementById('oda-value').value;
				document.getElementById('greenTax-value').innerHTML=  document.getElementById('green-tax').value;
				document.getElementById('amount-value').innerHTML=  document.getElementById('amount').value;
				var amount= document.getElementById('amount').value;
				var total_amount= document.getElementById('total-amount').value;
				document.getElementById('gst-value').innerHTML=  (Number(total_amount)- Number(amount)).toFixed(2);
				document.getElementById('total_amount-value').innerHTML=  total_amount;
				
				document.getElementById('popup').style.display= 'block';
			}
			function startup(){
				var x=document.getElementsByClassName('acWeight'); 
				var i=0;
				for(i=0; i<x.length; i++){
					x[i].addEventListener('input', function(){calculateWeight(); calculateAmount();}, false);
				}
				document.getElementById('boxes').addEventListener('input', function(){calculateWeight(); calculateAmount();}, false);
				document.getElementById('fuel').addEventListener('input', function(){calculateFuel(); calculateAmount(); calculateGST(); }, false);
				document.getElementById('fov').addEventListener('input', function(){calculateFOV(); calculateAmount();  calculateGST();}, false);
				document.getElementById('invValue').addEventListener('input', function(){calculateFOV(); calculateAmount();  calculateGST();}, false);
				document.getElementById('oda').addEventListener('input', function(){calculateODA(); calculateAmount();  calculateGST();}, false);
				document.getElementById('gst').addEventListener('input', calculateGST, false);
				document.getElementById('close-btn').addEventListener('click', closePopup, false);
				document.getElementById('show-btn').addEventListener('click', openPopup, false);
			}
			var no=0;
			
			function addRow(){
				
				let transform= {'<>': 'div', 'class': 'vol-row', 'html':[
					{'<>':'div', 'class': 'form-value', 'html':[
						{'<>':'label', 'for': 'box no', 'html':'Box No'},
						{'<>':'input', 'type': 'number', 'class':'form-control no_box acWeight'}
					]},
					{'<>':'div', 'class': 'form-value', 'html':[
						{'<>':'label', 'for': 'width', 'html':'Width'},
						{'<>':'input', 'type': 'number', 'class':'form-control width acWeight'}
					]},
					{'<>':'div', 'class': 'form-value', 'html':[
						{'<>':'label', 'for': 'height', 'html':'Height'},
						{'<>':'input', 'type': 'number', 'class':'form-control height acWeight'}
					]},
					{'<>':'div', 'class': 'form-value', 'html':[
						{'<>':'label', 'for': 'length', 'html':'Length'},
						{'<>':'input', 'type': 'number', 'class':'form-control length acWeight'}
					]}
					
				]
					
				};
				var x= json2html.transform({},transform);
				var y= document.getElementsByClassName('vol-row');
				let frag = document.createRange().createContextualFragment(x);
				var i=0;
				while(y[i]){
					
					i=i+1;
				}
				
				y[i-1].parentElement.appendChild(frag);
				startup();
			}
			function calculateWeight(){
				var acWeight= actualWeight();
				var weight= document.getElementById('weight').value;
				var rate= document.getElementById('rate').value;
				if (weight< acWeight){
					weight= acWeight;
				}
				
				document.getElementById('actual-weight-value').value= weight;
				//document.getElementById('boxes').value=no;
				document.getElementById('freight').value= weight*rate;
				calculateGreenTax();	
				calculateODA();
				calculateFuel();
			}
			function calculateFuel(){
				var fuelPercentage= document.getElementById('fuel').value;
				var freight= document.getElementById('freight').value;
				var value= freight* fuelPercentage/ 100;
				if(window.fsc>value){
					value= window.fsc;
				}
				document.getElementById('fuel-value').value= value;
				
			}
			function calculateFOV(){
				var invValue= document.getElementById('invValue').value;
				var fovPercentage = document.getElementById('fov').value;
				var value= invValue*fovPercentage/100;
				if(window.fscmin> value){
					value= window.rovmin;
				}
				document.getElementById('fov-value').value= value;
			}
			function calculateODA(){
				
				var chargeValue= document.getElementById('actual-weight-value').value;
				var odaPercentage = document.getElementById('oda').value;
				var value= chargeValue*odaPercentage*window.odaFlag;
				if(window.odaFlag==1 && value<window.odamin){
					value= window.odamin;
				}
				document.getElementById('oda-value').value= value;
			}
			function calculateGreenTax(){
				var chargeValue= document.getElementById('actual-weight-value').value;
				var value= window.greentax*0.75*chargeValue;	
					
				
				
				document.getElementById('green-tax').value= value;
			}
			function calculateAmount(){
				var freight= document.getElementById('freight').value;
				var fuelCharge= document.getElementById('fuel-value').value;
				var FovCharge= document.getElementById('fov-value').value;
				var cn= document.getElementById('cn').value;
				var odaValue= document.getElementById('oda-value').value;
				var greenTax= document.getElementById('green-tax').value;
				var value= Number(freight)+Number(fuelCharge)+ Number(FovCharge)+Number(cn)+Number(odaValue)+Number(greenTax);
				document.getElementById('amount').value= value;
			}
			function calculateGST(){
				var gst= document.getElementById('gst').value;
				var amount = document.getElementById('amount').value;
				var gstAmount = Number(gst)*Number(amount)/100; 
				var total= Number(gstAmount)+Number(amount);
				document.getElementById('total-amount').value= total;
			}
			function actualWeight(){
				var numGiven= document.getElementById('boxes').value;
				var weight=0;
				var num=0;
				var w=  document.getElementsByClassName('no_box');
				var x= 	document.getElementsByClassName('width');
				var y=  document.getElementsByClassName('height');
				var z=  document.getElementsByClassName('length');
				var cft= document.getElementById('cft');
				
				for(var i=0; i< w.length; i++){
					weight= weight+ w[i].value*x[i].value*y[i].value*z[i].value;
				}
				for(var i=0; i< w.length; i++){
					num = Number(num) + Number(w[i].value);
				}
				window.num= num;
				if(num> numGiven){
					alert('Number is exceding');
					weight= 0;	
				}else{
					no= num;
					weight=  weight*cft.value/1728;
					weight= Math.round(weight);
					weight= Math.round(weight/10);
					weight= (weight*10);
					
				}	
				return weight;
			}
			function getRate(){
				var type= document.getElementById('deliveryType').value;
				if(type==1){
					var data= '';
					$.ajax({
							async: false,
							type:"POST",
							url:'backend/consignerController.php',
							data: {'method': 'viewRates', 'id': '1'},
							success: function(result){
								data= JSON.parse(result);
							}
					});
					return data;
					
				}
				else{
					var data= '';
					$.ajax({
							async: false,
							type:"POST",
							url:'backend/consignerController.php',
							data: {'method': 'viewRates', 'id': '2'},
							success: function(result){
								data= JSON.parse(result);
							}
					});
					return data;
				}
				
			}
			function allCalculations(){
				calculateWeight();
				calculateFOV();
				calculateFuel();
				calculateODA();
				calculateGreenTax();
				
				calculateAmount();
				calculateGST();
			}
			
			function loginCheck(){
				var id= localStorage.getItem('id');
				if(Number(id)<=0){
					window.location.href= '/logistics/login.html';
				}
				
			}
			function logout(){
				localStorage.removeItem("id");
				window.location.href= '/logistics/login.html';
			}