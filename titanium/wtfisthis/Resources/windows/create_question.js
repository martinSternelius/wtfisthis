// creates the Window object
var create_question_window = Titanium.UI.createWindow({  
		url: 'windows/create_question.js',
    title: 'Skapa fråga',
    backgroundColor: '#fff'
});

// creates the tab for the window
var create_question_tab = Titanium.UI.createTab({  
    icon:'KS_nav_views.png',
    title: 'Skapa ny fråga',
    window: create_question_window
});


Ti.include("/views/create_question/create_question_form.js");