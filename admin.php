<?php
//OYE ISKO HATANA MAT BOOLNA
session_start();
include 'db_access.php';	


if(!(isset($_SESSION['admin']))){
	echo 'shoo';
	exit(0);
}
?>
<!DOCTYPE html>
<html>
<head>
	
	<title>admin</title>
<link rel="stylesheet" href="style2.css">	
<style type="text/css">
html, body{
	margin: 0;
	padding: 0;
}
#added{
    position: fixed;
    width: 250px;
    top:80vh;
    left: 100vw;
    padding: 10px;
    font-size: 20px;
    font-family: arial;
    background-color: #ddffff;
    border-left: 6px solid #2196F3;
    transition: all 0.5s ease;
  }
  .w3-button:hover{
    background-color:#2196f354!important;
  }
  #openNav{
    position: absolute;
    background-color: #2196F3!important;
  }
  #openNav:hover{
    color: #2196F3!important;
    background-color: white!important;
  }
  .container{
    display: grid;
    height: 100vh;
    grid-template-rows: 1fr 6fr 1fr;
    grid-template-columns: 1fr 6fr 1fr;
  }
  .q{
    grid-column-start: 2;
    grid-column-end: 3;
    grid-row-start: 2;
    grid-row-end: 3;
 }
   .q .title{
    background-color: #ddffff;
    padding: 20px;
    padding-left: 0;
    font-size: 40px;
    display: inline-block;
    margin-left: 20px;
  }
  .q .qno{
    background-color: #2196F3;
    padding: 15px;
    color: white;
    margin-right: 20px;
    font-size: 40px;
    width: 100%;  
    position: relative;
    left: -20px;
  }
  .hline{
    margin-top: 30px;
    height: 1px;
    background-color: #0303033b;
    margin-left: 100px;
    margin-right: 100px;
    margin-bottom: 30px;
  }
 ul{
    list-style: none;
    margin: 0;
    padding: 0;
    overflow: auto;
  }

  ul li{
    color: #333333;
    display: block;
    position: relative;
    float: left;
    width: 100%;
    height: 50px;
    /*border-bottom: 1px solid #333;*/
  }

  ul li input[type=radio]{
    position: absolute;
    visibility: hidden;
  }

  ul li label{
    display: block;
    position: relative;
    font-weight: 300;
    font-size: 1.35em;
    padding: 10px 25px 25px 80px;
    margin: 0px auto;
    height: 30px;
    z-index: 9;
    cursor: pointer;
    -webkit-transition: all 0.25s linear;
  }

  ul li:hover label{
    color: green;
  }

  ul li .check{
    display: block;
    position: absolute;
    border: 5px solid #AAAAAA;
    border-radius: 100%;
    height: 25px;
    width: 25px;
    top: 12px;
    left: 20px;
    z-index: 5;
    transition: border .25s linear;
    -webkit-transition: border .25s linear;
  }

  ul li:hover .check {
    border: 5px solid green;
  }

  ul li .check::before {
    display: block;
    position: absolute;
    content: '';
    border-radius: 100%;
    height: 9px;
    width: 9px;
    top: 3px;
    left: 3px;
    margin: auto;
    transition: background 0.25s linear;
    -webkit-transition: background 0.25s linear;
  }

  input[type=radio]:checked ~ .check {
    border: 5px solid #2196F3;;
  }

  input[type=radio]:checked ~ .check::before{
    background: #2196F3;;
  }

  input[type=radio]:checked ~ label{
    color: #2196F3;;
  }
  .points{
    position: absolute;
    right: 12.5vw;
  }
#submit{
  background-color: #2196F3;
  border: 1px solid white;
  color: white;
  cursor: pointer;  
  transition: all 0.25s linear;
}
#submit:hover{
  background-color: white;
  border: 1px solid #2196F3;
  color: #2196F3;
}
</style>

<body>
<div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
  <button class="w3-bar-item w3-button w3-large"
  onclick="w3_close()" style="text-align:center;"><h5>Collapse &times</h5></button>
  <img src="user.jpg" height="200" width="200" style="border-radius:50%;"><br><br><br>
  <?php
  $query = mysqli_query($con,"SELECT * FROM users WHERE uid = '".$_SESSION['uid']."'"  );
    $row = mysqli_fetch_array($query);
  echo "<div style='text-align:center;'>$row[3] <br><i>(@$row[1])</i></div><br><br><div style='text-align:center'>$row[4] Points</div>";
  ?>
  <a href="/quizlol/home.php" style="text-align:center;margin-top:60px;" class="w3-bar-item w3-button"><h3>Home</h3></a>
  <a href="/quizlol/question.php" style="text-align:center;" class="w3-bar-item w3-button"><h3>Questions</h3></a>
  <a href="/quizlol/leaderboard.php" style="text-align:center;" class="w3-bar-item w3-button"><h3>Report</h3></a>
  <?php
  if($_SESSION['admin']==1){
    echo '<a href="/quizlol/admin.php" style="text-align:center;" class="w3-bar-item w3-button"><h3>Admin Panel</h3></a>';
  }
  ?>
