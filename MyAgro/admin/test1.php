<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    if(isset($_POST['submit'])) {

        if(!empty($_POST['crop_name']) && !empty($_POST['crop_variety'])) {
            $crop_name = $_POST['crop_name'];
            $crop_variety = $_POST['crop_variety'];
            echo $crop_name;
            echo $crop_variety;
        }else{
            echo "Please Select Crop and Variety";
        }
    }
    
    ?>
</body>
</html>