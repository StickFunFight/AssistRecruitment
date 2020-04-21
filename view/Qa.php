<?php
require_once 'head.php';
?>

<script>
    $(document).ready(function(){
        $("tr").hover(function(){

        }, function(){

        });
    });
</script>

<link rel="stylesheet" href="../assests/styling/QaStyling.css">
<body>
<div id="wrapper">
    <div id="FirstQaDiv" >
        <table id="" class="table">
            <thead>
            <tr>
               <th><i class="fas fa-folder-open"></i> (All Categories)  <i id="CategoryAdd" class="fas fa-plus fa-lg"></i> </th>

            </tr>
            </thead>
                    <?php
                    require("../functions/datalayer/QaOverView.php");
                    $QO = new QaOverView();
                    $Qa = $QO->GetAllCatergies();
                    foreach ($Qa as $item)
                    {
                        echo '<tr id="demo" onmouseover="mouseOver()">';
                        echo '<td>';
                        echo '<i id="Icon" class="fas fa-folder"></i>';
                        echo " ";
                        echo  $item->GetNaam();
                        echo '</td>';
                        echo '<td>';
                        echo '<i id="Icon3" class=""></i>';
                        echo '</td>';
                    }
                    ?>
            </tr>
            </tbody>
        </table>
    </div>
    <div id="SecondQaDiv">
        <table id="example" class="table table-striped" ">
            <thead>
            <tr>
                <th>Questions</th>
                <th>Answers options</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>iets</td>
                <td>iets</td>
                <td>iets</td>
            </tr>
            <tr>
                <td>uets</td>
                <td>uets</td>
                <td>uets</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
