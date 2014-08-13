$(document).ready(function() {
    $(".set_menu a").click(function() {
        var id = $(this).attr("data-setid");
        var set = $("#set" + id);
        set.show();
        set.siblings(".set").hide();
        $(this).siblings().removeClass("active");
        $(this).addClass("active");
        return false;
    })

    $(".b_posterInner .left, .b_posterInner .right, .rightP, .leftP, .b_posterInner .gallery .item").click(function() {
        var cur = $(".b_posterInner .middle .img:visible");
        var n;
        if ($(this).hasClass("item")) {
            n = $(".middle .img[data-imgid=" + $(this).attr("data-imgid") + "]");
        } else {
            n = ($(this).hasClass("left")||$(this).hasClass("leftP"))?cur.prev():cur.next();
        }
        if (n.size() > 0) {
            cur.hide();
            $(".gallery .item[data-imgid=" + cur.attr("data-imgid") + "]").removeClass("active");
            n.show();
            $(".gallery .item[data-imgid=" + n.attr("data-imgid") + "]").addClass("active");

            var w = $("#img_container").parent().width();
            var per_img = 125;//w/5;
            var cur_pos = parseInt($("#img_container").css('margin-left'));
            var left = n.prevAll().size() * per_img;
            var right = left + per_img;
            var diff = left + cur_pos;
            if ((diff > w) || (diff < 0)) {
                $("#img_container").css('margin-left', -left);
            }
            diff = right + cur_pos;
            if ((diff > w) || (diff < 0)) {
                $("#img_container").css('margin-left', -right + w);
            }
        }
        return false;
    })
    var sounds = {};
    var currentSound = null;
    function padNumber(n) {
        if (n < 10) {
            return '0' + n;
        }
        return n;
    }
    function formatSeconds(s) {
        var min = Math.floor(s/60);
        var sec = s%60;
        return padNumber(min) + ':' + padNumber(sec);
    }
    $(".playList .play").click(function() {
        var id = $(this).parent().attr("data-id");
        if (typeof(sounds[id]) == 'undefined') {
            var duration = parseInt($(this).parent().attr("data-duration"));
            sounds[id] = soundManager.createSound({
                id: 'mySound' + id,
                url: $(this).parent().attr("data-source"),
                autoLoad: true,
                autoPlay: true,
                whileplaying: function(eventPosition) { // fire at 1 second
                    $(".b_musicPlayer .progress").css("width", this.position/1000/duration*100 + "%");
                    $(".player .time").text(formatSeconds(Math.round(this.position/1000)));
                }
            });
        }
        $(".currentSong").text($(this).siblings(".name").text());
        $(".player .time").text($(this).siblings(".time").text());
        soundManager.stopAll();
        if ($(".muted").size() > 0) {
            soundManager.muteAll();
        }
        $(".pause").removeClass("pause");
        sounds[id].play();
        currentSound = id;
    })
    $(".playList .name").click(function() {
        $(this).siblings(".play").click();
        return false;
    })
    $(".b_musicPlayer .mute").click(function() {
        if ($(this).hasClass("muted")) {
            soundManager.unmuteAll();
        } else {
            soundManager.muteAll();
        }
        $(this).toggleClass("muted");
    })
    $(".b_musicPlayer .buttons .play").click(function() {
        $(this).toggleClass("pause");
        $("[data-id=" + currentSound + "] .play").toggleClass("pause");
        soundManager.togglePause("mySound" + currentSound);
    })
    $(".b_musicPlayer .next, .b_musicPlayer .previouse").click(function() {
        if (currentSound == null) {
            return;
        }
        var cur = $(".playList .item[data-id=" + currentSound + "]");
        var n = $(this).hasClass("next")?cur.next():cur.prev();
        if (n.size()) {
            n.find(".play").click();
        }
    })


    $(".calculate").click(function() {
        $("#calcform [type=submit]").click();
    })

    $("#calcform").submit(function() {
        $("#answer .item").hide();
        var height = parseFloat($("#height").val());
        var width = parseFloat($("#width").val());
        /*if (isNaN(height) || isNaN(width)) {
            alert("Неверно введены размеры!");
            return false;
        }*/
        var slider = $("#slider").slider('option', 'value');
        var total_area = width * height * slider/10;
        if (total_area <= 0) {
            alert("Неверно введены размеры!");
            return false;
        }
        $("#area").val(total_area);
        $("#answer .item[data-id]").each(function() {
            var per_unit = parseFloat($(this).attr("data-perunit"));
            $(this).show()
                .find(".amount").text(Math.round(total_area*per_unit/1000, 2) + " кг");
        })
        $("#answer").show();
        return false;
    })

    $(".question").click(function() {
        $(this).siblings(".answer").slideToggle();
    })

    $("#update_captcha").click(function() {
        $(this).siblings("img").attr("src", '/captcha/default?rnd=' + Math.random());
    })

    $("#slider").slider({
        min: 10,
        max: 50,
        value: 10,
        step: 10,
        range: "min",
        slide: function(e, ui) {
            $(".ui-slider-handle").text(ui.value + " мм");
        },
        create: function(e, ui) {
            $(".ui-slider-handle").text("10 мм");
        }
    });

    $(".printResult a").click(function() {
        var cpy = $(".l_content .l_right").clone();
        cpy.find(".b_breadcrumbs").remove();
        cpy.find(".printResult").remove();
        var html = "";
        $("style,link[rel=stylesheet]").each(function() {
            html += $(this).clone().wrap('<p>').parent().html();
        })
        html += cpy.html();

        var WinPrint = window.open('', '', 'letf=0,top=0,width=680,height=900,toolbar=0,scrollbars=0,status=0');
        WinPrint.document.write(html);
        WinPrint.document.close();
        WinPrint.focus();
        WinPrint.window.print();
        //WinPrint.close();
        /*
        window.frames["print_frame"].document.body.innerHTML = html;
        window.frames["print_frame"].window.focus()
        window.frames["print_frame"].window.print()*/
        return false;
    })
})