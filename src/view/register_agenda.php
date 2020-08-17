<?php
require_once('template/header.php')
?>

<main class="main p-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form role="form">
                    <div class="form-group">
                        <label for="agenda">
                            Cadastrar agenda:
                        </label>
                        <input type="text" class="form-control" id="agenda" />
                    </div>
                    <div class="form-group">
                        <label for="date">
                            Data do compromisso
                        </label>
                        <input type="date" class="form-control" id="date" />
                    </div>
                    <div class="form-group">

                        <label for="exampleInputFile">
                            File input
                        </label>
                        <input type="file" class="form-control-file" id="exampleInputFile" />
                        <p class="help-block">
                            Example block-level help text here.
                        </p>
                    </div>
                    <div class="checkbox">

                        <label>
                            <input type="checkbox" /> Check me out
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
</main>

<?php
require_once('template/footer.php')
?>