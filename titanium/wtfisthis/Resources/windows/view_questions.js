var view_questions_window = Titanium.UI.createWindow({  
    title:'Senaste frågorna',
    backgroundColor:'#fff'
});

var view_questions_tab = Titanium.UI.createTab({  
    icon:'KS_nav_ui.png',
    title:'Senaste frågorna',
    window:view_questions_window
});

var view_questions_label = Titanium.UI.createLabel({
	color:'#999',
	text:'I am Window 2',
	font:{fontSize:20,fontFamily:'Helvetica Neue'},
	backgroundColor:'#eee',
	top: '200px',
	left: '100px'
});

view_questions_window.add(view_questions_label);

tabGroup.addTab(view_questions_tab);