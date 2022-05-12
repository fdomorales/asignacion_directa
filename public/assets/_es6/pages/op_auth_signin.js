/*
 *  Document   : op_auth_signin.js
 *  Author     : pixelcave
 *  Description: Custom JS code used in Sign In Page
 */

// Form Validation, for more examples you can check out https://github.com/jzaefferer/jquery-validation
class OpAuthSignIn {
    /*
     * Init Sign In Form Validation
     *
     */
     static initValidationSignIn() {
        jQuery('.js-validation-signin').validate({
            errorClass: 'invalid-feedback animated fadeInDown',
            errorElement: 'div',
            errorPlacement: (error, e) => {
                jQuery(e).parents('.form-group > div').append(error);
            },
            highlight: e => {
                jQuery(e).closest('.form-group').removeClass('is-invalid').addClass('is-invalid');
            },
            success: e => {
                jQuery(e).closest('.form-group').removeClass('is-invalid');
                jQuery(e).remove();
            },
            rules: {
                'login-username': {
                    required: true,
                    minlength: 3
                },
                'login-password': {
                    required: true,
                    minlength: 5
                }
            },
            messages: {
                'login-username': {
                    required: 'por favor ingrese un nombre de usuario',
                    minlength: 'Su nombre de usuario debe constar de al menos 3 caracteres'
                },
                'login-password': {
                    required: 'Por favor proporcione una contraseña',
                    minlength: 'Su contraseña debe tener al menos 5 caracteres'
                }
            }
        });
    }

    /*
     * Init functionality
     *
     */
     static init() {
        this.initValidationSignIn();
    }
}

// Initialize when page loads
jQuery(() => { OpAuthSignIn.init(); });
