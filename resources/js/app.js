
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('humanize-duration');

jQuery(document).ready(function($) {
    $('.task_select').select2({
        placeholder: 'Uzduotis',
        width: '250px',
        tags: true,
        theme: "classic",
        createTag: function (params) {
            return {
                id: params.term,
                text: params.term,
                newOption: true
            }
        },
        templateResult: function (data) {
            var $result = $("<span></span>");

            $result.text(data.text);

            if (data.newOption) {
                $result.append(" <em>(Nauja uzduotis)</em>");
            }

            return $result;
        }
    });
    $('.project_select').select2({
        placeholder: 'Projektas',
        width: '150px',
        theme: "classic"
    });
    $(function() {
        $('input[name="datetimes"]').daterangepicker({
            timePicker: true,
            timePicker24Hour: true,
            startDate: moment().startOf('hour'),
            endDate: moment().startOf('hour').add(1, 'hour'),
            locale: {
                format: 'YYYY.MM.DD HH:mm:ss'
            }
        });
    });
    $('#timer').countimer({
        autoStart: true
    });
    var div = document.getElementsByClassName("humanize");
    var i;
    for (i = 0; i < div.length; i++) {
        var myData = div[i].textContent;
        div[i].innerHTML = humanizeDuration(myData*1000, {language : 'lt'});
    }
    $('.table-hover tr').on('click', function() {
        $(this).parent().next().addClass('open-timers').siblings().removeClass('open-timers');
    });
});

