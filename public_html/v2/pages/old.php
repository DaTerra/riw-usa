<!--
<img src="../img/highlight-id.png"/>
<img src="../img/highlight-off-content.png"/>
<img src="../img/highlight-on-content.png"/>
<img src="../img/highlight-off.png"/>
<img src="../img/highlight-on.png"/>
-->


<style>
#highlights_wrapper{
	position:relative;
	width:960px;
	margin:0 auto;
	z-index:1;
	}
#highlight_1{
	position:absolute;
	top:100px;
	left:100px;
	}
.highlight_container{
	position:relative;
	}
.trigger{
	position:absolute;
	top:20px;
	left:20px;
	z-index:100;
	}	
.default{
	position:absolute;
	top:25px;
	left:25px;
	z-index:80;
	}
.open{
	position:absolute;
	z-index:90;
	}			
</style>
<script type="text/javascript" language="JavaScript">
<!-- Copyright 2006,2007 Bontrager Connection, LLC
// http://www.daterraweb.com/
// Version: September 1st, 2011

var cX = 0; var cY = 0; var rX = 0; var rY = 0;


function HideContent(d) {
if(d.length < 1) { return; }
document.getElementById(d).style.visibility = "hidden";
}
function ShowContent(d) {
if(d.length < 1) { return; }
var dd = document.getElementById(d);
AssignPosition(dd);
dd.style.visibility = "visible";
}
function ReverseContentDisplay(d) {
if(d.length < 1) { return; }
var dd = document.getElementById(d);
AssignPosition(dd);
if(dd.style.visibility == "hidden") { dd.style.visibility = "visible"; }
else { dd.style.visibility = "hidden"; }
}
//-->
</script>


<a 
   onmouseover="ShowContent('uniquename3'); return true;"
   onmouseout="HideContent('uniquename3'); return true;"
   href="javascript:ShowContent('uniquename3')">
  [show on mouseover, hide on mouseout]
</a>

<div id="uniquename3"  style="visibility:hidden; position:absolute; border-style: solid; background-color: white;   padding: 5px;">
Content goes here.
</div>

<!-- /*****/ -->
<div id="highlights_wrapper">
    <div id="highlight_1">
    	<div class="highlight_container">
                <a  class="trigger" onmouseover="ShowContent('content_hl1'); return true;"onmouseout="HideContent('content_hl1'); return true;" href="javascript:ShowContent('content_hl1')">
                    <img src="../img/highlight-id.png"/>
                </a>
				<div class="default">
                    <img src="../img/highlight-off-content.png"/>
                </div>
            	<div id="content_hl1" class="open" style="visibility:hidden;>
            		<img src="../img/highlight-on-content.png"/>
                </div>
                            
            </div>
        </div>
    </div>
</div>