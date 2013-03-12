
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
                                <label class="control-label" for="inputEmail">Email</label>
                                <div class="controls">
                                    <input type="text" id="inputEmail" placeholder="Email">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="inputPassword">Password</label>
                                <div class="controls">
                                    <input type="password" id="inputPassword" placeholder="Password">
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    <label class="checkbox">
                                        <input type="checkbox"> Remember me
                                    </label>
                                    <button type="submit" class="btn">Sign in</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <hr>
        </div> <!-- /container -->
