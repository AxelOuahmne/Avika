$(function(){
    'use strict';
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
    //Conversation le champs da password entre text et password 
    var passField = $('.password');
    $('.show-password').hover(function(){
        passField.attr('type','text');
    },function(){

    passField.attr('type','password')

    });

    // function de confirmation Message on button
    $('.confirm').click(function(){
        return confirm('vous voulez bien supprimer  ');
    }); 
    // voir tous ou cacher tous
    $('.category .cat h2').click(function(){
        $(this).next('.tous-voir').fadeToggle(100);
    });
     //Trigger the SelectBoxit
     $("select").selectBoxIt({
        autoWidth: false
    });

        // show delete child-categorie
        // find باش اجيب ليا ديالة هو ماشي ديال لخرين
        $('.child').hover(function(){
            $(this).find('.delete-child').fadeIn(200);
        },function(){
            $(this).find('.delete-child').fadeOut(600)
        });
      
});

