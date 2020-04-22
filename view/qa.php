<?php
require_once 'head.php';
require_once 'menu.php';
?>
<html>
<link rel="stylesheet" href="../assests/styling/QaStyling.css">
<body>
<div id="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <a href="qa.php"><i class="fas fa-sync-alt fa-lg"></i> </a>
            </div>
        </div>
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
                                echo '<tr class="category-tabel__row">';
                                echo '<td value="'.$item->GetID().'">';
                                echo '<i id="Icon" class="fas fa-folder"></i>';
                                echo " ";
                                echo  $item->GetNaam();
                                echo '</td>';
                                echo '<td>';
                                echo '<i id="EditCatergory" class="fas fa-pencil-alt table--icon"><a href="https://www.w3schools.com/sql/sql_join.asp"></a></i>';
                                echo " ";
                                echo '<a href="https://www.youtube.com/watch?v=i7MfrslYUac"><i id="DeleteCatergory" class="fas fa-trash-alt table--icon"></i></a>';
                                echo '</td>';
                            }
                            ?>
                    </tr> 
                    </tbody>
                </table>
            </div>
            <div id="SecondQaDiv">
                <table id="example" class="table table-striped">
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
                        <td>iets</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>




