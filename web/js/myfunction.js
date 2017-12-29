function myfunction(div,add, l,att){
$(document).ready(function() {
  var $container = $(div);
  var index = $container.find(':input').length;
  var indicator = document.getElementsByClassName("help-block").length;
  var i = 1;

          if (index == 0) {
              addSiteWeb($container,44);
          }

    $($($container).find('h2')).first().html(att);
    $($($container).find('h2')).slice(1).html('autre '+ att);
    $($($container).find('h2')).slice(1).css('color','#02aac4');
    //$($($container).find('.btn-default')).slice(1).remove();

    if (!(l === 'Autre site web' || l === 'Autre adresse' || l === 'Autre téléphone/fax' || l==='Autre Email'))
    {
        $($container).find('.block-title').first().append($('<div class="block-options pull-right"> <a href="#" id="'+add.substring(1)+'" class="btn btn-success"> <span class="glyphicon glyphicon-plus" style="color: #0b0b0b"></span> Ajouter</a> </div>'))
    }
    if (!(l === 'Autre site web' || l === 'Autre adresse' || l === 'Autre téléphone/fax') || l==='Autre Email')
    {
        $($container).find('.col-sm-10').attr('class','col-md-12');
    }




    $($container).find('div .col-md-6').unwrap();
    $($container).find('div .col-md-6').unwrap();


    $(add).click(function(e) {
        if (l === 'Autre site web' || l === 'Autre adresse' || l=== 'Autre téléphone/fax')
        {
            $container.append('<label id="l" class="col-md-7" style="color: #02aac4;font-size: larger">l</label>');
            document.getElementById("l").innerHTML =l;
            document.getElementById("l").id = l + i.toString();
        }
        i++;
        addSiteWeb($container);
        if(!(l === 'Autre site web' || l === 'Autre adresse' || l === 'Autre téléphone/fax'))
        {
            $($container).find('.col-sm-10').attr('class','col-sm-12');
        }

        if(att === 'Email')
        {
            $($container).find('div .col-lg-4').unwrap();
            $($container).find('div .col-lg-4').unwrap();
        }

        else
        {
            $($container).find('div .col-md-6').unwrap();
            $($container).find('div .col-md-6').unwrap();
        }

        $($($container).find('h2')).slice(1).html('autre '+att);
        $($($container).find('h2')).slice(1).css('color','#02aac4');
        //$($($container).find('.btn-default')).slice(1).remove();
        e.preventDefault(); // évite qu'un # apparaisse dans l'URL
        return false;
    });


    if(index > 0)
    {
        if(l === 'Autre Email')
        {
            $container.children('div').each(function () {
                addDeleteLink($(this),25);
            });
        }
        else
        {
            $container.children('div').each(function () {
                addDeleteLink($(this),46);
            });
        }

    }

    if(att === 'Email')
    {
        $($container).find('div .col-lg-4').unwrap();
        $($container).find('div .col-lg-4').unwrap();
    }


    $(document.getElementById('supp '+l+'0')).remove();


    $("#mah").click(function (e) {
        e.preventDefault();
        if(document.getElementById("sidebar-scroll").style.length) {
            if (l === 'Autre Email') {
                $(document.getElementsByName('delbuttonforemail')).css("padding-left", "25px")
            }
            else {
                $(document.getElementsByName('delbutton')).css("padding-left", "46px")
            }
        }
        else {
            if(l=== 'Autre Email')
            {
                $(document.getElementsByName('delbuttonforemail')).css("padding-left", "30px")
            }
        else
            {
                $(document.getElementsByName('delbutton')).css("padding-left", "51px")
            }
        }


    });


  function addSiteWeb($container) {

      var template = $container.attr('data-prototype')
          .replace(/__name__/g,       index)
          .replace('Name','');

    var $prototype = $(template);

    if(index>=1) {
        if(document.getElementById("sidebar-scroll").style.length)
        {
            if(l === 'Autre Email')
            {
                addDeleteLink($prototype,25);
            }
            else
            {
                addDeleteLink($prototype,46);
            }
        }
        else
        {
            if(l === 'Autre Email')
            {
                addDeleteLink($prototype,30);
            }
            else
            {
                addDeleteLink($prototype,51);
            }
        }
    }
    $container.append($prototype);

    if($container.children('div').length > 3)
    {
        $container.parent().css('padding-bottom','25px')
    }
    index++;
  }



  function addDeleteLink($prototype,x) {

      if (!(l === 'Autre site web' || l === 'Autre adresse' || l=== 'Autre téléphone/fax' || l==='Autre Email'))
      {
          var $deleteLink = $('<div id="supp '+ l + (i-1) +'" class="block-options pull-right" name="delbutton" style="padding-left:'+x+'px"><a id="delete_button" href="#" class="btn btn-danger"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span> Supprimer </a>');
      }
      else
      {
           $deleteLink = $('<div id="supp '+ l + (i-1) +'" class="col-md-1 col-md-pull-1" name="delbutton" style="padding-left:'+x+'px"><a id="delete_button" href="#" class="btn btn-danger"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span> Supprimer </a>');
      }

      if( l === 'Autre Email')
      {
          $deleteLink = $('<div id="supp '+ l + (i-1) +'" class="col-md-1 col-md-pull-1" name="delbuttonforemail" style="padding-left: '+x+'px"><a id="delete_button" href="#" class="btn btn-danger"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span> Supprimer </a></div>');
          $($prototype).find('.col-lg-4').append($deleteLink);
      }

      else if (!(l === 'Autre site web' || l === 'Autre adresse' || l=== 'Autre téléphone/fax'))
      {
          $($prototype).find('.block-title').append($deleteLink);
      }

      else
      {
          $prototype.append($deleteLink);
      }
      $deleteLink.click(function(e) {
      //i--;
      for(var j=1; j<=i; j++)
      {
          if(this.id === "supp "+l+j)
          {
              $(document.getElementById(l+j.toString())).remove();
              break;
          }
      }
          $($prototype).remove();
          $(this).closest('.col-md-6').remove();
          if (l === 'Autre Email')
          {
              $(this).closest('.col-lg-4').remove();
              if($container.children('div').length < 4)
              {
                  $container.parent().css('padding-bottom','0px')
              }
          }
          e.preventDefault();
      return false;
    });
  }

});
}
