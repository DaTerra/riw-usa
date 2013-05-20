// http://www.daterraweb.com/
// Version: September 1st, 2011
function HideContent(d) {
if(d.length < 1) { return; }
document.getElementById(d).style.visibility = "hidden";
}
function ShowContent(d) {
if(d.length < 1) { return; }
document.getElementById(d).style.visibility = "visible";
}
function ReverseContentDisplay(d) {
if(d.length < 1) { return; }
var dd = document.getElementById(d);
AssignPosition(dd);
if(dd.style.visibility == "hidden") { dd.style.visibility = "visible"; }
else { dd.style.visibility = "hidden"; }
}