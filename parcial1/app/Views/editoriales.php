<?= $this->extend('layout')?>

<?=$this->section('contenido');?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Editoriales</h1>  
</div>

<div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <button type="button" class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    Nuevo Editorial
    </button>
</div>
<?php if (!empty($editoriales) && is_array($editoriales)):
        $n=1; ?>
<table id="editoriales" class="table table-dark table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">nombre</th>
      <th scope="col">direccipon</th>
      <th scope="col">telefono</th>
      <th scope="col">email</th>
      <th scope="col">url</th>
      <th scope="col">opciones</th>
    </tr>
  </thead>
  <tbody>
   
        <?php foreach ($editoriales as $editorial): ?>
        <tr>
        <th scope="row"><?= $n++?></th>
        <td><?= $editorial['nombre']?></td>
        <td><?= $editorial['direccion']?></td>
        <td><?= $editorial['telefono']?></td>
        <td><?= $editorial['email']?></td>
        <td><?= $editorial['url']?></td>
        <td style="width: 30px;">
            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <button type="button" onclick="eliminar(<?= $editorial['id']?>)" class="btn btn-danger"><span data-feather="trash"></span></button>
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
            Aun no hay editoriales que mostrar
        </div>
    </div>
<?php endif; ?>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Nuevo Editorial</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form  class="row g-3" action="" method="post" id="form_editorial">
        <div class="mb-2">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa tu nombre" required>
        </div>
        <div class="mb-2">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Ingresa tu dirección" required>
        </div>
        <div class="mb-2">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="Ingresa tu número de teléfono" required>
        </div>
        <div class="mb-2">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Ingresa tu correo electrónico" required>
        </div>
        <div class="mb-2">
            <label for="url" class="form-label">Página web (URL)</label>
            <input type="url" class="form-control" id="url" name="url" placeholder="Ingresa tu página web">
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
        new DataTable('#editoriales', {
            layout: {
                topStart: 'info',
                bottom: 'paging',
                bottomStart: null,
                bottomEnd: null
            },
            
        });;
    });

    document.getElementById('form_editorial').addEventListener('submit', function(event) {
        event.preventDefault();
        let formData = new FormData(this);
        
        axios.post("<?= base_url('/guardar/editorial')?>", formData)
            .then(function (response) {
                if(!response.data.error){
                    Swal.fire({
                    title: "Campos Guardados!",
                    text: "Se a guardado la editorial correctamente!",
                    icon: "success",
                    willClose: () => {
                        window.location.href = "<?= base_url('/editoriales')?>";
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

            axios.get("<?= base_url('/eliminar/editorial/')?>"+id)
            .then(response => {
                console.log('Respuesta del servidor:', response.data);
                if(!response.data.error){
                    swalWithBootstrapButtons.fire({
                    title: "Eliminado!",
                    text: "El registro ha sido eliminado.",
                    icon: "success",
                    willClose: () => {
                        window.location.href = "<?= base_url('/editoriales')?>";
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