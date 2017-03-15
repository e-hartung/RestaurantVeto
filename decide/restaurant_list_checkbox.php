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
            <?php foreach($locations as $location) : ?>
                <input type="checkbox" class="checkbox" name="Location[]" value="<?php echo $location['location'];?>" /> <?php echo $location['location'];?>
                <br />
            <?php endforeach; ?>
            <input type="submit" value="Filter">
        </form>
        
<!--        <script type="text/javascript">  
            $(function(){
             $('.checkbox').on('change',function(){
                $('#filter').submit();
                });
            });
        </script>-->
            
            
            
<!--            <select name="location">
                <option value="all">All</option>
                <--------?php foreach ($locations as $location) : ?>
                    <option value="<------------?php echo $location['location'];?>"
                    <-----------?php if($location_name===$location['location']) {
                        echo "selected='selected'";
                    }
                    ?>>
                        <-------------?php echo $location['location']; ?>
                    </option>
                <----------------?php endforeach; ?>
            </select>
            <label>Filter By Speed: </label>
            <select name="speed">
                <option value="all">All</option>
                <option value="fast" <---------?php if($speed=='fast') {
                    echo "selected='selected'"; }
                ?>>Fast</option>
                <option value="slow"<-----------?php if($speed=='slow') {
                    echo "selected='selected'"; }
                ?>>Slow</option>
            </select>
            <input type="submit" value="Search">-->
        
            <button onclick="$(this).parent().parent().removeClass('veto');" id="reset">Reset</button>
        
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
<!--                    <form action="" method="post">
                        <input type="hidden" name="action"
                               value="veto">
                        <input type="hidden" name="id"
                               value="<?php // echo $restaurant['id_num']; ?>">
                        <input type="submit" value="Veto" id="veto">
                    </form>-->
                    <button onclick="$(this).parent().parent().addClass('veto');">Veto</button>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>      
    </div>
</main>
<?php include '../view/footer.php'; ?>