<?php
// Initialize the session
include_once 'header.php';
include_once '../private/autoload.php';
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<section class="support">
    <div class="Accountinfo">
        <?php 
        //Fetch all account details from $_SESSION
        echo "<h1>".htmlspecialchars($_SESSION['name'])."</h1>";
        echo "<p>Username: ".htmlspecialchars($_SESSION["useruid"])."</p>";
        echo "<p>User id: ".htmlspecialchars($_SESSION['userid'])."</p>";
        echo "<p>User email: ".htmlspecialchars($_SESSION['email'])."</p>";
        echo "<p>User url : ".htmlspecialchars($_SESSION['url'])."</p>";
        echo "<p>Account creation date".htmlspecialchars($_SESSION['dateCreated'])."</p>";
    ?>
    </div>
    <div class="imageSection">
        <?php
    $user_id = $_SESSION['userid'];
    $url = $_SESSION['url'];
    
    // Display created images
    $sql = "SELECT user_id, img_name FROM users_has_images INNER JOIN images ON users_has_images.image_id = images.image_id AND users_has_images.user_id = '$user_id';";
    $resultat = $conn->query($sql) or die($conn->error);
        

    echo '<h1>Uploaded images</h1>';
    echo '<div class="imgContainer">';
    while($rad = $resultat->fetch_assoc()) {
       // $image_id = $rad["image_id"];
        $img_name = $rad["img_name"];
        $file = "../private/uploads/$url/$img_name.jpg";
        echo '<div class="imgBox">';
        echo "<p>".$img_name.".jpg</p>";
        echo "<img class='imgDisplay' src='".$file."'/><br>";

        echo "<form method='post' action='../private/include/img.inc.php'>";
        echo "<a download='$img_name.jpg' href='$file'><button type='button'>Download</button></a>";
        echo "<input type='hidden' name='img_name' value='$img_name'>";
        echo "<input type='submit' name='delete' value='delete'>";
        echo "</form>";

        echo '</div>';
    }
    echo '</div>';
    ?>
    </div>
</section>

</body>

</html>