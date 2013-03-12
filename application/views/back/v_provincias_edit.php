
        <div class="container-fluid">

            <div class="row-fluid">
                <?php echo $web_leftbar; ?>
                
                <div class="span9 column-hero">
                    <div class="page-header">
                        <h1><?php echo $mod_title; ?> <small></small></h1>
                    </div>
                    <ul class="breadcrumb">
                        <li><a href="admin">Home</a> <span class="divider">/</span></li>
                        <li><a href="admin/provincias">Provincias</a> <span class="divider">/</span></li>
                        <li class="active">Editar</li>
                    </ul>

                    <div class="row-fluid">
                        <form class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label" for="inputEmail">Activo</label>
                                <div class="controls">
                                    <button type="button" class="btn button-activable">
                                        <input type="hidden" id="row-active" value="<?php echo $row->active; ?>" />
                                        <i class="icon-remove row-activable"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="nombre">Nombre</label>
                                <div class="controls">
                                    <input type="text" id="nombre" class="span5">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="color">Color</label>
                                <div class="controls">
                                    <input type="text" id="color" class="span2">
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    <button type="submit" class="btn btn-primary">Sign in</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <hr>
        </div> <!-- /container -->
