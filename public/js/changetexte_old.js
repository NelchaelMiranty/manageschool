window.onload = function change($resultat_json){
 
   
  var lienens = document.getElementsByTagName("a")[0];
  
  lienens.addEventListener('click',function() {$('#liste').load("public/html/enseignants.htm", function(response, status, xhr){if (status == "error") {
            var msg = "Désolé, il y a eu une erreur: ";
            $("#liste").html(msg + xhr.status + " " + xhr.statusText);
        } })} );


  var lienet = document.getElementsByTagName("a")[1];
  lienet.addEventListener('click',function() {$('#liste').load("public/html/etudiants.htm", function(response, status, xhr){if (status == "error") {
            var msg = "Désolé, il y a eu une erreur: ";
            $("#liste").html(msg + xhr.status + " " + xhr.statusText);
        } })} );

  var lienmat = document.getElementsByTagName("a")[2];

 /* lienmat.addEventListener('click',function() {$('#liste').load("public/html/matieres.php", function(response, status, xhr){if (status == "error") {
            var msg = "Désolé, il y a eu une erreur: ";
            $("#liste").html(msg + xhr.status + " " + xhr.statusText);
        } })} );*/
  alert($resultat_json);
  lienmat.addEventListener('click',function() {$.ajax({
              url: 'public/html/matieres.php',
              type: 'POST',
              data: JSON.stringify($resultat_json),
              contentType: 'application/json',
              success: function(response) {
                  // Traitez la réponse du serveur ici
                  console.log('Réponse du serveur :', response);
                  // Chargez le contenu dans un élément HTML
                  $('#liste').html(response);
              },
              error: function(xhr, status, erreur) {
                  console.error('Erreur lors de la requête :', erreur);
              }
          });
      });
            
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
                
                if(myObj._msg.localeCompare("OK")==0)
                {  
                    document.getElementById("connectSt").innerHTML='<a id="continue" class="log" href="index.php?action=listMat" > Bonjour! Cliquez ici pour continuer</a>';
                    document.getElementById("continue").style.color = 'orange';
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

function listProfs() {

    alert('listProfs');
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.open("GET", "index.php?action=listProfs", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send();

}