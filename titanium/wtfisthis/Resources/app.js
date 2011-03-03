
// create tab group
var tabGroup = Titanium.UI.createTabGroup();


Ti.include("windows/create_question.js");
Ti.include("windows/view_questions.js");

tabGroup.addTab(create_question_tab);

// open tab group
tabGroup.open();
