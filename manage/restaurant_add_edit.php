<?php include ('../view/header.php'); ?>
<main>
    <h1>Add/Update Restaurant</h1>
    <form action="index.php" method="post" id="add_edit_restaurant_form">
        <?php if (isset($id)) : ?>
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <input type="hidden" name="action" value="update_restaurant" />
        <?php else: ?>
            <input type="hidden" name="action" value="add_restaurant" />
        <?php endif; ?>

        <label>Restaurant Name:</label>
        <input type="text" name="restaurant_name" size="30"
               value="<?php echo htmlspecialchars($name); ?>" />
        <br />

        <label>Category:</label>
        <select name="category">
            <option></option>
        <?php foreach ($categories as $c) : ?>
            <option value="<?php echo $c['category'];?>" 
            <?php if($category===$c['category']) {
                    echo "selected='selected'";
                  }
            ?>>
                <?php echo $c['category']; ?>
            </option>
        <?php endforeach; ?>
        </select><br />
        
        <label>Speed:</label>
        <select name="speed">
            <option></option>
            <option value="Fast"
                <?php if($speed==='Fast') {
                    echo "selected='selected'";
                }
            ?>>
                Fast
            </option>
            <option value="Slow"
                <?php if($speed==='Slow') {
                    echo "selected='selected'";
                }
            ?>>
                Slow
            </option>
        </select>
        <br />
        
        <label>To Go:</label>
        <input type="text" name="to_go"
               value="<?php echo htmlspecialchars($to_go); ?>" />
        <br />
        
        <label>Delivery:</label>
        <input type="text" name="delivery"
               value="<?php echo htmlspecialchars($delivery); ?>" />
        <br />
        
        <label>Location:</label>
        <select name="location">
            <option></option>
        <?php foreach ($locations as $location) : ?>
            <option value="<?php echo $location['location'];?>" 
            <?php if($location_name===$location['location']) {
                    echo "selected='selected'";
                  }
            ?>>
                <?php echo $location['location']; ?>
            </option>
        <?php endforeach; ?>
        </select><br />
        
        <label>&nbsp;</label>
        <?php if (isset($id)) : ?>
            <input type="submit" value="Update Restaurant"><br />
        <?php else: ?>
            <input type="submit" value="Add Restaurant"><br />
        <?php endif; ?>
        </form>
    <p class="last_paragraph">
        <a href="index.php?action=list_restaurants">Back to Restaurant Manager</a>
    </p>

</main>
<?php include ('../view/footer.php'); ?>
