<script type="text/javascript" language="JavaScript">
<!-- Copyright 2006,2007 Bontrager Connection, LLC
// http://www.daterraweb.com/
// Version: September 1st, 2011

var cX = 0; var cY = 0; var rX = 0; var rY = 0;
function UpdateCursorPosition(e){ cX = e.pageX; cY = e.pageY;}
function UpdateCursorPositionDocAll(e){ cX = event.clientX; cY = event.clientY;}
if(document.all) { document.onmousemove = UpdateCursorPositionDocAll; }
else { document.onmousemove = UpdateCursorPosition; }
function AssignPosition(d) {
if(self.pageYOffset) {
	rX = self.pageXOffset;
	rY = self.pageYOffset;
	}
else if(document.documentElement && document.documentElement.scrollTop) {
	rX = document.documentElement.scrollLeft;
	rY = document.documentElement.scrollTop;
	}
else if(document.body) {
	rX = document.body.scrollLeft;
	rY = document.body.scrollTop;
	}
if(document.all) {
	cX += rX; 
	cY += rY;
	}
d.style.left = (cX+10) + "px";
d.style.top = (cY+10) + "px";
}
function HideContent(d) {
if(d.length < 1) { return; }
document.getElementById(d).style.display = "none";
}
function ShowContent(d) {
if(d.length < 1) { return; }
var dd = document.getElementById(d);
AssignPosition(dd);
dd.style.display = "block";
}
function ReverseContentDisplay(d) {
if(d.length < 1) { return; }
var dd = document.getElementById(d);
AssignPosition(dd);
if(dd.style.display == "none") { dd.style.display = "block"; }
else { dd.style.display = "none"; }
}
//-->
</script>
<div id="home">
    <div id="highlights_stage">
    
<!-- HL 1 -->
        <div id="container" class="hl_1">
            <a class="highlight_id" onmouseover="ShowContent('hl_1_content'); return true;" href="javascript:ShowContent('hl_1_content')">1</a>
            <p class="txt_off">Priviet kagadla</p>
            <div id="hl_1_content" class="pop-up">                 
                <a  onmouseover="HideContent('hl_1_content'); return true;"  href="javascript:HideContent('hl_1_content')">[hide]</a>
				<p>100 best<br/>Russian startups<br/>with cutting-edge<br/>technology in IT,<br/>CleanTech and<br/>Biotech</p>        	
            </div>
    		<div class="clear"></div>
    	</div>
        
<!-- HL 2 -->    
    <div id="highlights_stage">
        <div id="container" class="hl_2">
            <a onmouseover="ShowContent('hl_2_content'); return true;" href="javascript:ShowContent('hl_2_content')">
                <div class="highlight_id">
                    [show, content has "hide" link]
                </div>
            </a>
            <p> teste</p>
            <div id="hl_2_content" style="display:none; osition:absolute; border-style: solid;  background-color: white; padding: 5px;">
            Content goes here. 
            <a onmouseover="HideContent('hl_2_content'); return true;"  href="javascript:HideContent('hl_2_content')">
            [hide]
            </a>
        </div>
    	<div class="clear"></div>
    </div>   
</div>
