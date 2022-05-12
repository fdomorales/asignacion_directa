/*
 *  Document   : be_pages_login.js
 *  Author     : UTI
 *  Description: Custom JS code used in Dashboard Page
 */

 class BePageslogin {
    /*
     * Init Onboarding modal
     *
     */
     static initOnboardingModal() {
        // Show Onboarding Modal by default
        if(jQuery('#mensaje').val().length > 0){
            jQuery('#modal-onboarding').modal('show');
            jQuery('#imprimir-mensaje').html(jQuery('#mensaje').val());
        }
    }
    /*
     * Init functionality
     *
     */
     static init() {
        this.initOnboardingModal();
    }
}

// Initialize when page loads
jQuery(() => { BePageslogin.init(); });
