<html><body><?php
$var=10;
$sum=0;
function tp(){
    $var=20;//local variable
    echo "\$ Var inside the function has $var value";
    $dummy=15;
    $GLOBALS['add']=$GLOBALS['var'] + $dummy;
    //USE GLOBALS ARRAY WHEN YOUR FUNCTION HAS OVERRIDEN THE GLOBAL
    //VARIABLE
    GLOBAL $sum;
    $sum=$var+20;
}

echo "\$var outside the function has $var value <br>"
tp();
echo "<br>"$add;
echo "<br>"$sum;
?>
</body></html>
