$(function(){
    'use strict';
    $('[placeholder]').focus(function(){
        $(this).attr('data-text',$(this).attr('placeholder'));
        $(this).attr('placeholder','');
    }).blur(function(){
        $(this).attr('placeholder',$(this).attr('data-text'));
    });
    $('input').each(function(){    //add asterisk
        if($(this).attr('required')==='required'){
            $(this).after("<span class='asterisk'> * </span>");
        }
    }); 
    var show_field = $(".password");
    $(".show-pass").hover(function(){
        show_field.attr('type','text');
    },function(){
        show_field.attr('type','password');
    });
    $(".confirm").click(function(){
        return confirm("Are You Sure?");
    });

    $('.toggle-info').click(function(){
        console.log("Yes");
        $(this).toggleClass("selected").parent().next(".panel-body").fadeToggle(200);
        if($(this).hasClass("selected")){
            $(this).html("<i class='fas fa-plus'></i>");
        }else{
            $(this).html("<i class='fas fa-minus'></i>");
        }
    });
}); 