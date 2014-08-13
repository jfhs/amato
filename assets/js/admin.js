$(document).ready(function() {
    $(".add_more_images").click(function() {
        var ind = parseInt($(this).attr("data-lastindex"));
        --ind;
        var el = $("<input>").attr({
            type: 'file',
            name: $(this).attr("data-fname") + "[" + ind + "][" + $(this).attr("data-propname") + "]"
        });
        $(this).attr("data-lastindex", ind);
        $(this).before(el).before("<br>");
        return false;
    })
    $(".add_more_related").click(function() {
        var tbl = $(this).prevAll("table");
        var e = tbl.find("tr:last").clone();
        tbl.append(e);
        return false;
    })
    $("#lang_select").change(function() {
        var lang = $(this).val();
        $("[data-lang]").each(function() {
            if ($(this).attr("data-lang") == lang) {
                $(this).show();
            } else {
                $(this).hide();
            }
        })
    })


    $(".datepicker").datepicker($.datepicker.regional["ru"]);
})






/** INSTINCT **/
$(document).ready( function(){
    var filterStr = new String();
    $('.dropdown-menu').on('mouseleave',function(){$(this).siblings('.dropdown-toggle').click()});

    // $('.table-content').children('tbody').children('tr').click(function(){
    //     $(this).toggleClass('info');
    // });
    // $( "#sortable" ).sortable({stop:function(e,i){
    //         //for(var j in i)
    //         console.log(i.item.index())
    //     }});
    // $( "#sortable1" ).sortable();
    $(".cb-enable").click(function(){
        var parent = $(this).parents('.s');
        $('.cb-disable',parent).removeClass('selected');
        $(this).addClass('selected');
        $('.checkbox',parent).attr('checked', true);
    });
    $(".cb-disable").click(function(){
        var parent = $(this).parents('.s');
        $('.cb-enable',parent).removeClass('selected');
        $(this).addClass('selected');
        $('.checkbox',parent).attr('checked', false);
    });
    if($('.scrollaff').height() >= window.screen.height){
        $('.affix, .slidebar h4').css({'position':'absolute'})
    }
    $('#delAll .btn-primary').click(function(){
        $('.ids').each(function(i,e){
            $.get('/admin//delete/'+$(e).attr('id'));
            $(e).parent().parent().remove();
        });


    })

    $('.cb-disable, .cb-enable').on('click', function(){
        var checkbox    = $(this).parent().children('input:checkbox');
        var status      = checkbox.attr('checked')?1:0;
        var attr        = checkbox.data('attr');
        var id          = checkbox.data('id');
        var type      = checkbox.data('type');
        var data = {};
        data[attr] = status;
        $.ajax({
            url: '/index.php/control/' + type + '/' + id,
            data: data,
            type: 'POST',
            error: function() {
                alert('Ошибка при сохранении!');
            }
        });
    })

    $('.filter').on('keyup', function(){
        var val = $(this).val().toLowerCase();
        $('.table-content').find('tr:gt(0)').each(function(i,e){
            var str = $(e).children('.title').text()+' '+$(e).children('.text').text();
            str +=' '+$(e).children('.name').text()+' '+$(e).children('.id').text();
            str +=' '+$(e).children('.created_at').text()+' '+$(e).children('.phone').text();
            if(str.toLowerCase().indexOf(val)+1)
                $(e).show();
            else
                $(e).hide();
        })
    })

    $('.filter').on('focusin', function(){
        focus();
    }).on('focusout', function(){

            $('.filterElements').find(':checkbox:checked').each(function(i,e){
                var id = $(e).attr('id');
                filterStr += ' '+$('.table-content').find('tr:gt(0)').children('.'+id).text();
            })
        })

    function focus(){
        $('.filterElements').fadeToggle();
    }
});