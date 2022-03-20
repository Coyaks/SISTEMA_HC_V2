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
                        <label for="">Ingrese código de Historia Clínica</label>
                            <div class="input-group mb-3">
                                <input type="text" name="num_hc" id="num_hc" class="form-control" placeholder="" aria-describedby="basic-addon2" required>

                                <div class="input-group-append pointer btnVerificarHc">
                                    <span class="input-group-text btn btn-success" id="basic-addon2">
                                        validar
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Tipo de documento</label>
                                <select name="tipo_doc" id="tipo_doc" class="form-control">
                                    <option value="DNI">DNI</option>
                                    <option value="CARNET DE EXTRANJERIA">CARNET DE EXTRANJERIA</option>
                                    <option value="PASAPORTE">PASAPORTE</option>
                                    <option value="RUC">RUC</option>
                                </select>
                            </div>


                        </div>
                        <div class="col-lg-6">
                            <label for="">N° de documento</label>
                            <div class="input-group mb-3">
                                <input type="text" name="num_doc" id="num_doc" class="form-control" placeholder="Ingresa su N° de documento" aria-describedby="basic-addon2" required>

                                <div class="input-group-append pointer btnBuscarDni">
                                    <span class="input-group-text" id="basic-addon2">
                                        <span class="material-icons">
                                            search
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                        </div>
                        <div class="col-lg-6">

                            <div class="form-group">
                                <label for="">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-lg-6">

                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" class="form-control" id="email" name="email" required>
                            </div>

                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                        </div>
                    </div>

                    <div class="text-center rta_back">
                        
                    </div>

                    <div class="text-center mt-3 mb-2">
                        <button type="submit" class="btn btn-success w-100 btnRegister" disabled><i class="fa fa-fw fa-lg fa-check-circle"></i> Registrarse</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>