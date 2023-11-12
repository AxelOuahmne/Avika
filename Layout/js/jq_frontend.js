$(function(){
    'use strict';

    // chnager entre insription et connexion 
    $('.connecter h1 span ').click(function(){
        $(this).addClass('selected').siblings().removeClass('selected');
        // siblings ses fréres ikhwonha
        $('form').hide(); // ikhfa kol form 
        $('.' + $(this).data('class')).show(100); // aprés idherho li '.' bach twli data-class = class

    });
    // faire cache (hide) placeholder qaund on faire focus dans inpute de form 
    $('[placeholder]').focus(function(){
        $(this).attr('data-text',$(this).attr('placeholder'));
        $(this).attr('placeholder','');
        //si il ya dans data-text un attrebu placholder cache le (mette dans sa place la vide )

    }).blur(function(){
        // si il a fait le contrer mette la placeholder qui enregester dans data-text
        $(this).attr('placeholder',$(this).attr('data-text'));
    });
    // ajouter un asterisque dans les champs required avec method de tchek .each()
    $('input').each(function(){
        if($(this).attr('required')=== 'required'){
            $(this).after('<span class="asterisk">*</span>');
        }
    });

    // function de confirmation Message on button
    $('.confirm').click(function(){
        return confirm('vous voulez bien supperimer  ');
    }); 



});

