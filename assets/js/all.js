$(document).ready(function() {
    var children = $("#gallery_container").children();
    var cur = 0;
    var width = children.first().width();
    $(".prevCarousel").click(function() {
        if (--cur < 0) {
            cur = children.size() - 1;
        }
        $("#gallery_container").stop().animate({"margin-left": -cur*width});
        return false;
    })
    $(".nextCarousel").click(function() {
        if (++cur >= children.size()) {
            cur = 0;
        }
        $("#gallery_container").stop().animate({"margin-left": -cur*width});
        return false;
    })

    var interval = setInterval(function() {
            $(".nextCarousel").click();
        }, 4000);

    $(".carousel").hover(function() {
        clearInterval(interval);
    }, function() {
        interval = setInterval(function() {
            $(".nextCarousel").click();
        }, 4000);
    })

    $("#form").submit(function() {
        $.ajax({
            url: $(this).attr("action"),
            type: 'POST',
            data: $(this).serialize(),
            success: function(d) {
                if (d == 'ok') {
                    alert('Ваше сообщение отправлено');
                } else {
                    alert('Данные указаны неверно');
                }
                $(this).find("[type=submit]").removeAttr("disabled");
            }
        });
        $(this).find("[type=submit]").attr("disabled");
        return false;
    })
});