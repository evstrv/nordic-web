let flag = true;

$('.burger').click(function () {
    if(flag === true) {
        $(this).toggleClass('visible');
        $(".menu_mobile").fadeToggle(300, 'swing', function () {
            flag = true;
        });
        flag = false;
    }
});


var radio = document.getElementsByName('attraction');
for (let i = 0; i < radio.length; i++) {
    radio[i].addEventListener("click", function () {
        var svg = document.getElementById(radio[i].value);
        for (let i = 0; i < radio.length; i++) {
            document.getElementById(radio[i].value).classList.remove('new-svg');
        }
        svg.classList.add('new-svg');
    });
}

for (let el of document.querySelectorAll('div.request table td label')) {
    el.addEventListener('click', function () {
        this.parentElement.parentElement.classList.toggle('checked');
    });
}