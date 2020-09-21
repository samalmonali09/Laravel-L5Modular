function animateButton(x){
     x.classList.toggle("change");
     var obj = {
      "width" : "20px",
      "transition": "0.5s"
     }
     for(var prop in obj) {
       document.getElementsByClassName("sidebar")[0].style[prop] = obj[prop];
     }     
}

function openTabs(uniqueId,uniqueId1,elmnt,color){
    var i, blocks,information, buttonLinks;
    // elmnt.children[0].style.display = "none";
    blocks = document.getElementsByClassName("blocks");
    information = document.getElementsByClassName("information");
    for (i = 0; i < blocks.length; i++) {
        blocks[i].style.display = "none";
        information[i].style.display = "none";
        
    }
    buttonLinks = document.getElementsByClassName("buttonLinks");
    for (i = 0; i < buttonLinks.length; i++) {
        buttonLinks[i].style.backgroundColor = "";
    }
    document.getElementById(uniqueId).style.display = "block";
    document.getElementById(uniqueId1).style.display = "block";

    elmnt.style.backgroundColor = color;

}

  // document.getElementById("defaultOpen").click();


function openNav(x,idss) {
    var ab = document.getElementById(idss);
    ab.style.width = "450px";
    if(idss == "mySidenav1"){
       ab.style.width = "100%";
    }
}

function closeNav(x,idss) {
    document.getElementById(idss).style.width = "0";
}


var myVar;

function myFunction() {
    myVar = setTimeout(showPage, 1000);
}

function showPage() {
  document.getElementById("loader").style.display = "none";
  document.getElementById("myDiv").style.display = "block";
}




function myFunction1() {
    document.getElementById("myDropdown").classList.toggle("show");
}


window.onclick = function(e) {
  if (!e.target.matches('.dropbtn')) {
    var myDropdown = document.getElementById("myDropdown");
      if (myDropdown.classList.contains('show')) {
        myDropdown.classList.remove('show');
      }
  }
}


window.onscroll = function() {scroolingBar()};

function scroolingBar() {
  document.getElementsByClassName("scrollinToTop")[0].style.display = "block";                    
  document.getElementsByClassName("progress-container")[0].style.display = "block"; 
  var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
  var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
  var scrolled = (winScroll / height) * 100;
  document.getElementById("myBarScroll").style.width = scrolled + "%";
  if(document.getElementById("myBarScroll").style.width == "0%"){
    document.getElementsByClassName("scrollinToTop")[0].style.display = "none";
    document.getElementsByClassName("progress-container")[0].style.display = "none"; 
  }
}


function linksOpen(j){
 j.nextElementSibling.classList.toggle("active1");
 j.classList.toggle("active2");
}


function openEachBlock(dis, ids){
    var blocksInfo,i;
    blocksInfo = document.getElementsByClassName("blocksInfo");
    for(i=0;i<blocksInfo.length;i++){
        blocksInfo[i].style.display = "none";
    }
    document.getElementById(ids).style.display = "block";
}

function actvInactv(actv){
   if(actv.innerHTML == "Active" && confirm("Are you sure to Deactivate?") == true){
    actv.innerHTML = "Inactive";
    actv.style.backgroundColor = "#d14848";
   }else if(actv.innerHTML == "Inactive" && confirm("Are you sure to Active?") == true){
    actv.innerHTML = "Active";
    actv.style.backgroundColor = "#4CAF50";
   }
}

function alerting(xy,uniqid){
var z = document.getElementById(uniqid);
  z.style.display="block";  
  document.getElementsByClassName("scrollinToTop")[0].style.display = "none"; 
  window.onclick = function(event) {
    if (event.target == z) {
        z.style.display = "none";
    }
  }
}

function closeModal(dis,uid){
    document.getElementById(uid).style.display="none"; 
    if(document.getElementById("myBarScroll").style.width == "0%"){
        document.getElementsByClassName("scrollinToTop")[0].style.display = "none"; 
    }else{
    document.getElementsByClassName("scrollinToTop")[0].style.display = "block";
    } 
}


function openBlock(ghi,ui,xui){
   document.getElementById(ui).style.display = "block";
   document.getElementById(xui).style.display = "none";
}


function chechNtimes(cd){
var b = confirm("Are you sure to change the status?","");
if(b == true){  
var a = cd.getAttribute("class");
if(a == "fa fa-check"){
  cd.className = "fa fa-times"; 
}else if(a == "fa fa-times"){
  cd.className = "fa fa-check"; 
}
}
}

function activeInput(xyz){
 var a = xyz.parentElement; 
 var b = a.parentElement;
 for(var i = 0; i<2;i++){
 var c = b.querySelectorAll("ul li input");
 c[i].classList.add("setInput");
 c[i].disabled = false;
}
}

function deActiveInput(xyz){
  var a = xyz.parentElement; 
 var b = a.parentElement;
 for(var i = 0; i<2;i++){
 var c = b.querySelectorAll("ul li input");
 c[i].classList.remove("setInput");
 c[i].disabled = true;
}
}



function deleteIt(abc){
  var con = confirm("Are you sure to delete this row","");
  if(con == true){
  var a = abc.parentElement;
  a.parentElement.remove();
  }
}