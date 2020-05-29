<?php
    // Inlcude Database class
    require '../functions/datalayer/database.class.php';
    // Including controller
    require '../functions/controller/ScanController.php';

    // Including entity classes
    require '../functions/models/entAnswerScore.php';
    require '../functions/models/entQuestionsAnswered.php';

    // Creating connections with the classes
    $ScoreCtrl = new ScanController();

?>

<html>
    <head>
        <?php
            //Include Menu
            require('menu.php');
        ?>
        <!-- Linking to own styleheet -->
        <link rel="stylesheet" href="../assests/styling/qa.css">
        <link rel="stylesheet" href="../assests/styling/customer-edit.css">
    </head>

    <body>
        <div class="page__container"> 
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="ce__title" id="pageTitle">Average Score per Question<h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <form method="POST">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="search__icon"><i class='fas search--icon'>&#xf002;</i></div>
                                    <input class="form-control input__filter" id="Filter" type="text" placeholder="Search...">
                                </div>
                            </div>
                        </form>

                        <table class="tab-table table table-hover" id="filterTable">
                            <thead class="tab-table__header">
                                <tr class="tab-table__row">
                                    <!-- Voor de onlcick gebruik maken van int zodat JavaScript de column kan vinden -->
                                    <th class="qa__th_name">Question <div class="table__icon-top" onclick="sortTable('filterTable', 0, 'asc')"></div> <div class="table__icon-bottom" onclick="sortTable('filterTable', 0, 'desc')"></div></th>
                                    <th class="qa__th_comment">Average Score <div class="table__icon-top" onclick="sortTable('filterTable', 1, 'asc')"></div> <div class="table__icon-bottom" onclick="sortTable('filterTable', 1, 'desc')"></div></th>   
                                    <th class=""></th> 
                            </tr>

                            </thead>

                            <tbody class="tab-table__body">
                                <?php
                                    //Getting QA Data
                                    $listQA = $ScoreCtrl->GetAnswerScore();

                                    // Looping through the results
                                    foreach ($listQA as $QA) {                                  
                                        ?>
                                            <tr class="tab-table__row filter__row" id="asQuestion<?php echo $QA->getQuestionID(); ?>" onclick="openQuestionAnswers('asQuestion<?php echo $QA->getQuestionID(); ?>', 'questionAnswers<?php echo $QA->getQuestionID(); ?>', 'expendIcon<?php echo $QA->getQuestionID(); ?>')">
                                                <td class="tab-table__td" ><?php echo $QA->getQuestionName(); ?> </td>
                                                <td class="tab-table__td" ><?php echo (round($QA->getAnswerScore())) ; ?> </td>
                                                <td class="tab-table__td" onclick="openQuestionAnswers('asQuestion<?php echo $QA->getQuestionID(); ?>', 'questionAnswers<?php echo $QA->getQuestionID(); ?>', 'expendIcon<?php echo $QA->getQuestionID(); ?>')">
                                                    <i class="fas tab-table__icon" id="expendIcon<?php echo $QA->getQuestionID(); ?>" onclick="openQuestionAnswers('asQuestion<?php echo $QA->getQuestionID(); ?>', 'questionAnswers<?php echo $QA->getQuestionID(); ?>', 'expendIcon<?php echo $QA->getQuestionID(); ?>')">&#xf107;</i>
                                                </td>
                                            </tr>
                                            <tr class="tab-table__row filter__row row--hidden av__row" id="questionAnswers<?php echo $QA->getQuestionID(); ?>">
                                                <td class="tab-table__td tab-td__table" colspan="3">
                                                    <table class="tab-table table table-hover answer-table" id="filterTable">
                                                        <thead>
                                                            <th class="tab-table__th">Answer</th>
                                                            <th class="tab-table__th">Score</th>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                //Getting QA Data
                                                                $listAnswers = $ScoreCtrl->getQuestionAnswers($QA->getQuestionID());
                                                                // Looping through the results
                                                                foreach ($listAnswers as $answer) { 
                                                                    ?>
                                                                        <tr class="tab-table__row filter__row">
                                                                            <td class="tab-table__td" ><?php echo $answer->getAnswerName(); ?> </td>
                                                                            <td class="tab-table__td av-row--score" ><?php echo $answer->getAnswerScore(); ?> </td>
                                                                        </tr>
                                                                    <?php
                                                                }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <script>
        // Filteren op de table
        $(document).ready(function() {
            $("#Filter").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#filterTable .filter__row").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</html>