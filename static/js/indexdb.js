

	window.indexedDB = window.indexedDB || window.mozIndexedDB || window.webkitIndexedDB || 
	window.msIndexedDB;
	 
	window.IDBTransaction = window.IDBTransaction || window.webkitIDBTransaction || 
	window.msIDBTransaction;
	window.IDBKeyRange = window.IDBKeyRange || 
	window.webkitIDBKeyRange || window.msIDBKeyRange
	 
	if (!window.indexedDB) {
	   window.alert("Your browser doesn't support a stable version of IndexedDB.")
	}
	
	var request= indexedDB.open('logistics');
	request.onupgradeneeded= function(){
		window.db = request.result;
		var store = window.db.createObjectStore("order", {keyPath: "cnote"});
		var titleIndex = store.createIndex("by_cnote", "cnote", {unique: true});
		
		  
	
	}
	

function add() {
	window.db = request.result;
	var cnote= document.getElementById('cnote').value;
	var consigner= document.getElementById('consigner').value;
	var consignee= document.getElementById('consignee').value;
	var transport= document.getElementById('transport').value;
	var zone= document.getElementById('deliveryType').value;
	var from= 'Jaipur';
	var to= document.getElementById('to').value;
	var date= document.getElementById('datePicker').value;
	var acweight= document.getElementById('weight').value;
	var boxes= document.getElementById('boxes').value;
	var chargedWeight= document.getElementById('actual-weight-value').value;
	var rate= document.getElementById('rate').value;
	var cft= document.getElementById('cft').value;
	var payment= document.getElementById('payment').value;
	var inv= document.getElementById('invValue').value;
	var fsc= document.getElementById('fuel-value').value;
	var rsc= document.getElementById('fov-value').value;
	var oda= document.getElementById('oda-value').value;
	var freight= document.getElementById('freight').value;
	var cn= document.getElementById('cn').value;
	//var gst= document.getElementById('total_amount-value').value;
	//var cgst= document.getElementById('conte').value;
	//var sgst= document.getElementById('conte').value;
	var greenTax= document.getElementById('green-tax').value;
	var amount= document.getElementById('amount').value
	var totalAmount= document.getElementById('total-amount').value;	
	let formData= new FormData(form);
	
	
	var form= document.getElementById('formLine');
	var arr= [];
	arr[0]= cnote;
	console.log(JSON.stringify(arr));
	var tx = window.db.transaction("order", "readwrite");
	var store= tx.objectStore("order");
	store.put(JSON.stringify(arr));
   
	request.onsuccess = function(event) {
		alert("added.");
	};
   
	request.onerror = function(event) {
	
		alert("Unable to add data, data is already exist in your database! ");
	}
}