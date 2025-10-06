window.onload = function change(){
 
   
  var lienens = document.getElementsByTagName("a")[0];
  
  lienens.addEventListener('click',function() {$('#liste').load("public/html/enseignants.php", function(response, status, xhr){if (status == "error") {
            var msg = "Désolé, il y a eu une erreur: ";
            $("#liste").html(msg + xhr.status + " " + xhr.statusText);
        } })} );


  var lienet = document.getElementsByTagName("a")[1];
  lienet.addEventListener('click',function() {$('#liste').load("public/html/etudiants.php", function(response, status, xhr){if (status == "error") {
            var msg = "Désolé, il y a eu une erreur: ";
            $("#liste").html(msg + xhr.status + " " + xhr.statusText);
        } })} );

  var lienmat = document.getElementsByTagName("a")[2];

  lienmat.addEventListener('click',function() {$('#liste').load("public/html/matieres3.php", function(response, status, xhr){if (status == "error") {
            var msg = "Désolé, il y a eu une erreur: ";
            $("#liste").html(msg + xhr.status + " " + xhr.statusText);
        } })} );
  
  
} 



function checkPassword(){
      
       var xmlhttp = new XMLHttpRequest();
       var obj={pseudo:$('#pseudo').val(),pwd:$('#password_input').val() };
       var dbParam = JSON.stringify(obj);
       
       //alert('Bonjour! Tu seras informé dès que ce sera prêt!');
        xmlhttp.onreadystatechange = function () {
          //alert(this.readyState);
          //alert(this.status);
          //alert(this.responseText);
          if (this.readyState == 4 && this.status == 200) 
          {
                var myObj = JSON.parse(this.responseText);
                //alert (myObj._id);
                if(myObj._msg.localeCompare("OK")==0)
                {  
                    document.getElementById("connectSt").innerHTML='<a id="continue" class="loga" href="index.php?action=listMat" > Bonjour! Cliquez ici pour continuer</a>';
                    document.getElementById("continue").style.color = '#00FFEF';
                    document.getElementById("connectPr").style.display = 'none';
                   
                }
                else
                {
                  alert('Accès refusé');
                }
         }
        }; 
        xmlhttp.open("POST", "index.php?action=authent", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("x=" + dbParam);

    } 


   	function checkPasswordP(){
       
       var xmlhttp = new XMLHttpRequest();
       var obj={pseudo:$('#pseudo').val(),pwd:$('#password_input').val() };
       var dbParam = JSON.stringify(obj);
      

       xmlhttp.onreadystatechange = function() {
         
          if (this.readyState == 4 && this.status == 200) 
          {
                var myObj = JSON.parse(this.responseText);
                
                if(myObj._msg.localeCompare("OK")==0)
                {  
                    document.getElementById("connectPr").innerHTML='<a id="continue" class="log" href="index.php?action=listMatP&id='+myObj._id+'" > Bonjour! Cliquez ici pour continuer</a>';
                    document.getElementById("continue").style.color = 'orange';
                    document.getElementById("pre").style.display = 'none';
                    document.getElementById("connectSt").style.display = 'none';
                }
                else
                {
                  alert('Accès refusé');
                }
         }
        
      };
       
        xmlhttp.open("POST", "index.php?action=authentprof", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("x=" + dbParam);

        }  

function checkPasswordCM() {

    var xmlhttp = new XMLHttpRequest();
    var obj = { pseudo: $('#pseudo').val(), pwd: $('#password_input').val() };
    var dbParam = JSON.stringify(obj);


    xmlhttp.onreadystatechange = function () {

        if (this.readyState == 4 && this.status == 200) {
            var myObj = JSON.parse(this.responseText);

            if (myObj._msg.localeCompare("OK") == 0) {
                document.getElementById("connectCM").innerHTML = '<a id="continue" class="log" href="index.php?action=menuCM" > Bonjour! Cliquez ici pour continuer</a>';
                document.getElementById("continue").style.color = 'orange';
                document.getElementById("pre").style.display = 'none';
                document.getElementById("connectSt").style.display = 'none';
            }
            else {
                alert('Accès refusé');
            }
        }

    };

    xmlhttp.open("POST", "index.php?action=authentCM", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("x=" + dbParam);

}


function listMat() {

    var xmlhttp = new XMLHttpRequest();

    xmlhttp.open("GET", "index.php?action=listMat", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send();

}

function accueil() {

    var xmlhttp = new XMLHttpRequest();

    xmlhttp.open("GET", "index.php?action=accueil", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send();

}

function listProfs() {

    //alert('listProfs');
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.open("GET", "index.php?action=listProfs", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send();

}

function uploadDoc(){
   
   //alert('uploaddoc');
   var form_data = new FormData();
   var oFReader = new FileReader();
  
   var matId =document.getElementById("matId").value;
   var f = document.getElementById("myfile").files[0];
   var name = f.name;
  // alert(matId+name);
   oFReader.readAsDataURL(f);
  
   var fsize = f.size||f.fileSize;
   if(fsize > 10000000)
    {
    alert("Fichier trop gros");
    }
    else
    {
     // alert("Le fichier n'est pas trop gros");
     
      form_data.append("myfile", f);
      form_data.append("matId",matId);
      form_data.append("nomf",name);
      //alert(form_data.get("matId")+ form_data.get("myfile"));
      
      $.ajax({
        url:"index.php?action=uploadDoc",
        method:"POST",
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {  
                  alert('upload success'); },             
         error: function() {                
              alert('La requête n\'a pas abouti'); 
            }   
        });
    }
 }

 function uploadDev(){
   
   //alert('uploaddev');
   var form_data = new FormData();
   var oFReader = new FileReader();
  
   var matId =document.getElementById("matId").value;
   //var id =document.getElementById("pid").value;
   var f = document.getElementById("myfile").files[0];
   var name = f.name;
   //alert(matId+" "+name);
   oFReader.readAsDataURL(f);
  
   var fsize = f.size||f.fileSize;
   if(fsize > 10000000)
    {
    alert("Fichier trop gros");
    }
    else
    {
      //alert(" fichier OK");
     
      form_data.append("myfile", f);
      form_data.append("matId",matId);
     // form_data.append("pid", id);
      form_data.append("nomf",name);
      //alert(form_data.get("matId")+ form_data.get("myfile"));
      
      $.ajax({
        url:"index.php?action=uploadDev",
        method:"POST",
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {  
                  alert('upload success'); },             
         error: function() {                
              alert('La requête n\'a pas abouti'); 
            }   
        });
    }
 }