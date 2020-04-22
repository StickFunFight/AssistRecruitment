<?php
require_once 'head.php';
require_once 'menu.php';
?>
<html>
<link rel="stylesheet" href="../assests/styling/QaStyling.css">
<body>
<div id="page-content">
        <button type="button" class="btn btn-primary ButtonRight"><i class="fas fa-plus"></i> Vraag toevoegen</button>
    <div class="container-fluid">
        <div id="wrapper">
            <div id="FirstQaDiv" >
                <table id="" class="table">
                    <thead>
                    <tr>
                    <th><i class="fas fa-folder-open"></i> (All Categories)</th>
                        <th><i id="CategoryAdd" class="fas fa-plus fa-lg"></i> </th>
                    </tr>
                    </thead>
                    <tbody>
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
                <table id="example" class="table">
                    <thead>
                    <tr>
                        <th>Questions</th>
                        <th>Answers options</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $QO = new QaOverView();
                    $Qa = $QO->GetQuestionAnswers();
                    foreach ($Qa as $item)
                    {
                        echo'<tr>';
                        echo '<td>';
                        echo  $item->getQuestionName();
                        echo '</td>';
                        echo '<td>';
                        echo  $item->getAnswer();
                        echo '</td>';
                        echo '<td>';
                        echo  '<i class="fas fa-pencil-alt"></i>';
                        echo  ' ';
                        echo  '<i class="fas fa-pencil-alt"></i>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>




