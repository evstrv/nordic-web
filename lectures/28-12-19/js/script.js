$('main > div.aq > div > div.question').click(function () {
    if($(this).next().css('display') == 'none') {
        $(this).next().slideDown(1000);
    } else if($(this).next().css('display') == 'block') {
        $(this).next().slideUp(1000);
    }
});

$('header > nav > a').click(function () {
    $('html, body').animate({
        scrollTop: $('#footer').offset().top
    }, 2000);
});

$('div.form > form').submit(function (event) {
    event.preventDefault();

    let widthStar = $(this).children('input[name=width]').val();
    let heightStar = $(this).children('input[name=height]').val();

    if(!widthStar) {
        widthStar = 51;
    }
    if(!heightStar) {
        heightStar = 51;
    }

    console.log(widthStar, heightStar);

    const star = document.createElement('div');
    star.classList.add('star');
    star.innerHTML = '<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="svg-inline--fa fa-star fa-w-18"><path fill="currentColor" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z" class=""></path></svg>';
    
    let left = Math.floor(Math.random() * 1100);
    let top = Math.floor(Math.random() * 300);

    let width = 1100 - widthStar;
    let height = 300 - heightStar;

    if(left > width) {
        left -= widthStar;
    }
    if(top > height) {
        top -= heightStar;
    }

    $(star).css('margin-left', left + 'px');
    $(star).css('margin-top', top + 'px');
    $(star).css('width', widthStar + 'px');
    $(star).css('height', heightStar + 'px');

    setInterval(
        function () {
            const red = Math.floor(Math.random() * 255);
            const green = Math.floor(Math.random() * 255);
            const blue = Math.floor(Math.random() * 255);
            $(star).children('svg').children('path').css('transition', '.5s')
            $(star).children('svg').children('path').css('fill', `rgb(${red}, ${green}, ${blue})`)
        },
        200
    );
    
    // $(star).css('margin-left', Math.abs(Math.floor(Math.random() * 1100) - 51) + 'px');
    // $(star).css('margin-top', Math.abs(Math.floor(Math.random() * 300) - 51) + 'px');

    $('div.field').append(star);
});