// Инициализация переменной
let number = 1234; // Численно
let string = 'string'; // Строка
let boolean = true; // True or false
let array = [12, 'str', false]; // Массив
let object = {12: 'string', 'str': 123, 'arr': []}; // {key: value} – строка или число

function name(str, int) {
    // Тело функции
    let number;
}

name(string, 123);

// Jquery

// $('header > nav > a').css('color', 'orange');

$('header > nav').click(function() {
    console.log(this);
    // $('header > nav > a').css('color', 'orange');
    $(this).children('a').css('color', 'orange');
});

$('main > h1').click(function () { 
    // $('main > section.text').slideDown(2000);

    // $('main > section.text').fadeIn(2000);

    // $('main > section.text').toggle(500, function() {
    //     $('main > section.text > article').css('color', 'orange');
    // });
});

$('main > div.aq > div > div.question').click(function () {
    if($(this).next().css('display') == 'none') {
        $(this).next().slideDown(1000);
    } else if($(this).next().css('display') == 'block') {
        $(this).next().slideUp(1000);
    }
});