</div>
<div id="main">
<button id="openNav" class="w3-button w3-teal w3-xlarge" style="position: absolute;background-color: #2196F3" onclick="w3_open()">&#9776;</button>


<div class="container">
  <div class="q">
    <p class="title"><span id="qid" class="qno"><? $query=mysqli_query($con,"SELECT MAX(qid) from ques"); $row=mysqli_fetch_array($query);echo $row[0]+1; ?></span><input type="text" name="q_title"></p>
  <div id="question"><input type="text" name="q"></div><div class="hline"></div>
  <ul>
  <li><input type="radio" name="mcq" id="o1" value="1" checked/><label for="o1"><input type="text" name="o1"></label><div class="check"><div class="inside"></div></div></li>
  <li><input type="radio" name="mcq" id="o2" value="2"/><label for="o2"><input type="text" name="o2"></label><div class="check"><div class="inside"></div></div></li>
  <li><input type="radio" name="mcq" id="o3" value="3"/><label for="o3"><input type="text" name="o3"></label><div class="check"><div class="inside"></div></div></li>
  <li><input type="radio" name="mcq" id="o4" value="4"/><label for="o4"><input type="text" name="o4"></label><div class="check"><div class="inside"></div></div></li>
  </ul><br>
  <div class="points">Points- <input type="number" id="points"/></div>
  <button id="submit" onclick="addq()">submit</button>
</div>
<div id="added"></div>
</div>
</div>
<!--<form id="form" action="addq.php">
	<h1>Add a question</h1>
	<input type="text" name="q_title"/>
	<input type="text" name="q"/>
	<p class="op"><input type="radio" name="mcq" value="1" checked/><input type="text" name="o1"/></p>
	<p class="op"><input type="radio" name="mcq" value="2"/><input type="text" name="o2"/></p>
	<p class="op"><input type="radio" name="mcq" value="3"/><input type="text" name="o3"/></p>
	<p class="op"><input type="radio" name="mcq" value="4"/><input type="text" name="o4"/></p>
	<input type="number" id="points"/>
	<button onclick="addq()">submit</button>
</form>-->
<div id="added">Question has been added!</div>



<script>
function added(l){
  var x=document.getElementById("added");
  x.innerHTML=l;
  x.style.marginLeft="-280px";
  if(l=='Question has been added!'){
  	let b=document.getElementById("qid");
  	let d=parseInt(b.innerHTML);
  	b.innerHTML=d+1;
  	document.getElementsByName('o1')[0].value='';
document.getElementsByName('o2')[0].value='';
document.getElementsByName('o3')[0].value='';
document.getElementsByName('o4')[0].value='';
document.getElementById('points').value='';
document.getElementsByName('q_title')[0].value='';
document.getElementsByName('q')[0].value='';
  }
  setTimeout(function(){x.style.marginLeft="0px";},2500)
}

function addq(){
	var name= document.getElementsByName('q')[0].value;
	var title= document.getElementsByName('q_title')[0].value;
	var op = String(document.querySelector('input[name = "mcq"]:checked').value);
	var points = String(
		document.getElementById('points').value);
	var o1=String(document.getElementsByName('o1')[0].value);
	var o2=String(document.getElementsByName('o2')[0].value);
	var o3=String(document.getElementsByName('o3')[0].value);
	var o4=String(document.getElementsByName('o4')[0].value);
	var xmlhttp= new XMLHttpRequest();
    xmlhttp.onreadystatechange=function(){
        if (this.readyState == 4 && this.status == 200) {
        	added(this.responseText);
        }
    };
    xmlhttp.open("POST", "addq.php?n="+name+"&o="+op+"&p="+points+"&o1="+o1+"&o2="+o2+"&o3="+o3+"&o4="+o4+"&title="+title, true);
    xmlhttp.send();}


/*$("#form").submit(function(e) {


    var form = $(this);
    var url = form.attr('action');

    $.ajax({
           type: "POST",
           url: url,
           data: form.serialize(), // serializes the form's elements.
           alert(data);
           success: function(data)
           {
           		alert(data);
               added();
           }
         });

    e.preventDefault(); // avoid to execute the actual submit of the form.
});*/
function w3_open() {
  document.getElementById("main").style.marginLeft = "25%";
  document.getElementById("mySidebar").style.width = "25%";
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("openNav").style.display = 'none';
}
function w3_close() {
  document.getElementById("main").style.marginLeft = "0%";
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("openNav").style.display = "inline-block";
}
</script>
</body>
</html>