
        <div class="container-fluid">

            <div class="row-fluid">
                <?php echo $web_leftbar; ?>
                
                <div class="span9 column-hero">
                    <div class="page-header">
                        <h1><?php echo $mod_title; ?> <small></small></h1>
                    </div>
                    <ul class="breadcrumb">
                        <li><a href="admin">Home</a> <span class="divider">/</span></li>
                        <li class="active">Provincias</li>
                    </ul>

                    <div class="row-fluid">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th width="20"><input type="checkbox" class="check-select-all"></th>
                                        <th>Nombre</th>
                                        <th width="80">Color</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php
foreach($result as $row){
?>
                                    <tr>
                                        <td><input type="checkbox" id="<?php echo $row->entry; ?>"></td>
                                        <td><?php echo $row->nombre; ?></td>
                                        <td><?php echo $row->color; ?></td>
                                        <td>
                                            <a href="admin/provincias/edit/<?php echo $row->entry; ?>" class="btn">
                                                <i class="icon-edit"></i> Editar
                                            </a>
                                            <a href="admin/provincias/delete/<?php echo $row->entry; ?>" class="btn btn-danger">
                                                <i class="icon-trash icon-white"></i> Eliminar
                                            </a>
                                        </td>
                                    </tr>
<?php
}
?>                                    
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>

            <hr>
        </div> <!-- /container -->
