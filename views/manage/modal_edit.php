<div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="modaleditTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaleditTitle">Правка</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="firstnamemodal">Имя</label>
                            <input type="text" class="form-control" id="firstnamemodal" placeholder="Имя" value="" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="lastnamemodal">Фамилия</label>
                            <input type="text" class="form-control" id="lastnamemodal" placeholder="Фамилия" value="" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="patronymicmodal">Отчество</label>
                            <input type="text" class="form-control" id="patronymicmodal" placeholder="Отчество" value="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                            <label for="loginmodal">Логин</label>
                            <input type="text" class="form-control" id="loginmodal" placeholder="Логин" value="" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="passwordmodal">Пароль</label>
                            <input type="text" class="form-control" id="passwordmodal" placeholder="Пароль" value="" required>
                        </div>
                        <div class="col-md-6 mb-3 postselect">
                            <label for="postmodal">Специальность</label>
                            <select id="postmodal" class="custom-select">
                                <?php
                                foreach ($posts AS $post) {
                                    echo '<option id="' . $post['name'] . 'option" value="' . $post['id'] . '" >' . $post['name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                        <button type="button" class="btn btn-primary" id="modaleditconfirm">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>