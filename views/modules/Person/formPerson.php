<!-- Horizontal Form -->
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Formulario de Registro del Docente</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form class="form-horizontal" method="post" id="frmCreatePerson" name="frmCreatePerson" action="../../../app/Controllers/PersonController.php?action=create">
        <div class="card-body">
            <li class="list-Dates"><i class="fas fa-phone-alt" id="icon-iconos"></i>Datos Basicos</li>
            <!--Documento del Docente-->
            <div class="form-group row">
                <label for="documentPerson" class="col-sm-2 col-form-label">Documento</label>
                <div class="col-sm-10">
                    <input required type="number" minlength="6" class="form-control" id="documentPerson" name="documentPerson" placeholder="Ingrese su documento">
                </div>
            </div>
            <!--Nombre del docente-->
            <div class="form-group row">
                <label for="namePerson" class="col-sm-2 col-form-label">Nombres</label>
                <div class="col-sm-10">
                    <input required type="text" class="form-control" id="namePerson" name="namePerson" placeholder="Ingresa los nombres">
                </div>
            </div>
            <!--Apellidos del docente-->
            <div class="form-group row">
                <label for="lastNamePerson" class="col-sm-2 col-form-label">Apellidos</label>
                <div class="col-sm-10">
                    <input required type="text" class="form-control" id="lastNamePerson" name="lastNamePerson" placeholder="Ingresa los Apellidos">
                </div>
            </div>
            <!--RH del docente-->
            <div class="form-group row">
                <label for="rhPerson class="col-sm-2 col-form-label">RH</label>
                <div class="col-sm-10">
                    <select id="rhPerson" name="rhPerson" class="custom-select">
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                    </select>
                </div>
            </div>
            <!--Telefono del Docente-->
            <div class="form-group row">
                <label for="phonePerson" class="col-sm-2 col-form-label">Telefono</label>
                <div class="col-sm-10">
                    <input required type="number" minlength="6" class="form-control" id="phonePerson" name="phonePerson" placeholder="Ingrese su telefono">
                </div>
            </div>
            <!--Direccion del Docente-->
            <div class="form-group row">
                <label for="adressPerson" class="col-sm-2 col-form-label">Direccion</label>
                <div class="col-sm-10">
                    <input required type="text" class="form-control" id="adressPerson" name="adressPerson" placeholder="Ingrese su direccion">
                </div>
            </div>
            <!--Fecha de nacimiento del Docente-->
            <div class="form-group row">
                <label for="dateBornPerson" class="col-sm-2 col-form-label">Fecha de Nacimiento</label>
                <div class="col-sm-10">
                    <input required type="date" class="form-control" id="dateBornPerson" name="dateBornPerson" placeholder="Ingrese su Fecha de Nacimiento">
                </div>
            </div>
            <!--Correo Electronico del Docente-->
            <div class="form-group row">
                <label for="emailPerson" class="col-sm-2 col-form-label">Correo Electronico</label>
                <div class="col-sm-10">
                    <input required type="email" class="form-control" id="emailPerson" name="emailPerson" placeholder="Ingrese su Correo Electronico">
                </div>
            </div>
            <!--Genero del Docente-->
            <div class="form-group row">
                <label for="generePerson class="col-sm-2 col-form-label">Genero</label>
                <div class="col-sm-10">
                    <select id="generePerson" name="generePerson" class="custom-select">
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>
            </div>
            <!--Tipo  del Docente-->
            <div class="form-group row">
                <label for="typePerson class="col-sm-2 col-form-label">Tipo de Usuario</label>
                <div class="col-sm-10">
                    <select id="typePerson" name="typePerson" class="custom-select">
                        <option value="Docente">Docente</option>
                        <option value="Estudiante">Estudiante</option>
                        <option value="Secretaria">Secretaria</option>
                    </select>
                </div>
            </div>
            <!--Foto-->
            <div class="form-group row">
                <label for="photoPerson" class="col-sm-2 col-form-label">Foto</label>
                <div class="col-sm-10">
                    <input  class="form-control" id="photoPerson" name="photoPerson" placeholder="Foto">
                </div>
            </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-info">Enviar</button>
            <a href="Teacher/index.php" role="button" class="btn btn-default float-right">Cancelar</a>
        </div>
        <!-- /.card-footer -->
    </form>
</div>
<!-- /.card -->