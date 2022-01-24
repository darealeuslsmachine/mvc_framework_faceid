define([
    'jquery',
    'bootstrap',
    'site_methods',
    'admin_methods',
    'user_methods',
    'manage_methods'
], function ($, bootstrap, site_methods,admin_methods,user_methods, manage_methods) {
    site_methods.backlightNavBar();

    admin_methods.admintableAJAX();
    admin_methods.showUploadedPhoto();
    admin_methods.editUserAdmin();
    admin_methods.deleteUserAdmin();
    admin_methods.showPassAdmin();
    admin_methods.posttableAJAX();
    admin_methods.allposttableAJAX();

    user_methods.showPassUserProfile();
    user_methods.showPassUserEdit();
    user_methods.showUploadedPhoto();
    user_methods.searchPostParent();
    user_methods.deleteSubordination();
    user_methods.addSubordination();
    user_methods.saveSubordination();
    user_methods.phoneMask();

    manage_methods.manageTableAJAX();
    manage_methods.searchPost();
    manage_methods.editUser();
    manage_methods.deleteUser();
    manage_methods.searchPostEdit();
});