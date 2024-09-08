<?= $this->extend('layout')?>

<?=$this->section('contenido');?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Autores</h1>  
</div>

<div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <button type="button" class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    Nuevo Autor
    </button>
</div>

<?php if (!empty($autores) && is_array($autores)): 
    $n=1;?>
<table id="autores" class="table table-dark table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">nombre</th>
      <th scope="col">apellido</th>
      <th scope="col">nacimiento</th>
      <th scope="col">fallecimiento</th>
      <th scope="col">pais</th>
      <th scope="col">opciones</th>
    </tr>
  </thead>
  <tbody>
        <?php foreach ($autores as $autor): ?>
        <tr>
        <th style="width: 50px;" scope="row">1</th>
        <td style="width: 50px;"><?= $autor['nombre']?></td>
        <td><?= $autor['apellido']?></td>
        <td><?= $autor['fecha_nacimiento']?></td>
        <td><?= $autor['fecha_muerte']?></td>
        <td><?= $autor['pais']?></td>
        <td style="width: 30px;">
            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <button type="button" onclick="eliminar(<?= $autor['artista_id']?>)" class="btn btn-danger"><span data-feather="trash"></span></button>
            </div>
        </td>
        </tr>
        <?php endforeach; ?>
  </tbody>
</table>
<?php else: ?>
    <div class="alert alert-primary d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
        <div>
            Aun no hay Autores que mostrar.
        </div>
    </div>
<?php endif; ?>


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Nuevo Autor</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form  class="row g-3" action="" method="post" id="form_autor">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa tu nombre" required>
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Ingresa tu apellido" required>
            </div>
            <div class="mb-3">
                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
            </div>
            <div class="mb-3">
                <label for="fecha_muerte" class="form-label">Fecha de Muerte</label>
                <input type="date" class="form-control" id="fecha_muerte" name="fecha_muerte">
            </div>
            <div class="mb-3">
                <label for="pais_id" class="form-label">País</label>
                <select class="form-select" id="pais_id" name="pais_id" required>
                    <option selected disabled>Selecciona un país</option>
                    <?php foreach ($paises as $pais): ?>
                        <option value="<?= $pais['pais_id']?>"><?= $pais['nombre']?></option>
                    <?php endforeach; ?>
                </select>
            </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">cancelar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
      </form>
    </div>
  </div>
</div>

<?= $this->endSection()?>

<?=$this->section('script');?>

<script>
document.addEventListener("DOMContentLoaded", function() {
    new DataTable('#autores', {
        layout: {
            topStart: 'info',
            bottom: 'paging',
            bottomStart: null,
            bottomEnd: null
        },
        
    });;
});
   

    document.getElementById('form_autor').addEventListener('submit', function(event) {
        event.preventDefault();
        let formData = new FormData(this);
        
        axios.post("<?= base_url('/guardar/autor')?>", formData)
            .then(function (response) {
                if(!response.data.error){
                    Swal.fire({
                    title: "Campos Guardados!",
                    text: "Se a guardado el pais correctamente!",
                    icon: "success",
                    willClose: () => {
                        window.location.href = "<?= base_url('/autores')?>";
                    }
                    });
                }else{
                    Swal.fire({
                    title: "Opss!",
                    text: "No fue posible guardar los datos!",
                    icon: "error"
                    });
                }
            })
            .catch(function (error) {
                console.error('Error!', error);
            });
    });

    function eliminar(id) {

        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: true
        });
        swalWithBootstrapButtons.fire({
        title: "Esta seguro?",
        text: "Esta a punto de eliminar definitivamente un registro!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, Eliminar!",
        cancelButtonText: "No, cancelar!",
        reverseButtons: true
        }).then((result) => {
        if (result.isConfirmed) {

            axios.get("<?= base_url('eliminar/autor/')?>"+id)
            .then(response => {
                console.log('Respuesta del servidor:', response.data);
                if(!response.data.error){
                    swalWithBootstrapButtons.fire({
                    title: "Eliminado!",
                    text: "El registro ha sido eliminado.",
                    icon: "success",
                    willClose: () => {
                        window.location.href = "<?= base_url('/autores')?>";
                    }
                });
                }else{
                    swalWithBootstrapButtons.fire({
                    title: "Opss!",
                    text: "El registro NO ha sido eliminado.",
                    icon: "error"
                });
                }
                
            })
            .catch(error => {
                console.error(error);
            });


            
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire({
            title: "Cancelado",
            text: "Tu registro esta asalbo :)",
            icon: "error"
            });
        }
        });
        
    }
</script>

<?= $this->endSection()?>