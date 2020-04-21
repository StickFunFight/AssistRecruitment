<!--<!DOCTYPE HTML>-->
<!--<html lang="en">-->
<!--<head>-->
<!--    <meta name='viewport' content='width=device-width, initial-scale=1'>-->
<!--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">-->
<!--    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/sl-1.3.1/datatables.min.css"/>-->
<!--    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/>-->
<!--    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>-->
<!--    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>-->
<!--    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>-->
<!--    <script src='https://kit.fontawesome.com/a076d05399.js'></script>-->
<!---->
<!--<script>-->
<!--    $(document).ready(function() {-->
<!--        $('#example').DataTable();-->
<!--        $('#example2').DataTable();-->
<!--    } );-->
<!--</script>-->
<!---->
<!--</head>-->
<?php
require_once 'head.php';
?>
<body>
<div id="wrapper">
    <div id="first">
        <table id="example2" class="table">
            <thead>
            <tr>
               <th>Name</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td> <i class="fas fa-folder"></i> Tiger Nixon</td>
            </tr>
            <tr>
                <td>Garrett Winters</td>
            </tr>
            <tr>
                <td>Ashton Cox</td>
            </tr>
            <tr>
                <td>Cedric Kelly</td>
            </tr>
            <tr>
                <td>Airi Satou</td>
            </tr>
            <tr>
                <td>Brielle Williamson</td>
            </tr>
            </tbody>
        </table>

    </div>
    <div id="second" style="width:100%">
        <table id="example" class="table" style="width:100%">
            <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011/04/25</td>
                <td>$320,800</td>
            </tr>
            <tr>
                <td>Garrett Winters</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>63</td>
                <td>2011/07/25</td>
                <td>$170,750</td>
            </tr>
            <tr>
                <td>Ashton Cox</td>
                <td>Junior Technical Author</td>
                <td>San Francisco</td>
                <td>66</td>
                <td>2009/01/12</td>
                <td>$86,000</td>
            </tr>
            <tr>
                <td>Cedric Kelly</td>
                <td>Senior Javascript Developer</td>
                <td>Edinburgh</td>
                <td>22</td>
                <td>2012/03/29</td>
                <td>$433,060</td>
            </tr>
            <tr>
                <td>Airi Satou</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>33</td>
                <td>2008/11/28</td>
                <td>$162,700</td>
            </tr>
            <tr>
                <td>Brielle Williamson</td>
                <td>Integration Specialist</td>
                <td>New York</td>
                <td>61</td>
                <td>2012/12/02</td>
                <td>$372,000</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
<style>
    #wrapper{
        display: flex;
        flex-direction: row;
        border: 1px solid black;
    }
    #first{
        border: 1px solid black;
    }
</style>
