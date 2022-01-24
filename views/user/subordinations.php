<div class="row gutters-sm">
    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-body">
                <?php
                if (!empty($user['subs'])) {
                    foreach ($user['subs'] AS $sub) {
                        echo '<div class="row" id="subordination' . $sub['subid'] . '">
                                    <input type="hidden" value="' . $user['id'] . '" id="inputhidden_userid">
                                    <input type="hidden" value="' . $sub['subid'] . '" id="inputhidden_subid">
                                    <div class="col-sm">
                                        <h6 class="mb-0">Специальность</h6>
                                    </div>
                                    <div class="col-sm-3 text-secondary" id="div_postedit' . $sub['subid'] . '">
                                         <select class="custom-select select-postedit-show" id="edit_selectpost' . $sub['subid'] . '">
                                            <option value="' . $sub['postid'] . '" selected hidden>' . $sub['postname'] . '</option>
                                        </select>
                                    </div>  
                                     <div class="col-sm">
                                        <h6 class="mb-0">Руководитель</h6>
                                    </div>  
                                    <div class="col-sm-3" id="div_parentedit' . $sub['subid'] . '">
                                         <select class="custom-select select-parentedit-show" id="edit_selectparent' . $sub['subid'] . '">
                                            <option value="' . $sub['parentid'] . '" selected hidden>' . $sub['parentfullname'] . '</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-1 px-0">
                                         <a href="#" class="save-subordination" id="save_subordination' . $sub['subid'] . '"><i class="fas fa-save"></i></a>
                                    </div>    
                                    <div class="col-sm-1 px-0">
                                         <a href="#" class="delete-subordination" id="delete_subordination' . $sub['subid'] . '"><i class="fas fa-trash-alt"></i></a>
                                    </div>                      
                                </div>                                        
                                <br>';
                    }
                };
                ?>

                <p>
                    <a class="btn btn-success" data-toggle="collapse" href="#collapseAddSubordination" role="button" aria-expanded="false" aria-controls="collapseAddSubordination">
                        Добавить специальность
                    </a>
                </p>
                <div class="collapse" id="collapseAddSubordination">
                    <div class="card card-body">
                        <div class="row">
                            <div class="col-sm">
                                <h6 class="mb-0">Специальность</h6>
                            </div>
                            <div class="col-sm-3 text-secondary" id="div_addPost">
                                <select class="custom-select select-postedit-show" id="select_addPost">
                                    <option></option>
                                </select>
                            </div>
                            <div class="col-sm">
                                <h6 class="mb-0">Руководитель</h6>
                            </div>
                            <div class="col-sm-3 text-secondary" id="div_addParent">
                                <select class="custom-select select-postedit-show" id="select_addParent">
                                    <option></option>
                                </select>
                            </div>
                            <div class="col-sm" id="add_SubordinationLink">
                                <a href="#" style="color: green;"><i class="fas fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>