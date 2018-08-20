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


/*
 * Exibe/Esconde os itens da lista de mapas
 *
 * @return  void
 * @param   
 * @author  Alvino Rodrigues
*/
function exibirMapa() {
    jQuery('.mapas-cidade').on('click',function() {
        jQuery(this).parent('').toggleClass('ativo');
    });
}

