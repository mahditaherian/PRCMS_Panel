<label for="p_levels">Project level:</label>
<select name="p_levels" id="p_levels">

    <?php foreach ($levelJson as $level) {
        $caption = $level["caption"];
        echo "<option value=\"$caption\">$caption</option>";
    } ?>
</select><br/>


<label for="p_names">Project name:</label>
<input type="text" name="p_names" id="p_names"/><br/>
