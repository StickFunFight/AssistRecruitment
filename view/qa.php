<?php
require_once 'head.php';
require_once 'menu.php';
?>
<html>
<script>
            $( function() {
                $('.TrQa').hover( function() {
                    $(this).closest('.TrQa').find('.EditCatergory').addClass("fas fa-pencil-alt");
                    $(this).closest('.TrQa').find('.DeleteCatergory').addClass("fas fa-trash-alt");
                }, function () {
                    $(this).closest('.TrQa').find('.EditCatergory').removeClass("fas fa-pencil-alt");
                    $(this).closest('.TrQa').find('.DeleteCatergory').removeClass("fas fa-trash-alt");
                });
            });
</script>

<link rel="stylesheet" href="../assests/styling/QaStyling.css">
<body>
<div id="page-content">
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
                            <?php
                            require("../functions/controller/QaOverView.php");
                            $QO = new QaOverView();
                            $Qa = $QO->GetAllCatergies();
                            foreach ($Qa as $item)
                            {
                                echo '<tr class="TrQa">';
                                echo '<td>';
                                echo '<i id="Icon" class="fas fa-folder"></i>';
                                echo " ";
                                echo  $item->GetNaam();
                                echo '</td>';
                                echo '<td>';
                                echo '<i class="EditCatergory"></i>';
                                echo " ";
                                echo '<i class="DeleteCatergory"></i>';
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
    </div>
</div>
</body>
</html>
