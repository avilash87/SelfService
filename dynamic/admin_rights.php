<!--<script src="http://code.jquery.com/jquery-1.7.2.js"></script>-->
<style>
body {
    font: small sans-serif;
}
#page {
    margin-left: 200px;
    background-color: #F0F0F0;
}
#maincontent {
    float: right;
    width: 100%;
}
#menuleftcontent {
    float: left;
    width: 200px;
    margin-left: -200px;
    background-color: #CCCCCC;
}
#clearingdiv {
    clear: both;
}	
</style>
<script>
	i=0;
	$(function () {
    $("#maincontent > div:gt(0)").hide();
    $("#menu a").on("click", function (e) {
        var href = $(this).attr("href");
        $("#maincontent > " + href).show();
        $("#maincontent > :not(" + href + ")").hide();
    });
});
function dynamic_field(type,div_no){
	i++;
    if(type == 'text'){
    		var cap = prompt("Caption for TextBox", "");
        document.getElementById('maincontent').innerHTML += cap + " : <input type =text name=dynamic_field_"+i+" id=dynamic_field_"+i+"> ";
    }else if (type == 'textarea'){
    	var cap = prompt("Caption for TextArea", "");
        document.getElementById('maincontent').innerHTML += cap + " : <textarea name=dynamic_field_"+i+" id=dynamic_field_"+i+" row=3 col=50> </textarea>";  
    }else if (type == 'checkb'){
    		var cap = prompt("Caption for CheckBox", "");
        document.getElementById('maincontent').innerHTML += "<input type=checkbox name=dynamic_field_"+i+" id=dynamic_field_"+i+" value="+cap+">"+cap;  
    }else if (type == 'newline'){
    		var cap = prompt("Caption for CheckBox", "");
        document.getElementById('maincontent').innerHTML += "<br>";  
    }
    else if (type == 'combo'){
    	var cap = prompt("Caption for ComoBox", "");
    	document.getElementById('maincontent').innerHTML += cap + " : <select name=dynamic_field_"+i+" id=dynamic_field_"+i+">";    
    		var num = prompt("Number of values?", "");
    		for(count = 0; count < num; count++){
            var x = document.getElementById("dynamic_field_"+i);
						var option = document.createElement("option");
						option.text = prompt("What is your " + count + " value");
						x.add(option);
        }
    }
}

function readInputs(){
		alert(document.getElementById("maincontent").innerHTML );
}
</script>
<hr width=14% align=left>
<b>ToolBox<hr width=14% align=left></b>
<form action="action.php" method="post">
<div id="page">
  <div id="maincontent" align=center>
        	
		
  </div>
    <div id="menuleftcontent">
        <ul id="menu">
            <li><a href="#firstcontent"><input type=textbox value="Text Field" size=10 onclick="dynamic_field('text',1)" /></a></li>
            <li><a href="#secondcontent"><textarea rows=2 cols=10 onclick="dynamic_field('textarea',2)"></textarea></a></li>
            <li><a href="#thirdcontent"><select onclick="dynamic_field('combo',3)"><option>Combo Box</option></select></a></li>
            <li><a href="#fourthcontent"><input type="checkbox" value="CheckBox" onclick="dynamic_field('checkb',4)" />CheckBox</a></li>
            <li><a href="#fivecontent"><input type="button" value="NewLine" onclick="dynamic_field('newline',4)" /></a></li>
        </ul>
    </div>
    <div id="clearingdiv"></div>
</div>
<br />


<input  type="submit" value="submit" onClick=readInputs(); />
</form>