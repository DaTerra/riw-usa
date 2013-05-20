<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script src="js/scrollingVertical.js" type="text/javascript"></script>
</head>

<body>
<style>
.circle{
	width:100px;
	height:100px;
	border-radius:50px;
	font-size:20px;
	color:#fff;
	line-height:100px;
	text-align:center;
	background:#000}
.button{
	display:block;
	width:100px;
	height:100px;
	border-radius:50px;
	font-size:20px;
	color:#fff;
	line-height:100px;
	text-align:center;
	background:#000}	

.menu{
	display:block;
	width:100px;
	height:100px;
	border-radius:50px;
	font-size:20px;
	color:#fff;
	line-height:100px;
	text-align:center;
	text-decoration:none;
	background:#000}
.menu:hover{
	color:#ccc;
	text-decoration:none;
	background:#333;
	margin:100px;
	transform:scale(2,4);
	-ms-transform:scale(2,4); /* IE 9 */
	-moz-transform:scale(2,4); /* Firefox */
	-webkit-transform:scale(2,4); /* Safari and Chrome */
	-o-transform:scale(2,4); /* Opera */
	}	
	
.container { 
	width: 600px; 
	height:200px;
	background: #ccc; 
	overflow-y:scroll;
	}
.ticker { white-space: normal; }
#test1{
	height:200px;
	width:300px;
	background:blue;
	z-index:20;
	position:fixed;
	top:100px;
	left:55px;
	}
#test2{
	height:200px;
	width:300px;
	background:blue;
	z-index:20;
	position:fixed;
	top:420px;
	left:420px;
	}
			
</style>
<svg xmlns="http://www.w3.org/2000/svg"
    xmlns:xlink="http://www.w3.org/1999/xlink">
    
    <rect x="10" y="10" height="110" width="110"
         style="stroke:#ff0000; fill: green">
    
        <animateTransform
            attributeName="transform"
            begin="0s"
            dur="20s"
            type="rotate"
            from="0 60 60"
            to="360 60 60"
            repeatCount="indefinite" 
        />
    </rect>

</svg>
<svg id="test1" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink">
  <defs>
    <path id="path1" d="M75,20 a1,1 0 0,0 100,0" />
  </defs>
  <text x="10" y="100" style="fill:red;font-size:50px;">
    <textPath xlink:href="#path1">Aff</textPath>
  </text>
</svg>
<svg id="test2" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink">
  <defs>
    <path id="path1" d="M75,20 a1,1 0 0,0 100,0" />
  </defs>
  <text x="10" y="100" style="fill:red;font-size:50px;">
    <textPath xlink:href="#path1">Aff</textPath>
  </text>
</svg>

<div class="circle">Hello</div>
<a href="#" class="button">Hello</a>
<a href="#" class="menu">Hello</a>

<div class="container">
    <span class="ticker">Some short text that isn't greater than the browser window</span>
    <span class="ticker">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed facilisis metus quis augue facilisis elementum. Pellentesque aliquet congue tristique. Phasellus feugiat cursus lobortis. Cras et massa odio, et vehicula nisi. Donec adipiscing condimentum diam sed hendrerit. Curabitur eros elit, aliquet et aliquam id, facilisis id nisi. Vivamus dictum commodo libero, eu venenatis nulla sodales in. Maecenas rhoncus, dui at sollicitudin scelerisque, neque lectus viverra metus, vel elementum nisl ante quis mi. Cras sagittis enim ac arcu scelerisque tristique vel in dolor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Cras vehicula leo vel lacus blandit ut adipiscing lorem sodales.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed facilisis metus quis augue facilisis elementum. Pellentesque aliquet congue tristique. Phasellus feugiat cursus lobortis. Cras et massa odio, et vehicula nisi. Donec adipiscing condimentum diam sed hendrerit. Curabitur eros elit, aliquet et aliquam id, facilisis id nisi. Vivamus dictum commodo libero, eu venenatis nulla sodales in. Maecenas rhoncus, dui at sollicitudin scelerisque, neque lectus viverra metus, vel elementum nisl ante quis mi. Cras sagittis enim ac arcu scelerisque tristique vel in dolor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Cras vehicula leo vel lacus blandit ut adipiscing lorem sodales. Vestibulum ultricies elementum mattis. Maecenas sit amet turpis magna. Phasellus posuere mi nec nisi sodales non dapibus nibh faucibus. Vestibulum leo tellus, blandit sed auctor id, faucibus quis sem. Sed at purus quam. Praesent eget ante sem, a scelerisque nulla. Praesent id quam sit amet eros viverra euismod. Integer volutpat vulputate aliquam. Aliquam convallis dolor tellus, in cursus justo. Donec molestie consequat dolor. Nunc imperdiet arcu et justo vehicula mollis. Suspendisse id molestie velit. Morbi sed est arcu, non aliquam augue.</span>
</div>

</body>
</html>