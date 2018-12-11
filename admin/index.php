<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';

//Get Input data from query string
$search_string = filter_input(INPUT_GET, 'search_string');
$filter_col = filter_input(INPUT_GET, 'filter_col');

//Get current page.
$page = filter_input(INPUT_GET, 'page');

//Per page limit for pagination.
$pagelimit = 20;

if (!$page) {
    $page = 1;
}

//Get DB instance. i.e instance of MYSQLiDB Library
$db = getDbInstance();
$select = array('id', 'name', 'email', 'phone', 'address','course','status','test');

//Start building query according to input parameters.
// If search string
if ($search_string) {
    $db->where('name', '%' . $search_string . '%', 'like');
}

//Set pagination limit
$db->pageLimit = $pagelimit;

//Get result of the query.
$students = $db->arraybuilder()->paginate("students", $page, $select);
$total_pages = $db->totalPages;


include_once 'includes/header.php';
?>

<!--Main container start-->
<div id="page-wrapper">
    <div class="row">

        <div class="col-lg-6">
            <h1 class="page-header">Students</h1>
            <!--    Begin filter section-->
        <form class="form form-inline" action="">
            <label for="input_search">Search</label>
            <input type="text" class="form-control" id="input_search" name="search_string" value="<?php echo $search_string; ?>">
            <input type="submit" value="Go" class="btn btn-primary">

        </form>
<!--   Filter section end-->
        </div>
    </div>
        <?php include('./includes/flash_messages.php') ?>
    <hr>


    <table class="table table-striped table-bordered table-condensed">
        <thead>
            <tr>
                <th class="header">#</th>
                <th>Student Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Course</th>
                <th>test</th>
                <th>Status</th>

                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $row) : ?>
                <tr>
	                <td><?php echo $row['id'] ?></td>
	                <td><?php echo htmlspecialchars($row['name']); ?></td>
	                <td><?php echo htmlspecialchars($row['email']) ?></td>
	                <td><?php echo htmlspecialchars($row['phone']) ?> </td>
                    <td><?php echo htmlspecialchars($row['address']) ?> </td>
                    <td><?php echo htmlspecialchars($row['course']) ?> </td>
                    <td><?php echo htmlspecialchars($row['test']) ?> </td>
                    <td>
                    <form method="POST" action="update.php?id=<?php echo $row['id']?>">
                            <input  type="text" name="status" class="form-control" value="<?php echo htmlspecialchars($row['status']) ?>" autocomplete="">
                        <button>Save</button>
                    </form>
                    </td>
                    <td>
                    <a href=""  class="btn btn-danger delete_btn" data-toggle="modal" data-target="#confirm-delete-<?php echo $row['id'] ?>" style="margin-right: 8px;"><span class="glyphicon glyphicon-trash"></span></td>
				</tr>

						<!-- Delete Confirmation Modal-->
					 <div class="modal fade" id="confirm-delete-<?php echo $row['id'] ?>" role="dialog">
					    <div class="modal-dialog">
					      <form action="delete_student.php" method="POST">
					      <!-- Modal content-->
						      <div class="modal-content">
						        <div class="modal-header">
						          <button type="button" class="close" data-dismiss="modal">&times;</button>
						          <h4 class="modal-title">Confirm</h4>
						        </div>
						        <div class="modal-body">
						      
						        		<input type="hidden" name="del_id" id = "del_id" value="<?php echo $row['id'] ?>">
						        	
						          <?php echo htmlspecialchars($row['name'])." ". "are you sure to delete"; ?>
						        </div>
						        <div class="modal-footer">
						        	<button type="submit" class="btn btn-default pull-left">Yes</button>
						         	<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
						        </div>
						      </div>
					      </form>
					      
					    </div>
  					</div>
            <?php endforeach; ?>      
        </tbody>
    </table>

   
<!--    Pagination links-->
    <div class="text-center">

        <?php
        if (!empty($_GET)) {
            //we must unset $_GET[page] if previously built by http_build_query function
            unset($_GET['page']);
            //to keep the query sting parameters intact while navigating to next/prev page,
            $http_query = "?" . http_build_query($_GET);
        } else {
            $http_query = "?";
        }
        //Show pagination links
        if ($total_pages > 1) {
            echo '<ul class="pagination text-center">';
            for ($i = 1; $i <= $total_pages; $i++) {
                ($page == $i) ? $li_class = ' class="active"' : $li_class = "";
                echo '<li' . $li_class . '><a href="' . $http_query . '&page=' . $i . '">' . $i . '</a></li>';
            }
            echo '</ul></div>';
        }
        ?>
    </div>
    <!--    Pagination links end-->

</div>
<!--Main container end-->


<?php include_once './includes/footer.php'; ?>

