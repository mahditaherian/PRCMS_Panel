<div >
    Create new project: <br/>
    <?php $formID = "ajaxform" ?>
    <form name="<?php echo $formID ?>" id="<?php echo $formID ?>"
          action="<?php echo $basePath ?>source/panel/template/inc/create_project.php"
          method="POST">
    <?php include "input_form.php" ?>
        <input type="text" id="p_pictures" name="p_pictures"/><br/>
        <input type="submit" value="CREATE.....Without ajax"/>
        </form>
    <button id="simple-post" onclick='submit($("#<?php echo $formID ?>"))'>+Create</button>
</div>
