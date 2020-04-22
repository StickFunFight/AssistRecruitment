<?php
require_once 'head.php';
?>

<script>
            $( function() {
                $('#TrQa').hover( function() {
                    $('#EditCatergory').toggleClass('fas fa-pencil-alt');
                    $('#DeleteCatergory').toggleClass('fas fa-trash-alt');
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
               <th><i class="fas fa-folder-open"></i> (All Categories)</th>
                <th><i id="CategoryAdd" class="fas fa-plus fa-lg"></i> </th>

            </tr>
            </thead>
                    <?php
                    require("../functions/controller/QaOverView.php");
                    $QO = new QaOverView();
                    $Qa = $QO->GetAllCatergies();
                    foreach ($Qa as $item)
                    {
                        echo '<tr id="TrQa">';
                        echo '<td>';
                        echo '<i id="Icon" class="fas fa-folder"></i>';
                        echo " ";
                        echo  $item->GetNaam();
                        echo '</td>';
                        echo '<td>';
                        echo '<i id="EditCatergory" class=""></i>';
                        echo " ";
                        echo '<i id="DeleteCatergory" class=""></i>';
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
