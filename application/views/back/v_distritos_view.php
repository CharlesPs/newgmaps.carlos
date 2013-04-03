
        <div class="container-fluid content-distritos">

            <div class="row-fluid">
                <?php echo $web_leftbar; ?>
                
                <div class="span9 column-hero">
                    <div class="page-header">
                        <h1><?php echo $row->nombre; ?> <small></small></h1>
                    </div>
                    <ul class="breadcrumb">
                        <li><a href="admin">Home</a> <span class="divider">/</span></li>
                        <li><a href="admin/provincias">Provincias</a> <span class="divider">/</span></li>
                        <li><a href="admin/provincias/view/<?php echo $provincia->entry; ?>"><?php echo $provincia->nombre; ?></a> <span class="divider">/</span></li>
                        <li class="active"><?php echo $row->nombre; ?></li>
                    </ul>

                    <div class="row-fluid">
                        <ul class="nav nav-tabs" id="wc-tab">
                            <li class="active"><a href="#tab0">Mapa</a></li>
                            <li><a href="#tab1">Información</a></li>
                            <li><a href="#tab2">Centros Poblados</a></li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="tab0">
                                
                                <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>
                                <script>
                                var preview_coords = <?php echo json_encode($row->coordenadas); ?>;

                                var preview_data = {
                                    lat: '<?php echo trim($row->init_lat); ?>',
                                    lng: '<?php echo trim($row->init_lng); ?>',
                                    zoom: <?php echo $row->init_zoom; ?>
                                }

                                </script>

                                <div id="gmaps" style="width: 100%; height: 400px;"></div>
                            </div>
                            <div class="tab-pane" id="tab1">
                                <div class="alertas"></div>

                                <form class="form-horizontal" id="form-save">
                                    <input type="hidden" id="entry" value="<?php echo $row->entry; ?>" />

                                    <div class="control-group">
                                        <label class="control-label" for="nombre">Nombre</label>
                                        <div class="controls">
                                            <input type="text" id="nombre" class="span5" value="<?php echo $row->nombre; ?>">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="color">Color</label>
                                        <div class="controls">
                                            <input type="hidden" id="color" value="<?php echo $row->color; ?>" />
                                            
                                            <span class="preview-color colorpicker" style="background-color: <?php echo $row->color; ?>">&nbsp;</span>
                                                <!-- Button to trigger modal -->
                                                <a href="#colorModal" role="button" class="btn" data-toggle="modal">Elegir color</a>
                                                 
                                                <!-- Modal -->
                                                <div id="colorModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h3 id="myModalLabel">Elegir Color</h3>
                                                    </div>
                                                    <div class="modal-body">

                                                        <div id="color-picker"></div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Cerrar</button>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <div class="controls">
                                            <button type="submit" class="btn btn-primary">Actualizar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="tab2">
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
foreach($c_poblados as $row){

    $color = strlen($row->color) == 6 ? "#". $row->color : $row->color;
?>
                                        <tr>
                                            <td><input type="checkbox" id="<?php echo $row->entry; ?>"></td>
                                            <td><?php echo $row->nombre; ?></td>
                                            <td><span class="color-preview" style="background-color: <?php echo $color; ?>">&nbsp;</span></td>
                                            <td>
                                                <a href="admin/distritos/view/<?php echo $row->entry; ?>" class="btn">
                                                    <i class="icon-eye-open"></i> Ver
                                                </a>
                                                <a href="admin/distritos/delete/<?php echo $row->entry; ?>" class="btn btn-danger">
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
                </div>
            </div>

            <hr>
        </div> <!-- /container -->
