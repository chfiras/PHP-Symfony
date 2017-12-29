function facturefunction(div,add, l){
    $(document).ready(function() {
        // On récupère la balise <div> en question qui contient l'attribut « data-prototype » qui nous intéresse.
        var $container = $(div);

        // On définit un compteur unique pour nommer les champs qu'on va ajouter dynamiquement
        var index = $container.find(':input').length;
        var indicator = document.getElementsByClassName("help-block").length;
        var i = 1;
        // On ajoute un nouveau champ à chaque clic sur le lien d'ajout.
        $(add).click(function(e) {
            $container.append('<label id="l" class="col-md-7" style="color: #02aac4;font-size: larger">l</label>');
            document.getElementById("l").innerHTML =l;
            document.getElementById("l").id = l + i.toString();
            i++;
            addSiteWeb($container);
            e.preventDefault(); // évite qu'un # apparaisse dans l'URL
            return false;
        });

        // On ajoute un premier champ automatiquement s'il n'en existe pas déjà un (cas d'une nouvelle annonce par exemple).
        if(indicator == 0) {
            if (index == 0) {
                addSiteWeb($container,44);

            } else {
                // S'il existe déjà des catégories, on ajoute un lien de suppression pour chacune d'entre elles
                $container.children('div').each(function () {
                    addDeleteLink($(this),44);

                });

            }
        }

        else {

            $container.children('div').each(function () {
                addDeleteLink($(this),44);

            });


        }

        $($($($container.children('div')).first()).find("#supp")).hide();

        $("#mah").click(function (e) {
            e.preventDefault();

            //console.log(document.getElementById("sidebar-scroll").style.length);
            if(document.getElementById("sidebar-scroll").style.length)
            {
                $($($container.children('div')).find("#supp")).css("padding-left" ,"44px")
            }
            else {
                $($($container.children('div')).find("#supp")).css("padding-left" ,"49px")
            }


        });


        // La fonction qui ajoute un formulaire SiteWebType
        function addSiteWeb($container) {
            // Dans le contenu de l'attribut « data-prototype », on remplace :
            // - le texte "__name__label__" qu'il contient par le label du champ
            // - le texte "__name__" qu'il contient par le numéro du champ


            var template = $container.attr('data-prototype')
                .replace(/__name__/g,       index)
                .replace('Name', '')


            // On crée un objet jquery qui contient ce template
            var $prototype = $(template);

            // On ajoute au prototype un lien pour pouvoir supprimer la catégorie
            if(index>=1) {
                if(document.getElementById("sidebar-scroll").style.length)
                {
                    addDeleteLink($prototype,44);
                }
                else
                {
                    addDeleteLink($prototype,49);
                }
            }
            // On ajoute le prototype modifié à la fin de la balise <div>
            $container.append($prototype);

            // Enfin, on incrémente le compteur pour que le prochain ajout se fasse avec un autre numéro
            index++;

        }

        // La fonction qui ajoute un lien de suppression d'une catégorie


        function addDeleteLink($prototype,x) {
            // Création du lien

            var $deleteLink = $('<div id="supp" class="col-md-1 col-md-pull-1" style="padding-left:'+x+'px"><a id="delete_button" href="#" class="btn btn-danger"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </a>');
            // Ajout du lien

            $prototype.append($deleteLink);
            // Ajout du listener sur le clic du lien pour effectivement supprimer la catégorie
            $deleteLink.click(function(e) {
                $prototype.remove();
                i--;
                $(document.getElementById(l+i.toString())).remove();
                e.preventDefault(); // évite qu'un # apparaisse dans l'URL
                return false;
            });
        }

    });
}