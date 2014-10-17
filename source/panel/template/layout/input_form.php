<?php if (!isset($formID)) $formID = "ajaxform"; ?>



    <label for="p_name">
        Project name:
    </label>
    <input type="text" name="p_name" id="p_name" <?php if (isset($p_name)) echo 'value="' . $p_name . '"' ?>/><br/>

    <label for="p_level">Project level:</label>
    <select name="p_level" id="p_level">

        <?php if (isset($levelJson)) foreach ($levelJson as $level) {
            $caption = $level["caption"];
            echo "<option value=\"$caption\">$caption</option>";
        } ?>
    </select><br/>

    <label for="p_detail">
        Project detail:
    </label><br/>
    <textarea rows="4" cols="50" name="p_detail"
              id="p_detail"><?php if (isset($p_detail)) echo 'value="' . $p_detail . '"' ?></textarea><br/>


    <label for="p_coordinatex">
        Project coordination X:
    </label>
    <input type="text" name="p_coordinatex"
           id="p_coordinatex" <?php if (isset($p_coordinatex)) echo 'value="' . $p_coordinatex . '"' ?>/><br/>

    <label for="p_coordinatey">
        Project coordination Y:
    </label>
    <input type="text" name="p_coordinatey"
           id="p_coordinatey" <?php if (isset($p_coordinatey)) echo 'value="' . $p_coordinatey . '"' ?>/><br/>

    <label for="p_thumbnail">
        Thumbnail address:
    </label>
    <input type="text" name="p_thumbnail"
           id="p_thumbnail" <?php if (isset($p_thumbnail)) echo 'value="' . $p_thumbnail . '"' ?>/><br/>