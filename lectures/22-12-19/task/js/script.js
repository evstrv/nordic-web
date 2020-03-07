const backgrounds = ['orange', 'pink', 'green', 'red', 'lightblue'];
const div = $('header > div');

$('main > div > span').click(function () {
    for(let i = 0; i < 10; i++) {
        setTimeout(
            function () {
                $(div[0]).css('background', backgrounds[Math.floor(Math.random() * 5)]);
                $(div[1]).css('background', backgrounds[Math.floor(Math.random() * 5)]);
                $(div[2]).css('background', backgrounds[Math.floor(Math.random() * 5)]);
                $(div[3]).css('background', backgrounds[Math.floor(Math.random() * 5)]);
            },
            1000*i
        );
    }
});