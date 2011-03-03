var orderReq = Titanium.Network.createHTTPClient();
orderReq.onload = function(){
    Ti.API.info('Response_JSON: ' + JSON.stringify(data));
		Ti.API.info('Response DATA: ' + orderReq.responseData);
    Ti.API.info('in utf-8 onload for POST'); 
};
orderReq.onerror = function(){
    Ti.API.info('in utf-8 error for POST');
		Ti.API.info(orderReq.error);
};

var question_label = Titanium.UI.createLabel({
    text:'Ställ din fråga',
    top:55,
    left:10,
    height:'auto',
    width:'auto',
    shadowColor:'#000',
    shadowOffset:{x:1,y:1},
    color: '#fff',
    font: {fontSize:20},
    textAlign: 'center'
});

var question = Titanium.UI.createTextArea({
    color:'#336699',
    height:80,
    width:300,
    top:100,
    font:{fontSize:20,fontFamily:'Marker Felt', fontWeight:'bold'},
    textAlign:'left',
    appearance:Titanium.UI.KEYBOARD_APPEARANCE_ALERT,   
    keyboardType:Titanium.UI.KEYBOARD_DEFAULT,
    returnKeyType:Titanium.UI.RETURNKEY_DEFAULT,
    borderWidth:2,
    borderColor:'#bbb',
    borderRadius:5,
    suppressReturn:false
});


var author = Titanium.UI.createTextField({
    color:'#336699',
    top:200,
    left:10,
    width:250,
    height:40,
    hintText:'Författare',
    keyboardType:Titanium.UI.KEYBOARD_DEFAULT,
    returnKeyType:Titanium.UI.RETURNKEY_DEFAULT,
    borderStyle:Titanium.UI.INPUT_BORDERSTYLE_ROUNDED
});

//-- Submit Button
var submit = Ti.UI.createButton({
	width:137,
	height:30,
	title: 'Skicka!',
	top:300,
	left:165,
	opacity:1
});
 
//-- Cancel Button
var cancel = Ti.UI.createButton({
    width:137,
    height:30,
    title: 'Avbryt',
    top:300,
    left:10,
    opacity:1
});

create_question_window.add(question_label);
create_question_window.add(question);
create_question_window.add(author);
create_question_window.add(submit);
create_question_window.add(cancel);

question.addEventListener('return',function(){author.focus();});


//-- Cancel button event. Goes back to the toppings window and remembers the users selections
cancel.addEventListener('click',function(){
	//nothing
});

var data;

//-- Cancel button event. Goes back to the toppings window and remembers the users selections
submit.addEventListener('click',function(){
	
	data = {
		"headerInput":"Rubrik",
		"textInput":question.value,
		"nameInput":author.value
	};
	
	Ti.API.info(JSON.stringify(data));
	orderReq.open('POST', "http://localhost:8888/wtfisthis/api/?resource=questions&debug=true");
	//orderReq.setRequestHeader('Content-Type', 'form-data');
	orderReq.send(data);
});