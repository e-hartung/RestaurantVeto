<?php include '../view/header.php'; ?>
<main>
    <h1>Choose Where to Eat</h1>

    <div id="main">
        <?php if (!empty($error_message)) : ?>         
        <span class="error"><?php echo htmlspecialchars($error_message); ?></span><br>
        <?php endif; ?>
        <!-- filter restaurants by location -->
        <form action="" method="post" id="filter">
            <input type="hidden" name="action" value="filter_restaurants_by_location">
            <label>Filter By Location: </label>
            <select name="location">
                <option value="all">All</option>
                <?php foreach ($locations as $location) : ?>
                    <option value="<?php echo $location['location'];?>"
                    <?php if($location_name===$location['location']) {
                        echo "selected='selected'";
                    }
                    ?>>
                        <?php echo $location['location']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <input type="submit" value="Search">
        </form>
        <form action="" method="post">            
            <input type="hidden" name="action" value="filter_restaurants_by_speed">
            <label>Filter By Speed: </label>
            <select name="speed">
                <option value="all">All</option>
<!--                <option value="Fast"
                    <----------?php if($speed==='Fast') {
                        echo "selected='selected'";
                    }
                    ?>>
                    Fast
                </option>
                <option value="Slow"
                    <----------?php if($speed==='Slow') {
                        echo "selected='selected'";
                    }
                    ?>>
                    Slow
                </option>-->
                <option value="fast">Fast</option>
                <option value="slow">Slow</option>
            </select>
            <input type="submit" value="Search">
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
                <td class="restaurant_name"><?php echo $restaurant['restaurant_name']; ?></td>
                <td><?php echo $restaurant['category']; ?></td>
                <td><?php echo $restaurant['speed']; ?></td>
                <td><?php echo $restaurant['to_go']; ?></td>
                <td><?php echo $restaurant['delivery']; ?></td>
                <td><?php echo $restaurant['location']; ?></td>
                <!-- select the restaurant -->
                <td>
                    <form action="" method="post">
                        <input type="hidden" name="action"
                               value="veto">
                        <input type="hidden" name="id"
                               value="<?php echo $restaurant['id_num']; ?>">
                        <input type="submit" value="Veto" id="veto">
                    </form>
                    <!--button onclick="$(this).parent().parent().addClass('veto');">Veto</button-->
                </td>
            </tr>
            <?php endforeach; ?>
        
            <?php foreach ($vetoed_restaurants as $v_restaurant) : ?>
            <tr class="veto">
                <td class="restaurant_name"><?php echo $v_restaurant['restaurant_name']; ?></td>
                <td><?php echo $v_restaurant['category']; ?></td>
                <td><?php echo $v_restaurant['speed']; ?></td>
                <td><?php echo $v_restaurant['to_go']; ?></td>
                <td><?php echo $v_restaurant['delivery']; ?></td>
                <td><?php echo $v_restaurant['location']; ?></td>
                <!-- select the restaurant -->
                <td>
                    <form action="" method="post">
                        <input type="hidden" name="action"
                               value="unveto">
                        <input type="hidden" name="id"
                               value="<?php echo $v_restaurant['id_num']; ?>">
                        <input type="submit" value="Un-Veto" id="unveto">
                    </form>
                    
                </td>
            </tr>
            <?php endforeach; ?>
        </table> 
        
        <form action="." method="post">
            <input type="hidden" name="action" value="reset">
            <input type="submit" id="reset" value="Reset">
            
            <!--<button onclick="$(this).parent().parent().removeClass('veto');" id="reset">Reset</button>-->
        </form>
    </div>
</main>
<?php include '../view/footer.php'; ?>