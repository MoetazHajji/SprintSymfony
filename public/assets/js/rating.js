

window.onload = () => {

    const stars = document.querySelectorAll(".la-star");

    // On va chercher l'input
    const note = document.querySelector("#note");
    const idprod=document.getElementById("id");
    // On boucle sur les étoiles pour le ajouter des écouteurs d'évènements
    for(star of stars){
        // On écoute le survol
        star.addEventListener("mouseover", function(){
            resetStars();
            this.style.color = "yellow";
            this.classList.add("las");
            this.classList.remove("lar");
            // L'élément précédent dans le DOM (de même niveau, balise soeur)
            let previousStar = this.previousElementSibling;

            while(previousStar){
                // On passe l'étoile qui précède en rouge
                previousStar.style.color = "red";
                previousStar.classList.add("las");
                previousStar.classList.remove("lar");
                // On récupère l'étoile qui la précède
                previousStar = previousStar.previousElementSibling;
            }
        });

        // On écoute le clic
        star.addEventListener("click", function(){
            note.value = this.dataset.value;
            console.log(note.value);
            console.log(idprod.value);
            console.log(idprod.value);
            $.ajax({
                    url:"{{path('rating')}}",
                    type:"POST",
                    dataType:'json',
                    data:{notee:this.dataset.value,idd:idprod.value},
                    success: function(data) {
                        alert("success");
                    },
                    complete: function(data){
                        alert("completed");
                    }
                }
            );

        });

    }

    /**
     * Reset des étoiles en vérifiant la note dans l'input caché
     * @param {number} note
     */
    function resetStars(note = 0){
        for(star of stars){
            if(star.dataset.value > note){
                star.style.color = "black";
                star.classList.add("lar");
                star.classList.remove("las");
            }else{
                star.style.color = "red";
                star.classList.add("las");
                star.classList.remove("lar");
            }
        }
    }
    function makeAjax(){
        // url : lien vers la méthode du controlleur ou on va executer le code serveur souhaité
        // type : type de la requéte : post ,delete , get ,put
        // dataType: type des données envoyé vers le serveur
        // data : les données qui vont étre envoyés dans le serveur
        // success : la fonction qui va étre éxecuté dans le cas d'un scénario nominale sans erreurs
        // error  :  la fonction qui va étre éxecuté dans le cas d'un scénario avec erreurs
        // complete :  la fonction qui va étre éxecuté dans la fin de la requéte ajax
        $.ajax({
                url:"{{path('rating')}}",
                type:"POST",
                dataType:'json',
                data:{note:this.dataset.value,id:id.value},
                success: function(data) {
                    alert("success");
                },
                error:null,
                complete: function(data){
                    alert("completed");
                }
            }
        );

    }

}