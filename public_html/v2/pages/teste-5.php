    
     <style type="text/css">       
    p {
    font-family:Verdana;
    font-weight:bold;
    font-size:11px
    }
   
    img {
    cursor:pointer;
    }
    </style>
   
    <script language="javascript" type="text/javascript">
    function mouseOverImage()
    {
        document.getElementById("img1").src = "../img/highlight-off.png";
    }
  
    function mouseOutImage()
    {
        document.getElementById("img1").src = "../img/btn_close.png";
    }
    </script>   


<body>
    <p>
        This Javascript Example will change the image of<br />
        HTML image Tag onmouseover event.</p>
    
    <center>
    	<img src="../img/organizer-rusnano.png"/>
        <img id="img1" src="i../img/btn_close.png" alt="image rollover" onmouseover="mouseOverImage()"
        onmouseout="mouseOutImage()" />
    </center>
</body>
