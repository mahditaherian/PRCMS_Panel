<div>
    Update project: <br/>
    Old project: <br/>
    <?php $formID = "updateform" ?>
    <form name="<?php echo $formID ?>" id="<?php echo $formID ?>"
          action="<?php echo $basePath ?>source/panel/template/inc/update_project.php"
          method="POST">
        <?php include "select_form.php" ?>
        -------------------------------------------------------<br/>
        Enter new detail to replace with:<br/>
        <?php $formID = "updateform";

        include "input_form.php" ?>
        <input type="text" id="p_pictures" name="p_pictures"/><br/>
        <input type="submit" value="Update without Ajax.....">
    </form>
    <button id="simple-post" onclick='submit($("#<?php echo $formID ?>"))'>+Create</button>
</div>
