<form id ="movimiento ts" class="form-horizontal" method="post" id="frmCreateExperience" name="frmCreateExperience" action="../../../../app/Controllers/ExperienceControllers.php?action=create">
    <div class="card-body">
        <li class="list-Dates"><i class ="fas fa-address-book" id="icon-iconos"></i>Experiencia</li>
        <hr>

        <!--Ultimo Lugar de Trabajo-->
        <div class="form-group row">
            <label for="institutionExperience" class="col-sm-2 col-form-label">Ultimo Lugar de Trabajo</label>
            <div class="col-sm-10">
                <input required type="text" class="form-control" id="institutionExperience" name="institutionExperience" placeholder="Ultimo Lugar de Trabajo">
            </div>
        </div>
        <!--Ocupacion Laboral-->
        <div class="form-group row">
            <label for="dedicationExperience" class="col-sm-2 col-form-label">Ocupacion Laboral</label>
            <div class="col-sm-10">
                <input required type="text" class="form-control" id="dedicationExperience" name="dedicationExperience" placeholder="Ocupacion Laboral">
            </div>
        </div>

        <!--Fecha de Inicio de Contrato-->
        <div class="form-group row">
            <label for="startExperience" class="col-sm-2 col-form-label">Fecha de Inicio de Contrato</label>
            <div class="col-sm-10">
                <input required type="date" class="form-control" id="startExperience" name="startExperience" placeholder="Fecha de Inicio de Contrato">
            </div>
        </div>
        <!--Fecha de Determinacion  de Contrato-->
        <div class="form-group row">
            <label for="endExperince" class="col-sm-2 col-form-label">Fecha de Determinacion</label>
            <div class="col-sm-10">
                <input required type="date" class="form-control" id="endExperince" name="endExperince" placeholder="Fecha de Determinacion">
            </div>
        </div>


        <!--Idiomas-->
        <form id ="movimiento ts" class="form-horizontal" method="post" id="frmCreateLenguages" name="frmCreateLenguages" action="../../../../app/Controllers/LenguagesControllers.php?action=create">
            <div class="card-body">
                <li class="list-Dates"><i class ="fas fa-address-book" id="icon-iconos"></i>Idiomas</li>
                <hr>

                <!--Idiomas-->
                <div class="form-group row">
                    <label for="nameLenguages" class="col-sm-2 col-form-label">Idiomas</label>
                    <div class="col-sm-10">
                        <input required type="text" class="form-control" id="nameLenguages" name="nameLenguages" placeholder="Idiomas">
                    </div>
                </div>
    </div>
</form>
