<label for="p_level">Project level:</label>
<select name="p_level" id="p_level">

    <?php foreach ($levelJson as $level) {
        $caption = $level["caption"];
        echo "<option value=\"$caption\">$caption</option>";
    } ?>
</select><br/>


<label for="p_name">Project name:</label>
<input type="text" name="p_name" id="p_name"/><br/>
