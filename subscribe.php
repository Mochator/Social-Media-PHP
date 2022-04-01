<?php

//Subscribe retrieve

            //favourite exist check
            $booSubscribe = false;

            //fav sql
            $subscribeQuery = "select * from subscription where User_id = '$id' and Following_id = '$prof_id'";

            //Run favourite
            if($runSubscribe = mysqli_query($con, $subscribeQuery)){

                if(mysqli_num_rows($runSubscribe) == 1){
                    $booSubscribe = true;
                    $value = "Subscribed";
                } else {
                    $booSubscribe = false;
                    $value = "Subscribe";
                }

            } else {
                die("Error: ".mysqli_error($con));
            }

?>