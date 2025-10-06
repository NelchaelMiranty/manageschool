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

       Swal.fire({
            title: 'Connexion en cours...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        xmlhttp.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200)
          {
                var myObj = JSON.parse(this.responseText);
                if(myObj._msg.localeCompare("OK")==0)
                {
                    Swal.fire({
                        icon: 'success',
                        title: 'Connexion réussie!',
                        text: 'Bonjour ' + myObj._name + '! Redirection en cours...',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = "index.php?action=listMat";
                    });
                }
                else
                {
                  Swal.fire({
                        icon: 'error',
                        title: 'Accès refusé',
                        text: 'Pseudo ou mot de passe incorrect',
                        confirmButtonColor: '#667eea'
                    });
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

       Swal.fire({
            title: 'Connexion en cours...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

       xmlhttp.onreadystatechange = function() {

          if (this.readyState == 4 && this.status == 200)
          {
                var myObj = JSON.parse(this.responseText);

                if(myObj._msg.localeCompare("OK")==0)
                {
                    Swal.fire({
                        icon: 'success',
                        title: 'Connexion réussie!',
                        text: 'Bienvenue formateur! Redirection en cours...',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = "index.php?action=listMatP&id=" + myObj._id;
                    });
                }
                else
                {
                  Swal.fire({
                        icon: 'error',
                        title: 'Accès refusé',
                        text: 'Pseudo ou mot de passe incorrect',
                        confirmButtonColor: '#f5576c'
                    });
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

   var form_data = new FormData();
   var oFReader = new FileReader();

   var matId =document.getElementById("matId").value;
   var f = document.getElementById("myfile").files[0];

   if(!f) {
       Swal.fire({
           icon: 'warning',
           title: 'Aucun fichier sélectionné',
           text: 'Veuillez sélectionner un fichier',
           confirmButtonColor: '#667eea'
       });
       return;
   }

   var name = f.name;
   oFReader.readAsDataURL(f);

   var fsize = f.size||f.fileSize;
   if(fsize > 10000000)
    {
       Swal.fire({
           icon: 'error',
           title: 'Fichier trop volumineux',
           text: 'La taille du fichier ne doit pas dépasser 10 Mo',
           confirmButtonColor: '#667eea'
       });
    }
    else
    {
      form_data.append("myfile", f);
      form_data.append("matId",matId);
      form_data.append("nomf",name);

      Swal.fire({
          title: 'Téléchargement en cours...',
          allowOutsideClick: false,
          didOpen: () => {
              Swal.showLoading();
          }
      });

      $.ajax({
        url:"index.php?action=uploadDoc",
        method:"POST",
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
                  Swal.fire({
                      icon: 'success',
                      title: 'Téléchargement réussi!',
                      text: 'Le document a été ajouté avec succès',
                      confirmButtonColor: '#667eea'
                  }).then(() => {
                      location.reload();
                  });
              },
         error: function() {
              Swal.fire({
                  icon: 'error',
                  title: 'Erreur',
                  text: 'La requête n\'a pas abouti',
                  confirmButtonColor: '#667eea'
              });
            }
        });
    }
 }

 function uploadDev(){

   var form_data = new FormData();
   var oFReader = new FileReader();

   var matId =document.getElementById("matId").value;
   var f = document.getElementById("myfile").files[0];

   if(!f) {
       Swal.fire({
           icon: 'warning',
           title: 'Aucun fichier sélectionné',
           text: 'Veuillez sélectionner un fichier',
           confirmButtonColor: '#667eea'
       });
       return;
   }

   var name = f.name;
   oFReader.readAsDataURL(f);

   var fsize = f.size||f.fileSize;
   if(fsize > 10000000)
    {
       Swal.fire({
           icon: 'error',
           title: 'Fichier trop volumineux',
           text: 'La taille du fichier ne doit pas dépasser 10 Mo',
           confirmButtonColor: '#667eea'
       });
    }
    else
    {
      form_data.append("myfile", f);
      form_data.append("matId",matId);
      form_data.append("nomf",name);

      Swal.fire({
          title: 'Téléchargement en cours...',
          allowOutsideClick: false,
          didOpen: () => {
              Swal.showLoading();
          }
      });

      $.ajax({
        url:"index.php?action=uploadDev",
        method:"POST",
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
                  Swal.fire({
                      icon: 'success',
                      title: 'Téléchargement réussi!',
                      text: 'Votre devoir a été envoyé avec succès',
                      confirmButtonColor: '#667eea'
                  }).then(() => {
                      location.reload();
                  });
              },
         error: function() {
              Swal.fire({
                  icon: 'error',
                  title: 'Erreur',
                  text: 'La requête n\'a pas abouti',
                  confirmButtonColor: '#667eea'
              });
            }
        });
    }
 }