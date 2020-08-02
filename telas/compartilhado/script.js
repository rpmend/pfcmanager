$(document).ready(function () {

    // Ativa os selects
    $('select').formSelect();

    // Ativa os dropdowns
    $('.dropdown-trigger').dropdown();

    // Ativa a função collapse (expandir)
    $('.collapsible').collapsible();

    // Ativa as tabs
    $('.tabs').tabs();

    // Ativa o menu lateral
    $('.sidenav').sidenav();

    // Ativa a função scrollSpy
    $('.scrollspy').scrollSpy();


    $('#textarea3').val('New Text');
    M.textareaAutoResize($('#textarea3'));
});

