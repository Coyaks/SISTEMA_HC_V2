<!-- MODAL REGSITER -->
<div class="modal fade modalRegister" id="" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Regístrate</h5>
                <img src="<?= media('img/close.png') ?>" alt="close" class="close" data-dismiss="modal" aria-label="Close">
            </div>
            <div class="modal-body">
                <!-- FORM -->
                <form id="formRegister">
                    <div class="row">
                        <div class="col-lg-6">
                            <label class="mdc-text-field mdc-text-field--outlined w-100">
                                <span class="mdc-notched-outline">
                                    <span class="mdc-notched-outline__leading"></span>
                                    <span class="mdc-notched-outline__notch">
                                        <span class="mdc-floating-label" id="my-label-id">Nombre</span>
                                    </span>
                                    <span class="mdc-notched-outline__trailing"></span>
                                </span>
                                <!-- Nombre -->
                                <input type="text" class="mdc-text-field__input" id="nombre" name="nombre" autofocus autocomplete="off" required>
                                <span class="material-icons-outlined mdc-text-field__icon mdc-text-field__icon--trailing">
                                    face
                                </span>
                            </label>
                        </div>
                        <div class="col-lg-6">
                            <label class="mdc-text-field mdc-text-field--outlined w-100">
                                <span class="mdc-notched-outline">
                                    <span class="mdc-notched-outline__leading"></span>
                                    <span class="mdc-notched-outline__notch">
                                        <span class="mdc-floating-label" id="my-label-id">Apellidos</span>
                                    </span>
                                    <span class="mdc-notched-outline__trailing"></span>
                                </span>
                                <!-- Apellidos -->
                                <input type="text" class="mdc-text-field__input" id="apellidos" name="apellidos" autocomplete="off" required>
                                <span class="material-icons-outlined mdc-text-field__icon mdc-text-field__icon--trailing">
                                    face
                                </span>
                            </label>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-lg-6">
                            <label class="mdc-text-field mdc-text-field--outlined w-100">
                                <span class="mdc-notched-outline">
                                    <span class="mdc-notched-outline__leading"></span>
                                    <span class="mdc-notched-outline__notch">
                                        <span class="mdc-floating-label" id="my-label-id">Email</span>
                                    </span>
                                    <span class="mdc-notched-outline__trailing"></span>
                                </span>
                                <!-- Apellidos -->
                                <input type="email" class="mdc-text-field__input" id="email" name="email" autocomplete="off" required>
                                <span class="material-icons-outlined mdc-text-field__icon mdc-text-field__icon--trailing">
                                    face
                                </span>
                            </label>
                        </div>

                        <div class="col-lg-6">
                            <label class="mdc-text-field mdc-text-field--outlined w-100 text-field-pass">
                                <span class="mdc-notched-outline">
                                    <span class="mdc-notched-outline__leading"></span>
                                    <span class="mdc-notched-outline__notch">
                                        <span class="mdc-floating-label" id="my-label-id">Password</span>
                                    </span>
                                    <span class="mdc-notched-outline__trailing"></span>
                                </span>
                                <!-- Password -->
                                <input type="password" class="mdc-text-field__input toggle-password" id="password" name="password" autocomplete="off" required>
                                <!-- ICON EYE -->
                                <span id="icon-view-pass2">
                                    <span class="material-icons-outlined mdc-text-field__icon mdc-text-field__icon--trailing">
                                        visibility_off
                                    </span>
                                </span>

                            </label>
                        </div>
                    </div>

                    <div class="text-center rta_back">
                            <!-- <p class="mt-3 bg-success">Registrado Correctamente!</p> -->
                    </div>

                    <div class="text-center mt-3 mb-2">
                        <button type="submit" class="btn btn-success w-100"><i class="fa fa-fw fa-lg fa-check-circle"></i> Registrarse</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>