<?php include '../view/header.php'; ?>
<main>
    <h3>Manage Restaurants | <a href="?action=show_add_edit_form">Add New Restaurant</a></h3>

    <div id="main">
        <!-- search restaurants by name -->
        <form action="index.php" method="post" id="filter">
            <input type="hidden" name="action" value="search_restaurants">
            <label>Restaurant Name: </label>
            <input type="text" name="restaurant_name" value="">
            <input type="submit" value="Search"><br>
        </form>
        <!-- display a table of restaurants -->
        <table>
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Speed</th>
                <th>To Go</th>
                <th>Delivery</th>
                <th>Location</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($restaurants as $restaurant) : ?>
            <tr>
                <td><?php echo $restaurant['restaurant_name']; ?></td>
                <td><?php echo $restaurant['category']; ?></td>
                <td><?php echo $restaurant['speed']; ?></td>
                <td><?php echo $restaurant['to_go']; ?></td>
                <td><?php echo $restaurant['delivery']; ?></td>
                <td><?php echo $restaurant['location']; ?></td>
                <!-- select the restaurant -->
                <td><form action="" method="post">
                    <input type="hidden" name="action"
                           value="show_add_edit_form">
                    <input type="hidden" name="id"
                           value="<?php echo $restaurant['id_num']; ?>">
                    <input type="submit" value="Select">
                </form></td>
            </tr>
            <?php endforeach; ?>
        </table>      
    </div>
</main>
<?php include '../view/footer.php'; ?>