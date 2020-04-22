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
            <div class="col-sm-6">
                <input class="form-control form-control-lg" id="Filter"  onkeyup="myFunction()" type="text" placeholder="Zoek naar een vraag of antwoord">
            </div>
            <div class="col-sm-6">
                <button type="button" class="btn btn-primary ButtonRight"><i class="fas fa-plus"></i> Vraag toevoegen</button>
            </div>
        </div>
        <div id="wrapper">
            <div id="FirstQaDiv">
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
                        echo  '<i value="'.$item->getQuestionID().'" class="fas fa-pencil-alt"></i>';
                        echo  ' ';
                        echo  '<i value="'.$item->getQuestionID().'" class="fas fa-trash-alt"></i>';
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
<script>
    function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("Filter");
        filter = input.value.toUpperCase();
        table = document.getElementById("example");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0,1];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>




