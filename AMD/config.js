//config.js

requirejs.config({
    //baseUrl: 'AMD',
    paths: {
        jquery: 'lib/Jquery/jquery-3.6.0.min',
        jquery_mask: 'lib/Jquery.Mask/jquery.mask',
        bootstrap: 'lib/Bootstrap/bootstrap.bundle',
        datatables: 'lib/DataTables/jquery.dataTables',
        datatables_bs4: 'lib/DataTables/dataTables.bootstrap4',
        datatables_settings: 'lib/DataTables/dataTables.customSettings',
        datatables_JSZip: 'lib/DataTables/JSZip/jszip',
        datatables_Buttons: 'lib/DataTables/Buttons/dataTables.buttons',
        datatables_Buttons_print: 'lib/DataTables/Buttons/buttons.print',
        datatables_Buttons_html5: 'lib/DataTables/Buttons/buttons.html5',
        datatables_Buttons_Bootstrap4: 'lib/DataTables/Buttons/buttons.bootstrap4',

        site_methods: 'scripts/site_methods',
        admin_methods: 'scripts/admin_methods',
        user_methods: 'scripts/user_methods',
        manage_methods: 'scripts/manage_methods'
    }
});