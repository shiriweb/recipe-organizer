<?php
$conn= mysqli_connect('localhost', 'root', '','sem_project');
$sql = "select * from recipe";
$result = mysqli_query($conn, $sql);
$output = "";
if(mysqli_num_rows($result) >0){
    $output .=' <table width= "200%" id="recipetable">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Recipe Name</th>
            <th>Total Time</th>
            <th>Preparation Time</th>
            <th>Cooking Time</th>
            <th>Cooking Level</th>
            <th>Servings</th>
            <th>Ingredients</th>
            <th>Preparation Instruction</th>
            <th>Short Details</th>
            <th>Description</th>
            <th>Nutritional Information</th>
            <th>Image</th>
            <th>Category</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <div class="list">

            <?php foreach($datalist as $key=>$recipe){?>
                <tr class="">
                    <td><?php echo $key+1 ;?></td>
                    <td><?php echo $recipe['recipe_name']; ?></td>
            <td><?php echo $recipe['total_time'];?></td>
            <td><?php echo $recipe['preparation_time'];?></td>
            <td><?php echo $recipe['cooking_time'];?></td>
            <td><?php echo $recipe['cooking_level'];?></td>
            <td><?php echo $recipe['serving'];?></td>
            <td><?php echo $recipe['details'];?></td>
            <td><?php echo $recipe['ingredients'];?></td>
            <td><?php echo $recipe['instructions'];?></td>
            <td><?php echo $recipe['short_details'];?></td>\
            <td><?php echo $recipe['description'];?></td>
            <td><?php echo $recipe['nutritional_info'];?></td>
            <td><img height='100' width='100' 
                                     src="../images/<?php echo $recipe['image']; ?>"
                                     alt="" srcset=""></td>
            <td><?php echo $recipe['category'];?></td>
    
            <td class="action">
                <a class= "edit" href="editRecipe.php ? id=<?php echo $recipe['id']; ?>"> <i class="fas fa-edit"></i> Edit</a>
                <a class= "delete" href="deleteRecipe.php ? id=<?php echo $recipe['id']; ?>"> <i class="fas fa-trash"></i> Delete</a>
                
            </td>
        </tr>             
        <?php }?>
        </div>
        </tbody>
    </table>
    <div class="pagination">
        <a href="" class="active"></a>
    </div>
</div>
</div>

        ';
}



?>