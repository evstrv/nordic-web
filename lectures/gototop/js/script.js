$('.menu_mobile').click(function () {
    $('.menu_mobile').toggleClass('open');

    if($('header > nav').css('display') === 'none') {
        // анимация крестика
        $('.menu_mobile > span:nth-child(2)').css('display', 'none');
        $('.menu_mobile > span:first-child').css('margin', 0);
        $('.menu_mobile > span:last-child').css('margin', '-4px 0 0');

        for(let i = 5; i <= 45; i+=5) {
            setTimeout(
                function () {
                    $('.menu_mobile > span:first-child').css('transform', `rotate(${i}deg)`);
                    $('.menu_mobile > span:last-child').css('transform', `rotate(-${i}deg)`);
                },
                30 * (i / 5 - 1)
            );
        }
        
        // показ/скрытие меню
        $("header > nav").css('display', 'flex');
    } else {
        // анимация крестика
        for(let i = 45; i >= 0; i-=5) {
            setTimeout(
                function () {
                    $('.menu_mobile > span:first-child').css('transform', `rotate(${i}deg)`);
                    $('.menu_mobile > span:last-child').css('transform', `rotate(-${i}deg)`);
                },
                30 * Math.abs((i / 5 - 1) - 9)
            );
        }

        setTimeout (
            function () {
                $('.menu_mobile > span:nth-child(2)').css('display', 'block');
                $('.menu_mobile > span:first-child').css('margin', '0 0 5px 0');
                $('.menu_mobile > span:last-child').css('margin', 'initial');
            },
            300
        );
        
        // показ/скрытие меню
        $("header > nav").css('display', 'none');
    }
});

$('.menu_mobile_v2').click(function () {
    $(this).toggleClass('visible');
});

// -----> slider <-----

for(let el of document.getElementsByClassName('arrow')) {
    // Нажать на стрелку направления
    el.addEventListener('click', function () {
        // Смещение активной картинки влево/вправо на всю ее ширину
        let count = parseInt(document.getElementsByClassName('slider_wrap')[0].style.transform.replace('translateX', '')
                                                                                              .replace('(','')
                                                                                              .replace(')','')
                                                                                              .replace('%',''));
        if (!count) {
            count = 0;
        }                                                                                  
        if(this.classList.contains('left')) {
            if (count === 0) {
                // Прокрутить в конец
                for (let i = 0; i >= -75; i-=5) {
                    setTimeout(
                        function () {
                            document.getElementsByClassName('slider_wrap')[0].style.transform = `translateX(${i}%)`;
                        },
                        50 * ((Math.abs(i) + count) / 10)
                    );
                }
            } else {
                document.getElementsByClassName('slider_wrap')[0].style.transform = `translateX(${count + 25}%)`;

                for (let i = count; i <= count + 25; i+=5) {
                    setTimeout(
                        function () {
                            document.getElementsByClassName('slider_wrap')[0].style.transform = `translateX(${i}%)`;
                        },
                        50 * ((i - count) / 5)
                    );
                }
            }
        } else if (this.classList.contains('right')) {
            if (count === -75) {
                // Прокрутить в начало
                for (let i = 75; i >= 0; i-=5) {
                    setTimeout(
                        function () {
                            document.getElementsByClassName('slider_wrap')[0].style.transform = `translateX(${-i}%)`;
                        },
                        50 * ((-i - count) / 10)
                    );
                }
            } else {
                document.getElementsByClassName('slider_wrap')[0].style.transform = `translateX(${count - 25}%)`;

                for (let i = count; i >= count - 25; i-=5) {
                    setTimeout(
                        function () {
                            document.getElementsByClassName('slider_wrap')[0].style.transform = `translateX(${i}%)`;
                        },
                        50 * ((Math.abs(i) + count) / 5)
                    );
                }
            }
        }
        // Смещение актвного текста влево/вправо за картинкой
        // Установка новой картинки и текста в активную область
    });
}

for (let el of document.querySelectorAll('div.feedbacks table td label')) {
    el.addEventListener('click', function () {
        this.parentElement.parentElement.classList.toggle('checked');
    });
}

// document => <Element>(html)
// document.[getElementById, querySelector] => <Element>
// document.[getElementByClassName, getElementByTagName, querySelectorAll] => <Element>
// document.createElement('div') => <Element>
// Element.appendChild(<Element>)
// Element.classList.[add, remove, toggle, contains]
// Element.style => {<css property name>: <css property value>}
// InputElement.[value, checked, type]
// Element.[id, name, method, action]
// Element.parentElement => <Element>

// for (let i = 0; i < <array>.lenght; i++)
// for (let i in <array|object>)

console.log(document.getElementsByName('name'));
for (let el of document.getElementsByName('name')) {
    console.log(el.value);
}