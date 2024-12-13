<?php
include("config.php");
include("reactions.php");
include("api.php");
//uncomment de volgende regel om te kijken hoe de array van je reactions eruit ziet
// echo "<pre>".var_dump($getReactions)."</pre>";

if(!empty($_POST)){
    
    //dit is een voorbeeld array.  Deze waardes moeten erin staan.
    $postArray = [
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'message' => $_POST['message']
    ];
    
    $setReaction = Reactions::setReaction($postArray);
    
    if(isset($setReaction['error']) && $setReaction['error'] != ''){
        prettyDump($setReaction['error']);
    }
    
    
}
$getReactions = Reactions::getReactions();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="assets/css/style.css">
        <title>Youtube remake</title>
    </head>
    <body>
        <?php 
foreach ($response->results as $result){
    $poster_path = $result->poster_path;
    echo "<img src='https://image.tmdb.org/t/p/w500$poster_path' ></img>";
} ?>
<iframe width="560" height="315" src="https://www.youtube.com/embed/dQw4w9WgXcQ?si=twI61ZGDECBr4ums" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
    
    <h2>reacties</h2>
    <hr size="3" > 
    <form method="post">
        <strong> name: </strong> <input type="text" id="name" name="name"><br>
        <strong> email: </strong> <input type="text" id="email" name="email"><br>
        <strong> comment: </strong> <input type="text" id="message" name="message"><br>
        <button type="submit" value="Submit">comment</button>
    </form>
    
    <?php
        foreach ($getReactions as $reaction){
            echo "<p>" . "<strong>" . $reaction['name']  . "</strong>" . ": " . $reaction ['message'] . "</p>";
        }
        ?>

</body>
<script>// no resubmitting form on reload
if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}</script>
</html>

<?php
$con->close();
?>

