<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Laravel Ajax CRUD Data Table for Database with Modal Form</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <style>
           @import url(https://fonts.googleapis.com/css?family=Raleway:300,400,600);

         .navbar-laravel

        {

            box-shadow: 0 2px 4px rgba(0,0,0,.04);

        }

        .navbar-brand , .nav-link, .my-form, .login-form

        {

            font-family: Raleway, sans-serif;

        }

        .my-form

        {

            padding-top: 1.5rem;

            padding-bottom: 1.5rem;

        }

        .my-form .row

        {

            margin-left: 0;

            margin-right: 0;

        }

        .login-form

        {

            padding-top: 1.5rem;

            padding-bottom: 1.5rem;

        }

        .login-form .row

        {

            margin-left: 0;

            margin-right: 0;

        }
        body {
            color: #566787;
            background: #f5f5f5;
            font-family: 'Varela Round', sans-serif;
            font-size: 13px;
        }

        .table-responsive {
            margin: 30px 0;
        }

        .table-wrapper {
            background: #fff;
            padding: 20px 25px;
            border-radius: 3px;
            min-width: 1000px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        }

        .table-title {
            padding-bottom: 15px;
            background: #435d7d;
            color: #fff;
            padding: 16px 30px;
            min-width: 100%;
            margin: -20px -25px 10px;
            border-radius: 3px 3px 0 0;
        }

        .table-title h2 {
            margin: 5px 0 0;
            font-size: 24px;
        }

        .table-title .btn-group {
            float: right;
        }

        .table-title .btn {
            color: #fff;
            float: right;
            font-size: 13px;
            border: none;
            min-width: 50px;
            border-radius: 2px;
            border: none;
            outline: none !important;
            margin-left: 10px;
        }

        .table-title .btn i {
            float: left;
            font-size: 21px;
            margin-right: 5px;
        }

        .table-title .btn span {
            float: left;
            margin-top: 2px;
        }

        table.table tr th,
        table.table tr td {
            border-color: #e9e9e9;
            padding: 12px 15px;
            vertical-align: middle;
        }

        table.table tr th:first-child {
            width: 60px;
        }

        table.table tr th:last-child {
            width: 100px;
        }

        table.table-striped tbody tr:nth-of-type(odd) {
            background-color: #fcfcfc;
        }

        table.table-striped.table-hover tbody tr:hover {
            background: #f5f5f5;
        }

        table.table th i {
            font-size: 13px;
            margin: 0 5px;
            cursor: pointer;
        }

        table.table td:last-child i {
            opacity: 0.9;
            font-size: 22px;
            margin: 0 5px;
        }

        table.table td a {
            font-weight: bold;
            color: #566787;
            display: inline-block;
            text-decoration: none;
            outline: none !important;
        }

        table.table td a:hover {
            color: #2196F3;
        }

        table.table td a.edit {
            color: #FFC107;
        }

        table.table td a.delete {
            color: #F44336;
        }

        table.table td i {
            font-size: 19px;
        }

        table.table .avatar {
            border-radius: 50%;
            vertical-align: middle;
            margin-right: 10px;
        }

        /* Modal styles */
        .modal .modal-dialog {
            max-width: 400px;
        }

        .modal .modal-header,
        .modal .modal-body,
        .modal .modal-footer {
            padding: 20px 30px;
        }

        .modal .modal-content {
            border-radius: 3px;
            font-size: 14px;
        }

        .modal .modal-footer {
            background: #ecf0f1;
            border-radius: 0 0 3px 3px;
        }

        .modal .modal-title {
            display: inline-block;
        }

        .modal .form-control {
            border-radius: 2px;
            box-shadow: none;
            border-color: #dddddd;
        }

        .modal textarea.form-control {
            resize: vertical;
        }

        .modal .btn {
            border-radius: 2px;
            min-width: 100px;
        }

        .modal form label {
            font-weight: normal;
        }

        .loading {
            color: black;
            font: 300 2em/100% Impact;
            text-align: center;
        }
        .text-danger {
            display: none;
        }
        /* loading dots */

        .loading:after {
            content: ' .';
            animation: dots 1s steps(5, end) infinite;
        }

        @keyframes dots {

            0%,
            20% {
                color: rgba(0, 0, 0, 0);
                text-shadow:
                    .25em 0 0 rgba(0, 0, 0, 0),
                    .5em 0 0 rgba(0, 0, 0, 0);
            }

            40% {
                color: black;
                text-shadow:
                    .25em 0 0 rgba(0, 0, 0, 0),
                    .5em 0 0 rgba(0, 0, 0, 0);
            }

            60% {
                text-shadow:
                    .25em 0 0 black,
                    .5em 0 0 rgba(0, 0, 0, 0);
            }

            80%,
            100% {
                text-shadow:
                    .25em 0 0 black,
                    .5em 0 0 black;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light navbar-laravel" id="navbar">

    <div class="container">

        <a class="navbar-brand" href="#">Laravel</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>

        </button>

   

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav ml-auto">

                @guest

                    <li class="nav-item">

                        <a class="nav-link" href="javascript:void(0)" onclick="loginbutton();">Login</a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link" href="javascript:void(0)" onclick="registerbutton();">Register</a>

                    </li>

                @else

                  

                @endguest

            </ul>

  

        </div>

    </div>

</nav>

<main class="login-form" id="loginform">

  <div class="cotainer">

      <div class="row justify-content-center">

          <div class="col-md-8">

              <div class="card">

                  <div class="card-header">Login</div>

                  <div class="card-body">
    
                        <div class="alert alert-success d-none" id="successlogin" role="alert">
                          Oppes! You have entered invalid credentials
                        </div>
                    
  

                      <form>

                          @csrf

                          <div class="form-group row">

                              <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                              <div class="col-md-6">

                                  <input type="text" id="emaillogin" class="form-control" name="email" required autofocus>

                                

                                      <span class="text-danger"id="emaillogin_err"></span>

                                  

                              </div>

                          </div>

  

                          <div class="form-group row">

                              <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                              <div class="col-md-6">

                                  <input type="password" id="passwordlogin" class="form-control" name="password" required>

                                 

                                      <span class="text-danger" id="passwordlogin_err"></span>

                            

                              </div>

                          </div>

  

                    


  

                          <div class="col-md-6 offset-md-4">

                              <button type="button" onclick="login();" class="btn btn-primary">

                                  Login

                              </button>

                          </div>

                      </form>

                        

                  </div>

              </div>

          </div>

      </div>

  </div>

</main>

<main class="login-form" id="registerform">

  <div class="cotainer">

      <div class="row justify-content-center">

          <div class="col-md-8">

              <div class="card">

                  <div class="card-header">Register</div>

                  <div class="card-body">

  

                      <form>

                          @csrf

                          <div class="form-group row">

                              <label for="name" class="col-md-4 col-form-label text-md-right">First name</label>

                              <div class="col-md-6">

                                  <input type="text" id="first_name" class="form-control" name="first_name" required autofocus>

                                 

                                      <span class="text-danger" id="first_name_reg_err"></span>

                                

                              </div>

                          </div>
                           <div class="form-group row">

                              <label for="name" class="col-md-4 col-form-label text-md-right">Last name</label>

                              <div class="col-md-6">

                                  <input type="text" id="last_name" class="form-control" name="last_name" required autofocus>

                                  
                                      <span class="text-danger" id="last_name_reg_err"></span>

                        

                              </div>

                          </div>

  

                          <div class="form-group row">

                              <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                              <div class="col-md-6">

                                  <input type="text" id="emailregister" class="form-control" name="email" required autofocus>

                            

                                      <span class="text-danger" id="emailregister_err"></span>

                              </div>

                          </div>

  

                          <div class="form-group row">

                              <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                              <div class="col-md-6">

                                  <input type="password" id="passwordregister" class="form-control" name="password" required>


                                      <span class="text-danger" id="passwordregister_err"></span>

                                

                              </div>

                          </div>


  

                          <div class="col-md-6 offset-md-4">

                              <button type="button" onclick="register();" class="btn btn-primary">

                                  Register

                              </button>

                          </div>

                      </form>

                        

                  </div>

              </div>

          </div>

      </div>

  </div>

</main>


















<!-- ////////////////////////// -->
    <div class="container-xl" id="container">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="bg-light p-2 m-2">
                        <h5 class="text-dark text-center">Laravel CRUD operation</h5>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Manage <b>Candidates</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Candidate</span></a>
                        </div>
                         <div class="col-sm-6">
                            <a href="" onclick="window.location='{{ url("/logout") }}'" class="btn btn-success" data-toggle="modal"> <span>Logout</span></a>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>First name</th>
                            <th>Last name</th>
                            <th>Age</th>
                            <th>Department</th>
                            <th>Min salary expectation</th>
                            <th>Max salary expectation</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody id="employee_data">
                    </tbody>
                </table>
                <p class="loading">Loading Data</p>
            </div>
        </div>
    </div>
    <!-- Edit Modal HTML -->
    <div id="addEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Candidate</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body add_epmployee">
                    <div class="form-group">
                        <label>First name</label>
                        <input type="text" id="first_name" class="form-control" required>
                        <span class="invalid-feedback" id="first_name_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Last name</label>
                        <input type="text" id="last_name" class="form-control" required>
                         <span class="invalid-feedback" id="last_name_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Age</label>
                        <input type="text" class="form-control" id="age" required>
                         <span class="invalid-feedback" id="age_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Department</label>
                        <input type="text" id="department" class="form-control" required>
                         <span class="invalid-feedback" id="department_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Min salary expectation</label>
                        <input type="text" id="min_salary_expectation" class="form-control" required>
                         <span class="invalid-feedback" id="min_salary_expectation_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Max salary expectation</label>
                        <input type="text" id="max_salary_expectation" class="form-control" required>
                         <span class="invalid-feedback" id="max_salary_expectation_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Currency code</label>
                        <input type="text" id="code" class="form-control" required>
                         <span class="invalid-feedback" id="code_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Country</label>
                        <input type="text" id="country" class="form-control" required>
                         <span class="invalid-feedback" id="country_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Street address</label>
                        <input type="text" id="street_address" class="form-control" required>
                         <span class="invalid-feedback" id="street_address_err"></span>
                    </div>
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" id="city" class="form-control" required>
                         <span class="invalid-feedback" id="city_err"></span>
                    </div><div class="form-group">
                        <label>State</label>
                        <input type="text" id="state" class="form-control" required>
                         <span class="invalid-feedback" id="state_err"></span>
                    </div><div class="form-group">
                        <label>Postal code</label>
                        <input type="text" id="postal_code" class="form-control" required>
                         <span class="invalid-feedback" id="postal_code_err"></span>
                    </div><div class="form-group">
                        <label>Type</label>
                        <input type="text" id="type" class="form-control" required>
                         <span class="invalid-feedback" id="type_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Number</label>
                        <input type="text" id="number" class="form-control" required>
                         <span class="invalid-feedback" id="number_err"></span>
                    </div>
                    <div class="form-group">
                        <label>School</label>
                        <input type="text" id="school" class="form-control" required>
                         <span class="invalid-feedback" id="school_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Degree</label>
                        <input type="text" id="degree" class="form-control" required>
                         <span class="invalid-feedback" id="degree_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Major</label>
                        <input type="text" id="major" class="form-control" required>
                         <span class="invalid-feedback" id="major_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Skill</label>
                        <input type="text" id="skill" class="form-control" required>
                         <span class="invalid-feedback" id="skill_err"></span>
                    </div>
                    <div class="form-group">
                        <label>level</label>
                        <input type="text" id="level" class="form-control" required>
                         <span class="invalid-feedback" id="level_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Company</label>
                        <input type="text" id="company" class="form-control" required>
                         <span class="invalid-feedback" id="company_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" id="title" class="form-control" required>
                         <span class="invalid-feedback" id="title_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Years</label>
                        <input type="text" id="years" class="form-control" required>
                         <span class="invalid-feedback" id="years_err"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-success" value="Add" onclick="addEmployee()">
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Modal HTML -->
    <div id="editEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Candidate</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body edit_employee">
                <input type="hidden" id="hiddenid">
                  <div class="form-group">
                        <label>First name</label>
                        <input type="text" id="first_name" class="form-control" required>
                        <span class="invalid-feedback" id="first_name_err_edit"></span>
                    </div>
                    <div class="form-group">
                        <label>Last name</label>
                        <input type="text" id="last_name" class="form-control" required>
                         <span class="invalid-feedback" id="last_name_err_edit"></span>
                    </div>
                    <div class="form-group">
                        <label>Age</label>
                        <input type="text" class="form-control" id="age" required>
                         <span class="invalid-feedback" id="age_err_edit"></span>
                    </div>
                    <div class="form-group">
                        <label>Department</label>
                        <input type="text" id="department" class="form-control" required>
                         <span class="invalid-feedback" id="department_err_edit"></span>
                    </div>
                    <div class="form-group">
                        <label>Min salary expectation</label>
                        <input type="text" id="min_salary_expectation" class="form-control" required>
                         <span class="invalid-feedback" id="min_salary_expectation_err_edit"></span>
                    </div>
                    <div class="form-group">
                        <label>Max salary expectation</label>
                        <input type="text" id="max_salary_expectation" class="form-control" required>
                         <span class="invalid-feedback" id="max_salary_expectation_err_edit"></span>
                    </div>
                    <div class="form-group">
                        <label>Currency code</label>
                        <input type="text" id="code" class="form-control" required>
                         <span class="invalid-feedback" id="code_err_edit"></span>
                    </div>
                    <div class="form-group">
                        <label>Country</label>
                        <input type="text" id="country" class="form-control" required>
                         <span class="invalid-feedback" id="country_err_edit"></span>
                    </div>
                    <div class="form-group">
                        <label>Street address</label>
                        <input type="text" id="street_address" class="form-control" required>
                         <span class="invalid-feedback" id="street_address_err_edit"></span>
                    </div>
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" id="city" class="form-control" required>
                         <span class="invalid-feedback" id="city_err_edit"></span>
                    </div><div class="form-group">
                        <label>State</label>
                        <input type="text" id="state" class="form-control" required>
                         <span class="invalid-feedback" id="state_err_edit"></span>
                    </div><div class="form-group">
                        <label>Postal code</label>
                        <input type="text" id="postal_code" class="form-control" required>
                         <span class="invalid-feedback" id="postal_code_err_edit"></span>
                    </div><div class="form-group">
                        <label>Type</label>
                        <input type="text" id="type" class="form-control" required>
                         <span class="invalid-feedback" id="type_err_edit"></span>
                    </div>
                    <div class="form-group">
                        <label>Number</label>
                        <input type="text" id="number" class="form-control" required>
                         <span class="invalid-feedback" id="number_err_edit"></span>
                    </div>
                    <div class="form-group">
                        <label>School</label>
                        <input type="text" id="school" class="form-control" required>
                         <span class="invalid-feedback" id="school_err_edit"></span>
                    </div>
                    <div class="form-group">
                        <label>Degree</label>
                        <input type="text" id="degree" class="form-control" required>
                         <span class="invalid-feedback" id="degree_err_edit"></span>
                    </div>
                    <div class="form-group">
                        <label>Major</label>
                        <input type="text" id="major" class="form-control" required>
                         <span class="invalid-feedback" id="major_err_edit"></span>
                    </div>
                    <div class="form-group">
                        <label>Skill</label>
                        <input type="text" id="skill" class="form-control" required>
                         <span class="invalid-feedback" id="skill_err_edit"></span>
                    </div>
                    <div class="form-group">
                        <label>level</label>
                        <input type="text" id="level" class="form-control" required>
                         <span class="invalid-feedback" id="level_err_edit"></span>
                    </div>
                    <div class="form-group">
                        <label>Company</label>
                        <input type="text" id="company" class="form-control" required>
                         <span class="invalid-feedback" id="company_err_edit"></span>
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" id="title" class="form-control" required>
                         <span class="invalid-feedback" id="title_err_edit"></span>
                    </div>
                    <div class="form-group">
                        <label>Years</label>
                        <input type="text" id="years" class="form-control" required>
                         <span class="invalid-feedback" id="years_err_edit"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-info" onclick="editEmployee()" value="Save">
                </div>
            </div>
        </div>
    </div>

    <!-- View Modal HTML -->
    <div id="viewEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">View Candidate</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body view_employee">
                    <div class="form-group">
                        <label>First name</label>
                        <input type="text" id="first_name" class="form-control" required>
                        <span class="invalid-feedback" id="first_name_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Last name</label>
                        <input type="text" id="last_name" class="form-control" required>
                         <span class="invalid-feedback" id="last_name_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Age</label>
                        <input type="text" class="form-control" id="age" required>
                         <span class="invalid-feedback" id="age_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Department</label>
                        <input type="text" id="department" class="form-control" required>
                         <span class="invalid-feedback" id="department_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Min salary expectation</label>
                        <input type="text" id="min_salary_expectation" class="form-control" required>
                         <span class="invalid-feedback" id="min_salary_expectation_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Max salary expectation</label>
                        <input type="text" id="max_salary_expectation" class="form-control" required>
                         <span class="invalid-feedback" id="max_salary_expectation_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Currency code</label>
                        <input type="text" id="code" class="form-control" required>
                         <span class="invalid-feedback" id="code_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Country</label>
                        <input type="text" id="country" class="form-control" required>
                         <span class="invalid-feedback" id="country_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Street address</label>
                        <input type="text" id="street_address" class="form-control" required>
                         <span class="invalid-feedback" id="street_address_err"></span>
                    </div>
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" id="city" class="form-control" required>
                         <span class="invalid-feedback" id="city_err"></span>
                    </div><div class="form-group">
                        <label>State</label>
                        <input type="text" id="state" class="form-control" required>
                         <span class="invalid-feedback" id="state_err"></span>
                    </div><div class="form-group">
                        <label>Postal code</label>
                        <input type="text" id="postal_code" class="form-control" required>
                         <span class="invalid-feedback" id="postal_code_err"></span>
                    </div><div class="form-group">
                        <label>Type</label>
                        <input type="text" id="type" class="form-control" required>
                         <span class="invalid-feedback" id="type_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Number</label>
                        <input type="text" id="number" class="form-control" required>
                         <span class="invalid-feedback" id="number_err"></span>
                    </div>
                    <div class="form-group">
                        <label>School</label>
                        <input type="text" id="school" class="form-control" required>
                         <span class="invalid-feedback" id="school_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Degree</label>
                        <input type="text" id="degree" class="form-control" required>
                         <span class="invalid-feedback" id="degree_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Major</label>
                        <input type="text" id="major" class="form-control" required>
                         <span class="invalid-feedback" id="major_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Skill</label>
                        <input type="text" id="skill" class="form-control" required>
                         <span class="invalid-feedback" id="skill_err"></span>
                    </div>
                    <div class="form-group">
                        <label>level</label>
                        <input type="text" id="level" class="form-control" required>
                         <span class="invalid-feedback" id="level_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Company</label>
                        <input type="text" id="company" class="form-control" required>
                         <span class="invalid-feedback" id="company_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" id="title" class="form-control" required>
                         <span class="invalid-feedback" id="title_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Years</label>
                        <input type="text" id="years" class="form-control" required>
                         <span class="invalid-feedback" id="years_err"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Close">
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal HTML -->
    <div id="deleteEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Candidate</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete these Records?</p>
                    <p class="text-warning"><small>This action cannot be undone.</small></p>
                </div>
                <input type="hidden" id="delete_id">
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-danger" onclick="deleteEmployee()" value="Delete">
                </div>
            </div>
        </div>
    </div>
<input type="hidden" name="" id="owner_id">
    <script>

    </script>
    <script>
        $(document).ready(function() {
         
            if({!!json_encode($owner_id)!!}!=null){
                document.getElementById('registerform').style.display='none';
document.getElementById('loginform').style.display='none';
document.getElementById('navbar').style.display='none';
document.getElementById('container').className='container-xl';
document.getElementById('owner_id').value={!!json_encode($owner_id)!!};

            employeeList({!!json_encode($owner_id)!!});
}
        });

        function employeeList(val) {
            
            $.ajax({
                type: 'get',
                data: {
                    id: val},


                url: "{{ url('candidates-list') }}",
                success: function(response) {
                    console.log(response);
                    var tr = '';
                    for (var i = 0; i < response.length; i++) {
                       
                        var id = response[i].id;
                        var first_name = response[i].first_name;
                        var last_name = response[i].last_name;
                        var age = response[i].age;
                        var department = response[i].department;
                        var min_salary_expectation = response[i].min_salary_expectation;
                        var max_salary_expectation = response[i].max_salary_expectation;

                        tr += '<tr>';
                        tr += '<td>' + id + '</td>';
                        tr += '<td>' + first_name + '</td>';
                        tr += '<td>' + last_name + '</td>';
                        tr += '<td>' + age + '</td>';
                        tr += '<td>' + department + '</td>';
                        tr += '<td>' + min_salary_expectation + '</td>';
                        tr += '<td>' + max_salary_expectation + '</td>';
                        tr += '<td><div class="d-flex">';
                        tr +=
                            '<a href="#viewEmployeeModal" class="m-1 view" data-toggle="modal" onclick=viewEmployee("' +
                            id + '")><i class="fa" data-toggle="tooltip" title="view">&#xf06e;</i></a>';
                        tr +=
                            '<a href="#editEmployeeModal" class="m-1 edit" data-toggle="modal" onclick=viewEmployee("' +
                            id +
                            '")><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>';
                        tr +=
                            '<a href="#deleteEmployeeModal" class="m-1 delete" data-toggle="modal" onclick=$("#delete_id").val("' +
                            id +
                            '")><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>';
                        tr += '</div></td>';
                        tr += '</tr>';
                    }
                    $('.loading').hide();
                    $('#employee_data').html(tr);
                }
            });
        }

        function addEmployee() {
            var owner_id =$('#owner_id').val();
            var first_name = $('.add_epmployee #first_name').val();
            var last_name = $('.add_epmployee #last_name').val();
            var age = $('.add_epmployee #age').val();
            var department = $('.add_epmployee #department').val();
            var min_salary_expectation = $('.add_epmployee #min_salary_expectation').val();
            var max_salary_expectation = $('.add_epmployee #max_salary_expectation').val();
            var code = $('.add_epmployee #code').val();
            var country = $('.add_epmployee #country').val();
            var street_address = $('.add_epmployee #street_address').val();
            var city = $('.add_epmployee #city').val();
            var state = $('.add_epmployee #state').val();
            var postal_code = $('.add_epmployee #postal_code').val();
            var type = $('.add_epmployee #type').val();
            var number = $('.add_epmployee #number').val();
            var school = $('.add_epmployee #school').val();
            var degree = $('.add_epmployee #degree').val();
            var major = $('.add_epmployee #major').val();
            var skill = $('.add_epmployee #skill').val();
            var level = $('.add_epmployee #level').val();
            var company = $('.add_epmployee #company').val();
            var title = $('.add_epmployee #title').val();            
            var years = $('.add_epmployee #years').val();


            $.ajax({
                type: 'post',
                data: {
                    owner_id: owner_id,
                    first_name: first_name,
                    last_name: last_name,
                    age: age,
                    department: department,
                    min_salary_expectation: min_salary_expectation,
                    max_salary_expectation: max_salary_expectation,
                    code: code,
                    country:country,
                    street_address: street_address,
                    city: city,
                    state: state,
                    postal_code: postal_code,
                    type: type,
                    number: number,
                    school: school,
                    degree: degree,
                    major: major,
                    skill: skill,
                    level: level,
                    company: company,
                    title: title,
                    years: years,
                
                    _token: "{{ csrf_token() }}"
                },
                url: "{{ url('candidates') }}",
                success: function(response) {
                    if(response.Status=='fail'){

                    $.each(response.errors, function( index, value ) {
              
             if(index =="first_name"){
                 document.getElementById('first_name_err').innerHTML=value;
                 document.getElementById('first_name_err').style.display="block";
             }
             if(index =="last_name"){
                 document.getElementById('last_name_err').innerHTML=value;
                 document.getElementById('last_name_err').style.display="block";
             }
             if(index =="age"){
                 document.getElementById('age_err').innerHTML=value;
                 document.getElementById('age_err').style.display="block";
             }
             if(index =="department"){
                 document.getElementById('department_err').innerHTML=value;
                 document.getElementById('department_err').style.display="block";
             }
            if(index =="min_salary_expectation"){
                 document.getElementById('min_salary_expectation_err').innerHTML=value;
                 document.getElementById('min_salary_expectation_err').style.display="block";
             }
            if(index =="max_salary_expectation"){
                 document.getElementById('max_salary_expectation_err').innerHTML=value;
                 document.getElementById('max_salary_expectation_err').style.display="block";
             }
            if(index =="code"){
                 document.getElementById('code_err').innerHTML=value;
                 document.getElementById('code_err').style.display="block";
             }
             if(index =="country"){
                 document.getElementById('country_err').innerHTML=value;
                 document.getElementById('country_err').style.display="block";
             }
            if(index =="street_address"){
                 document.getElementById('street_address_err').innerHTML=value;
                 document.getElementById('street_address_err').style.display="block";
             }
            if(index =="city"){
                 document.getElementById('city_err').innerHTML=value;
                 document.getElementById('city_err').style.display="block";
             }
            if(index =="state"){
                 document.getElementById('state_err').innerHTML=value;
                 document.getElementById('state_err').style.display="block";
             }
            if(index =="postal_code"){
                 document.getElementById('postal_code_err').innerHTML=value;
                 document.getElementById('postal_code_err').style.display="block";
             }
            if(index =="type"){
                 document.getElementById('type_err').innerHTML=value;
                 document.getElementById('type_err').style.display="block";
             }
             if(index =="number"){
                 document.getElementById('number_err').innerHTML=value;
                 document.getElementById('number_err').style.display="block";
             }
             if(index =="school"){
                 document.getElementById('school_err').innerHTML=value;
                 document.getElementById('school_err').style.display="block";
             }
             if(index =="degree"){
                 document.getElementById('degree_err').innerHTML=value;
                 document.getElementById('degree_err').style.display="block";
             }
             if(index =="major"){
                 document.getElementById('major_err').innerHTML=value;
                 document.getElementById('major_err').style.display="block";
             }
             if(index =="skill"){
                 document.getElementById('skill_err').innerHTML=value;
                 document.getElementById('skill_err').style.display="block";
             }
              if(index =="level"){
                 document.getElementById('level_err').innerHTML=value;
                 document.getElementById('level_err').style.display="block";
             }
             if(index =="company"){
                 document.getElementById('company_err').innerHTML=value;
                 document.getElementById('company_err').style.display="block";
             }
             if(index =="title"){
                 document.getElementById('title_err').innerHTML=value;
                 document.getElementById('title_err').style.display="block";
             }
             if(index =="years"){
                 document.getElementById('years_err').innerHTML=value;
                 document.getElementById('years_err').style.display="block";
             }
             });
return;
}
                         $('.add_epmployee #first_name').val('')
                         $('.add_epmployee #last_name').val('')
                         $('.add_epmployee #age').val('')
                         $('.add_epmployee #department').val('')
                         $('.add_epmployee #min_salary_expectation').val('')
                         $('.add_epmployee #max_salary_expectation').val('')
                         $('.add_epmployee #code').val('')
                         $('.add_epmployee #country').val('')
                         $('.add_epmployee #street_address').val('')
                         $('.add_epmployee #city').val('')
                         $('.add_epmployee #state').val('')
                         $('.add_epmployee #postal_code').val('')
                         $('.add_epmployee #type').val('')
                         $('.add_epmployee #number').val('')
                         $('.add_epmployee #school').val('')
                         $('.add_epmployee #degree').val('')
                         $('.add_epmployee #major').val('')
                         $('.add_epmployee #skill').val('')
                         $('.add_epmployee #level').val('')
                         $('.add_epmployee #company').val('')
                         $('.add_epmployee #title').val('')          
                         $('.add_epmployee #years').val('')

                    $('#addEmployeeModal').modal('hide');
                    employeeList($('#owner_id').val());
                    alert(response.message);
                }

            })
        }

        function editEmployee(id) {
            var first_name = $('.edit_employee #first_name').val();
            var last_name = $('.edit_employee #last_name').val();
            var age = $('.edit_employee #age').val();
            var department = $('.edit_employee #department').val();
            var min_salary_expectation = $('.edit_employee #min_salary_expectation').val();
            var max_salary_expectation = $('.edit_employee #max_salary_expectation').val();
            var code = $('.edit_employee #code').val();
            var country = $('.edit_employee #country').val();
            var street_address = $('.edit_employee #street_address').val();
            var city = $('.edit_employee #city').val();
            var state = $('.edit_employee #state').val();
            var postal_code = $('.edit_employee #postal_code').val();
            var type = $('.edit_employee #type').val();
            var number = $('.edit_employee #number').val();
            var school = $('.edit_employee #school').val();
            var degree = $('.edit_employee #degree').val();
            var major = $('.edit_employee #major').val();
            var skill = $('.edit_employee #skill').val();
            var level = $('.edit_employee #level').val();
            var company = $('.edit_employee #company').val();
            var title = $('.edit_employee #title').val();            
            var years = $('.edit_employee #years').val();
            var id=document.getElementById('hiddenid').value;

            $.ajax({
                type: 'post',
                data: {
                    id: id,
                    first_name: first_name,
                    last_name: last_name,
                    age: age,
                    department: department,
                    min_salary_expectation: min_salary_expectation,
                    max_salary_expectation: max_salary_expectation,
                    code: code,
                    country:country,
                    street_address: street_address,
                    city: city,
                    state: state,
                    postal_code: postal_code,
                    type: type,
                    number: number,
                    school: school,
                    degree: degree,
                    major: major,
                    skill: skill,
                    level: level,
                    company: company,
                    title: title,
                    years: years,

                    _token: "{{ csrf_token() }}"
                },
                url: "{{ url('candidate-edit') }}",
                success: function(response) {
                    if(response.Status=='fail'){

                    $.each(response.errors, function( index, value ) {
             if(index =="first_name"){
                 document.getElementById('first_name_err_edit').innerHTML=value;
                 document.getElementById('first_name_err_edit').style.display="block";
             }
             if(index =="last_name"){
                 document.getElementById('last_name_err_edit').innerHTML=value;
                 document.getElementById('last_name_err_edit').style.display="block";
             }
             if(index =="age"){
                 document.getElementById('age_err_edit').innerHTML=value;
                 document.getElementById('age_err_edit').style.display="block";
             }
             if(index =="department"){
                 document.getElementById('department_err_edit').innerHTML=value;
                 document.getElementById('department_err_edit').style.display="block";
             }
            if(index =="min_salary_expectation"){
                 document.getElementById('min_salary_expectation_err_edit').innerHTML=value;
                 document.getElementById('min_salary_expectation_err_edit').style.display="block";
             }
            if(index =="max_salary_expectation"){
                 document.getElementById('max_salary_expectation_err_edit').innerHTML=value;
                 document.getElementById('max_salary_expectation_err_edit').style.display="block";
             }
            if(index =="code"){
                 document.getElementById('code_err_edit').innerHTML=value;
                 document.getElementById('code_err_edit').style.display="block";
             }
             if(index =="country"){
                 document.getElementById('country_err_edit').innerHTML=value;
                 document.getElementById('country_err_edit').style.display="block";
             }
            if(index =="street_address"){
                 document.getElementById('street_address_err_edit').innerHTML=value;
                 document.getElementById('street_address_err_edit').style.display="block";
             }
            if(index =="city"){
                 document.getElementById('city_err_edit').innerHTML=value;
                 document.getElementById('city_err_edit').style.display="block";
             }
            if(index =="state"){
                 document.getElementById('state_err_edit').innerHTML=value;
                 document.getElementById('state_err_edit').style.display="block";
             }
            if(index =="postal_code"){
                 document.getElementById('postal_code_err_edit').innerHTML=value;
                 document.getElementById('postal_code_err_edit').style.display="block";
             }
            if(index =="type"){
                 document.getElementById('type_err_edit').innerHTML=value;
                 document.getElementById('type_err_edit').style.display="block";
             }
             if(index =="number"){
                 document.getElementById('number_err_edit').innerHTML=value;
                 document.getElementById('number_err_edit').style.display="block";
             }
             if(index =="school"){
                 document.getElementById('school_err_edit').innerHTML=value;
                 document.getElementById('school_err_edit').style.display="block";
             }
             if(index =="degree"){
                 document.getElementById('degree_err_edit').innerHTML=value;
                 document.getElementById('degree_err_edit').style.display="block";
             }
             if(index =="major"){
                 document.getElementById('major_err_edit').innerHTML=value;
                 document.getElementById('major_err_edit').style.display="block";
             }
             if(index =="skill"){
                 document.getElementById('skill_err_edit').innerHTML=value;
                 document.getElementById('skill_err_edit').style.display="block";
             }
              if(index =="level"){
                 document.getElementById('level_err_edit').innerHTML=value;
                 document.getElementById('level_err_edit').style.display="block";
             }
             if(index =="company"){
                 document.getElementById('company_err_edit').innerHTML=value;
                 document.getElementById('company_err_edit').style.display="block";
             }
             if(index =="title"){
                 document.getElementById('title_err_edit').innerHTML=value;
                 document.getElementById('title_err_edit').style.display="block";
             }
             if(index =="years"){
                 document.getElementById('years_err_edit').innerHTML=value;
                 document.getElementById('years_err_edit').style.display="block";
             }
             });
return;
}
                    $('#editEmployeeModal').modal('hide');
                    employeeList($('#owner_id').val());
                    alert(response.message);
                }

            })
        }
document.getElementById('container').className='container-xl d-none';
document.getElementById('registerform').style.display='none';

        function viewEmployee(id) {
          
            $.ajax({
                type: 'get',
                data: {
                    id: id,
                },
                url: "{{ url('candidate-view') }}",
                success: function(response) {
                    console.log(response);
                    $('.view_employee #first_name').val(Object.values(response)[0].first_name);
                    $('.view_employee #last_name').val(Object.values(response)[0].last_name);
                    $('.view_employee #age').val(Object.values(response)[0].age);
                    $('.view_employee #department').val(Object.values(response)[0].department);
                    $('.view_employee #min_salary_expectation').val(Object.values(response)[0].min_salary_expectation);
                    $('.view_employee #max_salary_expectation').val(Object.values(response)[0].max_salary_expectation);
                    $('.view_employee #code').val(Object.values(response)[0].code);
                    $('.view_employee #country').val(Object.values(response)[0].country);
                    $('.view_employee #street_address').val(Object.values(response)[0].street_address);
                    $('.view_employee #city').val(Object.values(response)[0].city);
                    $('.view_employee #state').val(Object.values(response)[0].state);
                    $('.view_employee #postal_code').val(Object.values(response)[0].postal_code);
                    $('.view_employee #type').val(Object.values(response)[0].type);
                    $('.view_employee #number').val(Object.values(response)[0].number);
                    $('.view_employee #school').val(Object.values(response)[0].school);
                    $('.view_employee #degree').val(Object.values(response)[0].degree);
                    $('.view_employee #major').val(Object.values(response)[0].major);
                    $('.view_employee #skill').val(Object.values(response)[0].skill);
                    $('.view_employee #level').val(Object.values(response)[0].level);
                    $('.view_employee #company').val(Object.values(response)[0].company);
                    $('.view_employee #title').val(Object.values(response)[0].title);
                    $('.view_employee #years').val(Object.values(response)[0].years);
                    $('.edit_employee #hiddenid').val(Object.values(response)[0].id);
                    $('.edit_employee #first_name').val(Object.values(response)[0].first_name);
                    $('.edit_employee #last_name').val(Object.values(response)[0].last_name);
                    $('.edit_employee #age').val(Object.values(response)[0].age);
                    $('.edit_employee #department').val(Object.values(response)[0].department);
                    $('.edit_employee #min_salary_expectation').val(Object.values(response)[0].min_salary_expectation);
                    $('.edit_employee #max_salary_expectation').val(Object.values(response)[0].max_salary_expectation);
                    $('.edit_employee #code').val(Object.values(response)[0].code);
                    $('.edit_employee #country').val(Object.values(response)[0].country);
                    $('.edit_employee #street_address').val(Object.values(response)[0].street_address);
                    $('.edit_employee #city').val(Object.values(response)[0].city);
                    $('.edit_employee #state').val(Object.values(response)[0].state);
                    $('.edit_employee #postal_code').val(Object.values(response)[0].postal_code);
                    $('.edit_employee #type').val(Object.values(response)[0].type);
                    $('.edit_employee #number').val(Object.values(response)[0].number);
                    $('.edit_employee #school').val(Object.values(response)[0].school);
                    $('.edit_employee #degree').val(Object.values(response)[0].degree);
                    $('.edit_employee #major').val(Object.values(response)[0].major);
                    $('.edit_employee #skill').val(Object.values(response)[0].skill);
                    $('.edit_employee #level').val(Object.values(response)[0].level);
                    $('.edit_employee #company').val(Object.values(response)[0].company);
                    $('.edit_employee #title').val(Object.values(response)[0].title);
                    $('.edit_employee #years').val(Object.values(response)[0].years);

            
                }
            })
        }

        function deleteEmployee() {
            var id = $('#delete_id').val();
            $('#deleteEmployeeModal').modal('hide');
            $.ajax({
                type: 'get',
                data: {
                    id: id,
                },
                url: "{{ url('candidate-delete') }}",
                success: function(response) {
                    employeeList($('#owner_id').val());
                    alert(response.message);
                }
            })
        }
    </script>
    <script type="text/javascript">
        function login(){
            var loginemail = document.getElementById('emaillogin').value;
            var loginpassword = document.getElementById('passwordlogin').value;

                $.ajax({
                type: 'post',
                data: {
                    email: loginemail,
                    password: loginpassword,
                    _token: "{{ csrf_token() }}"
                },
                url: "{{ url('login') }}",
                success: function(response) {
                    $.each( response.error, function( key, value ) {
                       
                        if(key==0){
document.getElementById('emaillogin_err').style.display='block';
document.getElementById('emaillogin_err').innerHTML=value;

                        }else if(key==1){
document.getElementById('passwordlogin_err').style.display='block';
document.getElementById('passwordlogin_err').innerHTML=value;

                        }
                    });
                    if(response.status=="success"){
alert('success');
document.getElementById('loginform').style.display='none';
document.getElementById('navbar').style.display='none';
document.getElementById('registerform').style.display='none';

document.getElementById('owner_id').value=response.owner_id;
employeeList(response.owner_id);
document.getElementById('container').className='container-xl';

                    }else{
document.getElementById('successlogin').className='alert alert-success';
                    }
                
                }

            })
        }
    </script>
    <script>
        function register() {
             var registeremail = document.getElementById('emailregister').value;
            var registerpassword = document.getElementById('passwordregister').value;
            var registerfirst_name = document.getElementById('first_name').value;
            var registerlast_name = document.getElementById('last_name').value;


                $.ajax({
                type: 'post',
                data: {
                    email: registeremail,
                    password: registerpassword,
                    first_name: registerfirst_name,
                    last_name: registerlast_name,

                    _token: "{{ csrf_token() }}"
                },
                url: "{{ url('register') }}",
                success: function(response) {
                    
                    $.each( response.error, function( key, value ) {
                    
                        if(key==0){
document.getElementById('emailregister_err').style.display='block';
document.getElementById('emailregister_err').innerHTML=value;

                        }else if(key==1){
document.getElementById('passwordregister_err').style.display='block';
document.getElementById('passwordregister_err').innerHTML=value;

                        }else if(key==2){
document.getElementById('first_name_reg_err').style.display='block';
document.getElementById('first_name_reg_err').innerHTML=value;   

                        }else if(key==3){
document.getElementById('last_name_reg_err').style.display='block'; 
document.getElementById('last_name_reg_err').innerHTML=value;   

                        }
                    });
                    if(response.status=="success"){
alert('success');
document.getElementById('registerform').style.display='none';
document.getElementById('loginform').style.display='none';

document.getElementById('navbar').style.display='none';
document.getElementById('owner_id').value=response.owner_id;
document.getElementById('container').className='container-xl';
  employeeList(response.owner_id);
                    }
        
                }

            })
        }
    </script>
<script type="text/javascript">
    function loginbutton(){
document.getElementById('registerform').style.display='none';
document.getElementById('loginform').style.display='block';

    }
    function registerbutton(){
document.getElementById('registerform').style.display='block';
document.getElementById('loginform').style.display='none';
    }
</script>
</body>

</html>
