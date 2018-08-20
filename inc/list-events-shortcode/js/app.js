jQuery( document ).ready(function() {
    jQuery('#date_listevents').daterangepicker({
        startDate:  moment().format('DD/MM/YYYY'),
        endDate:    moment().add(jQuery('#date_listevents').data('range'), 'days').format('DD/MM/YYYY'),
        locale: {
            format:         'DD/MM/YYYY',
            applyLabel:     'Buscar',
            cancelLabel:    'Cancelar',
            daysOfWeek: [
                "Do",
                "Seg",
                "Ter",
                "Qua",
                "Qui",
                "Sex",
                "Sab"
            ],
            monthNames: [
                "Janeiro",
                "Fevereiro",
                "Março",
                "Abril",
                "Maio",
                "Junho",
                "Julho",
                "Agosto",
                "Setembro",
                "Outubro",
                "Novembro",
                "Dezembro"
            ],
        }
    });

    getEvents();

    jQuery('#date_listevents').on('apply.daterangepicker', function(ev, picker) {
        getEvents();
    });
    
});

function getEvents(){
    jQuery('.list_spaces').html('');
    jQuery('#loading').show('fast');

    var date_listevents = jQuery('#date_listevents').data('daterangepicker');

    var url = jQuery('#date_listevents').data('url')                 +
        '&@from='   + date_listevents.startDate.format('YYYY-MM-DD') +
        '&@to='     + date_listevents.endDate.format('YYYY-MM-DD');

    //if (states!="") {
    //    url+=`&space:En_Estado=IN(${states})`;
    //}
    //console.log(url);

    jQuery('#date_listevents span').html(date_listevents.startDate.format('DD/MM/YYYY') + ' - ' + date_listevents.endDate.format('DD/MM/YYYY'));

    jQuery.ajax({
        url: url,
        type: 'GET',
        data: {},
        success: function(response) {
            showEvents(response);
        }
    });
}

function showEvents(events){
    jQuery('#loading').hide('fast');
    baseurl = jQuery('#date_listevents').data('baseurl');

    html = '';
    for (var i = 0; i < events.length; i++) {
        thumb = '';
        if(typeof events[i]['@files:avatar.avatarBig'] != 'undefined')
            thumb = '<img class="list_events_image" src="' + events[i]['@files:avatar.avatarBig'].url + '">';

        spaces = new Array();

        html += `<div class="row no-gutters list_events_item">
                    <div class="col-12 col-lg-5">${thumb}</div>
                    <div class="col-1"></div>
                    <div class="col-12 col-lg-6">
                        <div class="list_events__box">
                            <span class="list_events__category"><a href="${baseurl}/evento/${events[i].id}" target="_blank">${events[i].name}</a></span>
                            <p class="list_events__description">${events[i].shortDescription}</p>`;


                            periods = new Array();
                            for (var y = 0; y < events[i].occurrences.length; y++) {
                                if(typeof periods[events[i].occurrences[y].space.name] == 'undefined')
                                    periods[events[i].occurrences[y].space.name] = '';

                                spaces[events[i].occurrences[y].space.name] = {
                                    name:events[i].occurrences[y].space.name,
                                };

                                periods[events[i].occurrences[y].space.name] +=
                                    `<span class="details__date">
                                        <i class="glyphicon glyphicon-time"></i> ${events[i].occurrences[y].rule.description}, ${events[i].occurrences[y].rule.price}
                                    </span>`;
                            }

                            for (space in spaces) {
                                html += `${periods[spaces[space].name]}<span class="details__place"><i class="glyphicon glyphicon-map-marker"></i> ${spaces[space].name}</span>`;
                            }

            html += '</div></div></div>';
    }

    jQuery('.list_spaces').append(html);
}

/*
 * Movimenta o label pra fora dos campos do form ao clique
 *
 * @return  void
 * @param   
 * @author  Alvino Rodrigues
*/

function moverLabels() {
    var _input = jQuery('.form-style').find('input[type=text],textarea');

    _input
        .on({
            'focus': function() {
                var _this = jQuery(this);

                if (_this.val() == '') {
                    _this.parents('.linha').addClass('ativa');
                }
            },
            'blur': function() {
                var _this = jQuery(this);

                if (_this.val() == '') {
                    _this.parents('.linha').removeClass('ativa');
                }
            }
        });

    // Verifica os campos ao carregar a página
    jQuery(document).ready(function() {
        _input.each(function() {
            var _this = jQuery(this);

            if (_this.val() != '') {
                _this.parents('.linha').addClass('ativa');
            }
        });
    });
}

/*
 * Verifica os campos vazios ou inválidos do formulário
 *
 * @return  boolean
 * @param   
 * @author  Alvino Rodrigues
*/

function validarFormulario() {
    jQuery('.form-validar').on('submit',function() {
        var _form = jQuery(this),
            erro = false;

        _form
            .find('.erro')
            .removeClass('erro')
            .end()
            .find('.sucesso')
            .removeClass('sucesso');

        _form.find('.obrigatorio').each(function() {
            var _this = jQuery(this);

            if (_this.val() == '') {
                _this.parent().addClass('erro');
                erro = true;
            } else {
                _this.parent().addClass('sucesso');
            }
        });

        _form.find('.obrigatorio-email').each(function() {
            var _this = jQuery(this);

            if( !validarEmail(_this.val()) ) {
                _this.parent().addClass('erro');
                erro = true;
            } else {
                _this.parent().addClass('sucesso');
            }
        });

        return !erro;
    });
}

/*
 * Valida o campo email
 *
 * @return  boolean
 * @param   string email
 * @author  Alvino Rodrigues
*/

function validarEmail(email) {
    var expr = /^\w+([\.+-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

    if(email.search(expr) == -1) {
        return false;
    }

    return true;
}