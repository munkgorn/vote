<?php defined('BASEPATH') or exit('No direct script access allowed');?>


<div class="container">
    <div class="row">
        <div class="col-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>List</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Empty all user</td>
                        <td><a href="<?php echo $link_empty; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?');">Empty</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
