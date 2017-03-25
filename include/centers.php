<?php
    include("connect.php");
    if(isset($_GET['s']) && ($_GET['s'])>0)
    {
        $s_id = $_GET['s'];
        if(isset($_GET['c']) && ($_GET['c'])>0)
        {
            $c_id = $_GET['c'];
            $get_center = "select state_id,state_name from state order by state_name asc";
            $run_center = mysqli_query($con,$get_center);
            echo "<section id='section6'><div class='container'><div class='who'><h1>STUDY CENTER</h1></div><div class='row'><div class='col-sm-3 col-md-3'><div class='well'><h3 align='center' style='color:black;'>Search Filter</h3><form class='form-horizontal'><div class='form-group'><label for='l1' class='control-label' style='color:black;'>State</label><select class='form-control' name='state' id='l1' onchange='location=this.value;'><option value='./?centers&s=0'>All</option>";
            while($row_center = mysqli_fetch_array($run_center))
            {
                $state_id = $row_center['state_id'];
                $state_name = $row_center['state_name'];
                echo "<option value='./?centers&s=$state_id'";
                if($state_id == $s_id)
                    echo " selected";
                echo ">$state_name</option>";
            }
            echo "</select></div><div class='form-group'><label for='l2' class='control-label' style='color:black;'>City</label><select class='form-control' name='city' id='l2' onchange='location=this.value;'><option value='./?centers&s=0&c=0'>All</option>";
            $get_center = "select state_id,city_id,city_name from city where state_id=$s_id order by city_name asc";
            $run_center = mysqli_query($con,$get_center);
            while($row_center = mysqli_fetch_array($run_center))
            {
                $state_id = $row_center['state_id'];
                $city_id = $row_center['city_id'];
                $city_name = $row_center['city_name'];
                echo "<option value='./?centers&s=$state_id&c=$city_id'";
                if($city_id == $c_id)
                    echo " selected";
                echo ">$city_name</option>";
            }
            echo "</select></div></form></div></div><div class='col-sm-9 col-md-9'><div class='panel panel-default' style='background-color:#e5e5ef;'>";
            $get_state = "select state_id,state_name from state where state_id=$s_id order by state_name asc";
            $run_state = mysqli_query($con,$get_state);
            while($row_state = mysqli_fetch_array($run_state))
            {
                $state_id = $row_state['state_id'];
                $state_name = $row_state['state_name'];
                echo "<div class='panel-heading'><h3 style='margin:0px;padding:0px;text-align:center;'>$state_name</h3></div>";
                $get_city = "select city_id,city_name from city where state_id=$state_id and city_id=$c_id order by city_name asc";
                $run_city = mysqli_query($con,$get_city);
                while($row_city = mysqli_fetch_array($run_city))
                {
                    $city_id = $row_city['city_id'];
                    $city_name = $row_city['city_name'];
                    echo "<div class='panel-body'><div class='alert alert-success'><h4 style='margin:0px;padding:0px;text-align:center;'>$city_name</h4></div><div class='row'>";
                    $get_add = "select owner,address,phone,mobile from address where state_id=$state_id and city_id=$city_id";
                    $run_add = mysqli_query($con,$get_add);
                    while($row_add = mysqli_fetch_array($run_add))
                    {
                        $add_owner = $row_add['owner'];
                        $add_add = $row_add['address'];
                        $add_phone = $row_add['phone'];
                        $add_mobile = $row_add['mobile'];
                        echo "<div class='alert alert-info'>";
                        if($add_owner!='')
                            echo "<h4><u>$add_owner</u></h4>";
                        if($add_add!='')
                            echo "<p>Address - $add_add</p>";
                        if($add_phone!='')
                            echo "<p>Phone No. - $add_phone</p>";
                        if($add_mobile!='')
                            echo "<p>Mobile No. - $add_mobile</p>";
                        echo "</div>";
                    }
                    echo "</div></div>";
                }
            }
            echo "</div></div></div></div></section>";
        }
        else
        {
            $get_center = "select state_id,state_name from state order by state_name asc";
            $run_center = mysqli_query($con,$get_center);
            echo "<section id='section6'><div class='container'><div class='who'><h1>STUDY CENTER</h1></div><div class='row'><div class='col-sm-3 col-md-3'><div class='well'><h3 align='center' style='color:black;'>Search Filter</h3><form class='form-horizontal'><div class='form-group'><label for='l1' class='control-label' style='color:black;'>State</label><select class='form-control' name='state' id='l1' onchange='location=this.value;'><option value='./?centers&s=0'>All</option>";
            while($row_center = mysqli_fetch_array($run_center))
            {
                $state_id = $row_center['state_id'];
                $state_name = $row_center['state_name'];
                echo "<option value='./?centers&s=$state_id'";
                if($state_id == $s_id)
                    echo " selected";
                echo ">$state_name</option>";
            }
            echo "</select></div><div class='form-group'><label for='l2' class='control-label' style='color:black;'>City</label><select class='form-control' name='city' id='l2' onchange='location=this.value;'><option value='./?centers&s=0&c=0'>All</option>";
            $get_center = "select city_id,city_name from city where state_id=$s_id order by city_name asc";
            $run_center = mysqli_query($con,$get_center);
            while($row_center = mysqli_fetch_array($run_center))
            {
                $city_id = $row_center['city_id'];
                $city_name = $row_center['city_name'];
                echo "<option value='./?centers&s=$s_id&c=$city_id'>$city_name</option>";
            }
            echo "</select></div></form></div></div><div class='col-sm-9 col-md-9'><div class='panel panel-default' style='background-color:#e5e5ef;'>";
            $get_state = "select state_id,state_name from state where state_id=$s_id order by state_name asc";
            $run_state = mysqli_query($con,$get_state);
            while($row_state = mysqli_fetch_array($run_state))
            {
                $state_id = $row_state['state_id'];
                $state_name = $row_state['state_name'];
                echo "<div class='panel-heading'><h3 style='margin:0px;padding:0px;text-align:center;'>$state_name</h3></div>";
                $get_city = "select city_id,city_name from city where state_id=$state_id order by city_name asc";
                $run_city = mysqli_query($con,$get_city);
                while($row_city = mysqli_fetch_array($run_city))
                {
                    $city_id = $row_city['city_id'];
                    $city_name = $row_city['city_name'];
                    echo "<div class='panel-body'><div class='alert alert-success'><h4 style='margin:0px;padding:0px;text-align:center;'>$city_name</h4></div><div class='row'>";
                    $get_add = "select owner,address,phone,mobile from address where state_id=$state_id and city_id=$city_id";
                    $run_add = mysqli_query($con,$get_add);
                    while($row_add = mysqli_fetch_array($run_add))
                    {
                        $add_owner = $row_add['owner'];
                        $add_add = $row_add['address'];
                        $add_phone = $row_add['phone'];
                        $add_mobile = $row_add['mobile'];
                        echo "<div class='alert alert-info'>";
                        if($add_owner!='')
                            echo "<h4><u>$add_owner</u></h4>";
                        if($add_add!='')
                            echo "<p>Address - $add_add</p>";
                        if($add_phone!='')
                            echo "<p>Phone No. - $add_phone</p>";
                        if($add_mobile!='')
                            echo "<p>Mobile No. - $add_mobile</p>";
                        echo "</div>";
                    }
                    echo "</div></div>";
                }
            }
            echo "</div></div></div></div></section>";
        }
    }
    else
    {
        $get_center = "select state_id,state_name from state order by state_name asc";
        $run_center = mysqli_query($con,$get_center);
        echo "<section id='section6'><div class='container'><div class='who'><h1>STUDY CENTER</h1></div><div class='row'><div class='col-sm-3 col-md-3'><div class='well'><h3 align='center' style='color:black;'>Search Filter</h3><form class='form-horizontal'><div class='form-group'><label for='l1' class='control-label' style='color:black;'>State</label><select class='form-control' name='state' id='l1' onchange='location=this.value;'><option value='./?centers&s=0'>All</option>";
        while($row_center = mysqli_fetch_array($run_center))
        {
            $state_id = $row_center['state_id'];
            $state_name = $row_center['state_name'];
            echo "<option value='./?centers&s=$state_id'>$state_name</option>";
        }
        echo "</select></div><div class='form-group'><label for='l2' class='control-label' style='color:black;'>City</label><select class='form-control' name='city' id='l2' onchange='location=this.value;'><option value='./?centers&s=0&c=0'>All</option>";
        $get_center = "select city_id,state_id,city_name from city order by city_name asc";
        $run_center = mysqli_query($con,$get_center);
        while($row_center = mysqli_fetch_array($run_center))
        {
            $city_id = $row_center['city_id'];
            $state_id = $row_center['state_id'];
            $city_name = $row_center['city_name'];
            echo "<option value='./?centers&s=$state_id&c=$city_id'>$city_name</option>";
        }
        echo "</select></div></form></div></div><div class='col-sm-9 col-md-9'><div class='panel panel-default' style='background-color:#e5e5ef;'>";
        $get_state = "select state_id,state_name from state order by state_name asc";
        $run_state = mysqli_query($con,$get_state);
        while($row_state = mysqli_fetch_array($run_state))
        {
            $state_id = $row_state['state_id'];
            $state_name = $row_state['state_name'];
            echo "<div class='panel-heading'><h3 style='margin:0px;padding:0px;text-align:center;'>$state_name</h3></div>";
            $get_city = "select city_id,city_name from city where state_id=$state_id order by city_name asc";
            $run_city = mysqli_query($con,$get_city);
            while($row_city = mysqli_fetch_array($run_city))
            {
                $city_id = $row_city['city_id'];
                $city_name = $row_city['city_name'];
                echo "<div class='panel-body'><div class='alert alert-success'><h4 style='margin:0px;padding:0px;text-align:center;'>$city_name</h4></div><div class='row'>";
                $get_add = "select owner,address,phone,mobile from address where state_id=$state_id and city_id=$city_id";
                $run_add = mysqli_query($con,$get_add);
                while($row_add = mysqli_fetch_array($run_add))
                {
                    $add_owner = $row_add['owner'];
                    $add_add = $row_add['address'];
                    $add_phone = $row_add['phone'];
                    $add_mobile = $row_add['mobile'];
                    echo "<div class='alert alert-info'>";
                    if($add_owner!='')
                        echo "<h4><u>$add_owner</u></h4>";
                    if($add_add!='')
                        echo "<p>Address - $add_add</p>";
                    if($add_phone!='')
                        echo "<p>Phone No. - $add_phone</p>";
                    if($add_mobile!='')
                        echo "<p>Mobile No. - $add_mobile</p>";
                    echo "</div>";
                }
                echo "</div></div>";
            }
        }
        echo "</div></div></div></div></section>";
    }
?>