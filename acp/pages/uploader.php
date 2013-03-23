<?php
if (isset($_FILES['myfile'])) {
    move_uploaded_file($_FILES['myfile']['tmp_name'], __DIR__.'/../../media/uploads/'.$_FILES['myfile']['name']);
}